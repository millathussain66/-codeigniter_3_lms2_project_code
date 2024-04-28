
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
#loading-overlay {
        position: absolute;
        width: 100%;
        height:100%;
        left: 0;
        top: 0;
        display: none;
        align-items: center;
        background-color: #000;
        z-index: 999;
        opacity: 0.5;
    }
.loading-icon{ position:absolute;border-top:2px solid #fff;border-right:2px solid #fff;border-bottom:2px solid #fff;border-left:2px solid #767676;border-radius:25px;width:25px;height:25px;margin:0 auto;position:absolute;left:50%;margin-left:-20px;top:50%;margin-top:-20px;z-index:4;-webkit-animation:spin 1s linear infinite;-moz-animation:spin 1s linear infinite;animation:spin 1s linear infinite;}
    @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
    @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
    @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
#active{
   background-color:#e7e7e7 !important;
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
<?php 
$operation_name=$operation;
if ($operation=='court_fee' && VIEWCOURTFEE==0)
{
    if(VIEWCOURTENTER==1)
    {
        $operation='court_enter';
        $operation_name='court_enter';
    }
    else if(VIEWCOURTFEERETURN==1)
    {
        $operation='court_return';
        $operation_name='court_return';
    }
    else if(VIEWCOURTFEEADJUST==1)
    {
        $operation='court_adjust';
        $operation_name='court_adjust';
    }
    else if(VIEWSTAFFCONV==1)
    {
        $operation='staff_con';
        $operation_name='staff_con';
    }
    else if(VIEWLAWYERBILL==1)
    {
        $operation='lawyer_bill';
        $operation_name='lawyer_bill';
    }
    else if(VIEWPAPER==1)
    {
        $operation='paper_bill';
        $operation_name='paper_bill';
    }
    else if(VIEWOTHERS==1)
    {
        $operation='other';
        $operation_name='other';
    }
    else if(VIEWLAWYERBILLHC==1)
    {
        $operation='lawyer_bill_hc';
        $operation_name='lawyer_bill_hc';
    }
}
else if($operation=='court_fee' && VIEWCOURTFEE==1)
{
    $operation='court_fee';
    $operation_name='court_fee';
}
$operation_name= array('operation_name'=>$operation_name);
?>
<script type="text/javascript">
    function CustomerPickList(module_name=null,data_field_name=null) {
        newwindow=window.open("<?=base_url()?>index.php/home/ajaxFileUpload/"+module_name+'/'+data_field_name,"Upload","width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340"); 
        if (window.focus) {newwindow.focus()}
        return false; 
    }

    function show_confrimation_pop_up(field_name)
    {
        jQuery("#field_name").val(field_name);
        $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
        $('sendToCheckerMessageDialogCancel').style.display = 'inline';
        $('loadingReturn').style.display = 'none';
        sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
        sendToCheckerMessageDialog.show();
    }
    function close_window()
    {
        sendToCheckerMessageDialog.hide();
        var field_name = jQuery("#field_name").val();
        jQuery("#delete_reason_"+field_name).val('');
        jQuery("#comments").val('');
        return false;
    }
    function xl_download(){
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postData = jQuery('#grid_search_form').serialize()+"&"+csrfName+"="+csrfHash;
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: '<?=base_url()?>index.php/bill_ho/mk_xl_all_report',
            data : postData,
            datatype: "json",
            success: function(data){
              ///console.log(response);
                var json = jQuery.parseJSON(data);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var a = jQuery("<a>");
                jQuery("body").append(a);
                a.attr("download","Bill_Report.xls");
                a.attr("href",json.file);
                a[0].click();
                a.remove();
            }
        });

        
    }
    function xl_download_account_wise(){
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postData = jQuery('#grid_search_form').serialize()+"&"+csrfName+"="+csrfHash;
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: '<?=base_url()?>index.php/bill_ho/mk_xl_all_report_ac_wise',
            data : postData,
            datatype: "json",
            success: function(data){
              ///console.log(response);
                var json = jQuery.parseJSON(data);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var a = jQuery("<a>");
                jQuery("body").append(a);
                a.attr("download","Bill_Report.xls");
                a.attr("href",json.file);
                a[0].click();
                a.remove();
            }
        });

        
    }
    function delete_action()
    {
        if(jQuery("#comments").val()=='')
        {
            alert("Please Give Delete Reason");
            return false;
        }
        else
        {
            sendToCheckerMessageDialog.hide();
            var field_name = jQuery("#field_name").val();
            var comments = jQuery("#comments").val();
            jQuery("#delete_reason_"+field_name).val(comments);
            jQuery('#bill_select').val(0);
            call_ajax_submit();
            return true;
        }
    }
    function change_dropdown(operation,edit=null,module_name=null,multiselectbox=null)
    {
        var id='';
        //check for add action
        if ((edit==null || edit=='') && operation!='legal_district_lawyer' && operation!='legal_district_lawyer_grid') 
        {
            id = jQuery("#"+operation).val();
        }
        else if(operation=='legal_district_lawyer')
        {
            id = jQuery("#legal_district").val();
        }
        else if(operation=='legal_district_lawyer_grid')
        {
            id = jQuery("#legal_district_grid").val();
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
                        });
                        if(multiselectbox==null)
                        {
                            jQuery("#legal_district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Legal District", source: legal_district, width: 250, height: 25});
                        }
                        else
                        {
                            jQuery("#legal_district").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Legal District",filterable: true,searchMode: 'containsignorecase', source: legal_district, width: 250, height: 25});
                        }
                    }
                    if (operation=='legal_region_grid') 
                    {
                        var legal_district = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            legal_district.push({ value: obj.id, label: obj.name });
                            //alert(obj.name);
                        });
                        jQuery("#legal_district_grid").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Legal District", source: legal_district, width: '98%', height: 25});
                    }
                    if (operation=='legal_district_lawyer') 
                    {
                        var lawyer = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            lawyer.push({ value: obj.id, label: obj.name });
                            //alert(obj.name);
                        });
                        if(module_name=='court_return')
                        {
                            jQuery("#lawyer").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 180, height: 25});
                        }
                        else
                        {
                            jQuery("#lawyer").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
                        }
                        
                    }
                    if (operation=='legal_district_lawyer_grid') 
                    {
                        var lawyer = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            lawyer.push({ value: obj.id, label: obj.name });
                            //alert(obj.name);
                        });
                        jQuery("#lawyer_grid").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: '98%', height: 25});
                        
                    }

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
            });

            return false;
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
    function show_info_pop_up(id,operation,amount=null,date=null)
    {
        jQuery("#cos_id").val(id);
        jQuery("#edit_div").hide();
        jQuery("#delete_div").hide();
        jQuery("#ho_operation_name").val(operation);
        jQuery("#new_amount").val('');
        jQuery("#new_txrn_dt").val('');
        if(operation=='D')
        {
            jQuery("#operation_name").html('Delete');
            jQuery("#operation_msg").html('Delete');
            jQuery("#delete_div").show();
        }
        else
        {
            jQuery("#operation_name").html('Edit');
            jQuery("#operation_msg").html('Edit');
            jQuery("#new_amount").val(amount);
            jQuery("#new_txrn_dt").val(date_formater(date));
            jQuery("#edit_div").show();
        }
        $('billHoDeleteMessageDialogConfirm').style.display = 'inline';
        $('billHoDeleteMessageDialogCancel').style.display = 'inline';
        $('loadingDelete').style.display = 'none';
        billHoDeleteMessageDialog = new EOL.dialog($('billHoDeleteMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'billHoDeleteMessageDialog' });
        billHoDeleteMessageDialog.show();
    }
    function close_pop_up()
    {
        billHoDeleteMessageDialog.hide();
        jQuery("#cos_id").val('');
        jQuery("#delete_reason").val('');
        return false;
    }
    function bills_delete_ho(){
        if(jQuery("#delete_reason").val()=='' && jQuery("#ho_operation_name").val()=='D')
        {
            alert("Please Give Delete Reason");
            return false;
        }
        else if(jQuery("#ho_operation_name").val()=='E')
        {
            if(jQuery.trim(jQuery('#new_txrn_dt').val())=='')
            {
                alert('Date Required');
                jQuery('#new_txrn_dt').focus();
                return false;
            }
            if(jQuery.trim(jQuery('#new_txrn_dt').val())!='')
            {
                if(!validate_date(jQuery('#new_txrn_dt').val()))
                {
                    alert('Activities Date Invalid');
                    jQuery('#new_txrn_dt').focus();
                    return false;
                }
            }
            if(jQuery.trim(jQuery('#new_amount').val())=='')
            {
                alert('Amount Required');
                jQuery('#new_amount').focus();
                return false;
            }
            
            if(jQuery.trim(jQuery('#new_amount').val())!='')
            {
                if(!checknumber_alphabatic('new_amount'))
                {
                    alert('Amount Only Numeric');
                    jQuery('#new_amount').focus();
                    return false;
                }
            }
        }
        billHoDeleteMessageDialog.hide();
        var postdata = jQuery('#stuff_convence').serialize();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var id = jQuery('#cos_id').val();
        var new_amount = jQuery('#new_amount').val();
        var delete_reason = jQuery('#delete_reason').val();
        var new_txrn_dt = jQuery('#new_txrn_dt').val();
        var ho_operation_name = jQuery('#ho_operation_name').val();
        jQuery.ajax({
        url: '<?php echo base_url(); ?>bill_ho/bills_delete_ho',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,id:id,delete_reason:delete_reason,ho_operation_name:ho_operation_name,new_amount:new_amount,new_txrn_dt:new_txrn_dt},
        datatype: "json",
        success: function(response){
            //console.log(response);
            var json = jQuery.parseJSON(response);
            //console.log(json['row_info']);
            var  csrf_tokena = json.csrf_token;
            jQuery('.txt_csrfname').val(json.csrf_token);
            jQuery("#cos_id").val('');
            jQuery("#delete_reason").val('');
            call_service();
            }
        });
        return true;
    }
</script>
<!-- For staff conveyence -->
<?php if ($operation=='staff_con' && VIEWSTAFFCONV==1): ?>

    <script type="text/javascript">
        var start=1990;
        let date =  new Date().getFullYear();
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var tax_vat_text = [<? $i=1; foreach($tax_vat_text as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var bank = [<? $i=1; foreach($bank as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var payment_type = [<? $i=1; foreach($payment_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        //var legal_am = [<? $i=1; foreach($legal_am as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->pin.')"}'; $i++;}?>];
        var approver_list = [<? $i=1; foreach($approver_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var staff = [];
            var theme = getDemoTheme();
            rules2=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            rules3=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            jQuery(document).ready(function () {
            jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 100, height: 25});
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#approver_list").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Select Approver List",filterable: true,searchMode: 'containsignorecase', source: approver_list, width: 250, height: 25});
            jQuery("#staff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 250, height: 25});
            jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 250, height: 25});
            jQuery("#tax_vat_text").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Tax Vat Text", source: tax_vat_text, width: 250, height: 25});
            jQuery("#payment_type").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Payment Type", source: payment_type, width: 250, height: 25});
            jQuery("#bank").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Bank", source: bank, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            //jQuery("#legal_am").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal AM", source: legal_am, width: 250, height: 25});
            jQuery('#payment_type,#bank,#district,#staff,#tax_vat_text').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
             });



            jQuery('#payment_type').bind('change', function (event) {
                jQuery('#stuff_convence').jqxValidator('hide');
                jQuery("#bank_ac_ac").val('');
                jQuery("#bank").val('');
                jQuery("#ac_no_rtgs").val('');
                jQuery("#routing_no").val('');
                jQuery("#bank").jqxComboBox('clearSelection');
                var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    if (item.value==1)
                    {
                        jQuery("#ac_row").show();
                        jQuery("#rtgs_row").hide();
                    }
                    else
                    {
                        jQuery("#ac_row").hide();
                        jQuery("#rtgs_row").show();
                    }
                }
                else{
                    jQuery("#ac_row").hide();
                    jQuery("#rtgs_row").hide();
                }
            });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
						{ name: 'e_by_id', type: 'int'},
						{ name: 'sts', type: 'int'},
						{ name: 'status', type: 'string'},
						{ name: 'sl_no', type: 'string'},
                        { name: 'bill_type', type: 'int'},
						{ name: 'dispatch_no', type: 'string'},
                        { name: 'bill_amount', type: 'string'},
                        { name: 'discount_amount', type: 'string'},
                        { name: 'invoice_amount', type: 'string'},
						{ name: 'e_by', type: 'string'},
						{ name: 'e_dt', type: 'string'},
						{ name: 'v_by', type: 'string'},
						{ name: 'v_dt', type: 'string'},
                        { name: 'stf_by', type: 'string'},
                        { name: 'stf_dt', type: 'string'},
                        { name: 'bill_months', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/staff_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
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
                    loadError: function(xhr, status, error){
                        alert(error);
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-260;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
						<? if(EDIT==1){?>
						  { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27 || dataRecord.sts==29)){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
								}
								else
								{
									return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
								}
	                      	}
		                  },
						<? }?>
						<? if(SENDTOCHECKER==1){?>
						  { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27)){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
							 	}
							 	else if(dataRecord.sts == 37){
		                      			return '<div style=" margin-top: 8px;text-align:center">S</div>';
		                      	}
		                      	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
	                      	}
		                  },
						<? }?>
						<? if(VERIFY==1){?>
						  { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
								if(dataRecord.sts == 26 || dataRecord.sts == 30 || dataRecord.sts==89){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
							 	}
							 	else if(dataRecord.sts == 29) {
		                      			return '<div style=" margin-top: 7px;text-align:center">V</div>';
		                      	}
	                      	}
		                  },
						<? }?>
                        <? if(VIEWMEMO==1){?>
                        { text: 'BM', menu: false, datafield: 'reimbursemnt', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                //if(dataRecord.sts == 29){
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_staff_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                //}
                            }
                        },
                        <? }?>
                        <? if(VIEWMEMO==1){?>
                        { text: 'RF', menu: false, datafield: 'Download', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                //if(dataRecord.sts == 29){
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_staff_reimbursment/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                //}
                            }
                        },
                        <? }?>
                        <? if(SENDTOFINANCE==1){?>
                          { text: 'STF', datafield: 'sendtofinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtofinance\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 70) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(VERIFYFINANCE==1){?>
                          { text: 'VF', datafield: 'verifyfinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 70){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verifyfinance\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
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
							var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

							  }
					  	},
                       
					  	{ text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
					  	{ text: 'SL No.', datafield: 'sl_no', editable: false,align:'left',cellsalign:'center', sortable: true, menu: true, width: '11%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
	                      		var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.sl_no+'</span></a></div>';
		                      	
	                      	}
		                  },
                        { text: 'Bill Amount', datafield: 'bill_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Discount Amount', datafield: 'discount_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Invoice Amount', datafield: 'invoice_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Bill Months', datafield: 'bill_months',editable: false, width: '20%', align:'left',cellsalign:'left'},
					  	{ text: 'Despatch No.', datafield: 'dispatch_no',editable: false, width: '17%', align:'left',cellsalign:'left'},
					  	{ text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
					  	{ text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
					  	{ text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
					  	{ text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance By', datafield: 'stf_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance Date', datafield: 'stf_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });      
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        //initGrid();
                        break;
                    case 1:
                        initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
                jQuery('#stuff_convence').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>

            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#stuff_convence').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#stuff_convence').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#stuff_convence').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#stuff_convence').jqxValidator('validate', validationResult);        
            });
            jQuery("#bill_details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false });
            jQuery('#bill_details').jqxWindow({ showCloseButton: false }); 

        });
        function call_ajax_submit(){
            
            var postdata = jQuery('#stuff_convence').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>bill_ho/add_edit_staff_bill/"+add_edit+"/"+edit_row,
                data : postdata,
                datatype: "json",
                async:false,
                success: function(response){
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
                    }
                    var msg='';
                    if(edit_row>0){
                        msg='Updated';
                    }else{
                        msg="Saved";
                    }
                    clear_form();
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
                    if(add_edit=='edit'){
                        jQuery("#in_up_loading").hide();
                        jQuery("#in_up_button").show();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
                    }else{
                        jQuery("#in_req_button").show();
                        jQuery("#in_req_loading").hide();
                    }
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');

                }
            });
        }
        
        function get_dropdown_data(){
            var item = jQuery("#district").jqxComboBox('getSelectedItem');
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
                            jQuery("#staff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 250, height: 25});
                            jQuery('#staff').focusout(function() {
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
                jQuery("#staff").jqxComboBox('clearSelection');
                jQuery("#staff").val('');
            }
        }
        function edit_old(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_staff_exp_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        var csrf_tokena = json.csrf_token;
                        jQuery("#month_row").hide();
                        jQuery("#district_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        CheckChanged_2('','');
                        jQuery("#staff").jqxComboBox('val',json['result'].vendor);
                        jQuery("#hidden_vendor_id").val(json['result'].vendor_id);
                        jQuery("#sl_no").val(json['result'].sl_no);
                        jQuery("#drop_down_td").hide();
                        jQuery("#text_td").show();
                        jQuery("#staff_name").html(json['result'].vendor_name);
                        jQuery("#discount_amount").val(json['result'].discount_amount);
                        jQuery("#received_dt").val(json['result'].received_dt);
                        jQuery("#memo_remarks").val(json['result'].memo_remarks);
                        jQuery("#dispatch_no").val(json['result'].dispatch_no);
                        //jQuery("#legal_am").jqxComboBox('val',json['result'].legal_am);
                        jQuery("#tax_vat_text").jqxComboBox('val',json['result'].tax_vat_text);
                        jQuery("#payment_type").jqxComboBox('val',json['result'].payment_type);
                        if(json['result'].payment_type==1)
                        {
                            jQuery("#bank_ac_ac").val(json['result'].bank_ac);
                        }
                        else
                        {
                            jQuery("#bank").val(json['result'].bank);
                            jQuery("#routing_no").val(json['result'].routing_no);
                            jQuery("#ac_no_rtgs").val(json['result'].bank_ac);
                        }
                        var educqu=json['result'].approver_list.split(',');
                        for (var i = 0; i < educqu.length; i++)
                        {
                            jQuery("#approver_list").jqxDropDownList('checkItem', educqu[i]);
                        }
                        
                        
              },
                error:   function(model, xhr, options){
                    alert('failed');
                    clear_form();
                },
            });
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
            
        }
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_staff_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        var csrf_tokena = json.csrf_token;
                        jQuery("#month_row").hide();
                        jQuery("#district_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        CheckChanged_2('','');
                        jQuery("#staff").jqxComboBox('val',json['result'].vendor);
                        jQuery("#hidden_vendor_id").val(json['result'].vendor_id);
                        jQuery("#sl_no").val(json['result'].sl_no);
                        jQuery("#drop_down_td").hide();
                        jQuery("#text_td").show();
                        jQuery("#staff_name").html(json['result'].vendor_name);
                        jQuery("#memo_remarks").val(json['result'].memo_remarks);
                        jQuery("#dispatch_no").val(json['result'].dispatch_no);
                        //jQuery("#legal_am").jqxComboBox('val',json['result'].legal_am);
                        jQuery("#tax_vat_text").jqxComboBox('val',json['result'].tax_vat_text);
                        jQuery("#payment_type").jqxComboBox('val',json['result'].payment_type);
                        if(json['result'].payment_type==1)
                        {
                            jQuery("#bank_ac_ac").val(json['result'].bank_ac);
                        }
                        else
                        {
                            jQuery("#bank").val(json['result'].bank);
                            jQuery("#routing_no").val(json['result'].routing_no);
                            jQuery("#ac_no_rtgs").val(json['result'].bank_ac);
                        }
                        var educqu=json['result'].approver_list.split(',');
                        for (var i = 0; i < educqu.length; i++)
                        {
                            jQuery("#approver_list").jqxDropDownList('checkItem', educqu[i]);
                        }
                        
                        
              },
                error:   function(model, xhr, options){
                    alert('failed');
                    clear_form();
                },
            });
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
            
        }
        function clear_form(){
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#staff").jqxComboBox('clearSelection');
            jQuery("input[name='staff']").val('');
            jQuery("#district").jqxComboBox('clearSelection');
            jQuery("input[name='district']").val('');
            jQuery("#tax_vat_text").jqxComboBox('clearSelection');
            jQuery("input[name='tax_vat_text']").val('');
            jQuery("#month_row").show();
            jQuery("#district_row").show();
            jQuery("#sl_no").val('Auto Generate');
            jQuery("#dispatch_no").val('Auto Generate');
            jQuery("#hidden_vendor_id").val('');
            jQuery("#memo_remarks").val('');
            jQuery("#payment_type").jqxComboBox('clearSelection');
            jQuery("input[name='payment_type']").val('');
            jQuery("#bill_info_body").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery("#payment_type").jqxComboBox('val',1);
            jQuery('#stuff_convence').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#text_td").hide();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery("#district").jqxComboBox({ disabled: false });
            jQuery("#staff").jqxComboBox({ disabled: false });
            jQuery("#bill_month").jqxDropDownList({ disabled: false });
            jQuery("#year").jqxDropDownList({ disabled: false });
        }

        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").show();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/staff_bill_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_for_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_for_finance_select" name="hidden_file_for_finance_select" value="0">';
                            html+='<span id="hidden_file_for_finance">';
                            jQuery('#file_for_finance').html(html);

                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_from_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_from_finance_select" name="hidden_file_from_finance_select" value="0">';
                            html+='<span id="hidden_file_from_finance">';
                            jQuery('#file_from_finance').html(html);

                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
        function load_expense()
        {
            var theme = getDemoTheme();
            var  rules= [];
            rules.push(
                    { input: '#bill_month', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#bill_month input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#district', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#district input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#staff', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#staff input").focus();
                            return false;
                        }
                    }  
                    }
            );
            jQuery('#stuff_convence').jqxValidator({
                  rules: rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    call_service();
                }
            }
            jQuery('#stuff_convence').jqxValidator('validate', validationResult);
        }
        function check_staff_conv_bill()
        {
            var number=jQuery("#hidden_total_bill_counter").val();
            var event_id=jQuery("#hidden_event_id").val();
            var all_bills = "";
            var deduct_amount = "";
            var deduct_remarks = "";
            var checkco=0;
            var total_amount = 0;
            for(var i=1; i<=number; i++){                                                       
                if(document.getElementById("chkBoxSelect_bill_"+i).checked==true){
                    checkco++; 
                    if (isNaN(jQuery("#diduct_amount_"+i).val())) {
                        alert('Please insert only numeric value');
                        jQuery("#diduct_amount_"+i).focus();
                        return false;
                    }
                    if(parseFloat(jQuery("#diduct_amount_"+i).val())>parseFloat(jQuery("#orginal_amount_"+i).val()))
                    {
                        alert('Diduction Amount Bigger Then Amount');
                        jQuery("#diduct_amount_"+i).focus();
                        return false;
                    }
                    if(parseFloat(jQuery("#diduct_amount_"+i).val())<0)
                    {
                        alert('Provide Valid Diduction Amount');
                        jQuery("#diduct_amount_"+i).focus();
                        return false;
                    }
                    if(jQuery("#diduct_amount_"+i).val()!='' && parseFloat(jQuery("#diduct_amount_"+i).val())>0 && jQuery("#deduct_remarks_"+i).val()=='')
                    {
                        alert("Please Give Diduction Remarks");
                        jQuery("#deduct_remarks_"+i).focus();
                        return false;
                    }
                    total_amount = total_amount+parseFloat(jQuery("#orginal_amount_"+i).val());
                    all_bills+=jQuery("#cost_id_"+i).val()+',';
                    deduct_amount+=jQuery("#cost_id_"+i).val()+'__$'+jQuery("#diduct_amount_"+i).val()+'####';
                    deduct_remarks+=jQuery("#cost_id_"+i).val()+'__$'+jQuery("#deduct_remarks_"+i).val()+'####';
                }                                           
            }
            jQuery('#event_memo_id_'+event_id).val(all_bills);
            jQuery('#event_diduct_amount_'+event_id).val(deduct_amount);
            jQuery('#event_diduct_remarks_'+event_id).val(deduct_remarks);
            jQuery('#event_amount_'+event_id).val(total_amount);
            jQuery('#show_amount_'+event_id).html(total_amount);
            //For the parent grid selection
            var number=jQuery("#billcount").val();
            var checkco=0;
            var amount = 0;
            var event_amount = 0;
            for(var i=1; i<=number; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    var event_id = jQuery("#event_id_"+i).val();
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+event_id).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
            document.getElementById("checkAll").checked=true;
            }else{
            document.getElementById("checkAll").checked=false;
            }   
            jQuery('#selected_amount').html(event_amount.toFixed(2));           
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2)); 
            jQuery("#bill_details").jqxWindow('close');
        }
        function bill_details(event_id,event_type)
        {
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/get_staff_conv_all_bill",
                data: { [csrfName]: csrfHash,event_id : event_id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json['result'])
                        {
                            var diduct_amount = jQuery('#event_diduct_amount_'+event_id).val();
                            var all_deduct_amount = diduct_amount.split("####");
                            var event_ids = jQuery('#event_memo_id_'+event_id).val();
                            var all_ids = event_ids.split(",");
                            var diduct_remarks = jQuery('#event_diduct_remarks_'+event_id).val();
                            var all_deduct_remarks = diduct_remarks.split("####");
                            var counter=0;
                            var html="";
                            html+='<table style="width: 100%;" class="preview_table2">';
                            html+='<thead>';
                                
                                    if(event_type==1)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Movement Details</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Mode of Transportaion</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                    else if(event_type==2)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Particulars</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Place</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                    else if(event_type==3)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Description of Journey</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Journey Time</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Journey Metar</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Reached Metar</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Reached Time</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                    else if(event_type==4)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center" rowspan="2"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2">Purpose</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" colspan="4">Destination</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2">Mode</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2">Break Down Bill Amount</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';

                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center">From</td>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center">Time out</td>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center">To</td>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center">Time In</td>';
                                        html+='</tr>';

                                    }
                                    else if(event_type==5)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">From Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">To Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Particulars</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Place</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                    else
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Movement Details</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Mode of Transportaion</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                
                            html+='</thead>';
                            html+='<tbody id="">';
                            jQuery.each(json['result'],function(key,obj){
                                for (var i = 0; i < all_deduct_amount.length; i++) 
                                {
                                    var single_diduct_amount  = all_deduct_amount[i];
                                    var diduct_id = single_diduct_amount.split("__$");
                                    if(diduct_id[0]==obj.id)
                                    {
                                        var diduct_amount  = diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        var diduct_amount  = "";
                                    }
                                }
                                for (var i = 0; i < all_deduct_remarks.length; i++) 
                                {
                                    var single_diduct_remarks  = all_deduct_remarks[i];
                                    var diduct_id = single_diduct_remarks.split("__$");
                                    if(diduct_id[0]==obj.id)
                                    {
                                        var diduct_remarks  = diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        var diduct_remarks  = "";
                                    }
                                }
                                counter++;
                                html+='<tr>';
                                    if(all_ids.includes(obj.id))
                                    {
                                        html+='<td align="left"><input type="checkbox" checked name="chkBoxSelect_bill_'+counter+'" id="chkBoxSelect_bill_'+counter+'" /><input type="hidden" name="cost_id_'+counter+'" id="cost_id_'+counter+'" value="'+obj.id+'"></td>';
                                    }
                                    else
                                    {
                                        html+='<td align="left"><input type="checkbox" name="chkBoxSelect_bill_'+counter+'" id="chkBoxSelect_bill_'+counter+'" /><input type="hidden" name="cost_id_'+counter+'" id="cost_id_'+counter+'" value="'+obj.id+'"></td>';
                                    }
                                    //html+='<td align="center">'+counter+'</td>';

                                    if(event_type==1)
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.movement_details+'</td>';
                                        html+='<td align="center">'+obj.move_of_transfortaion+'</td>';
                                    }
                                    else if(event_type==2)
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.particulars+'</td>';
                                        html+='<td align="center">'+obj.place+'</td>';
                                    }
                                    else if(event_type==3)
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.description_of_journey+'</td>';
                                        html+='<td align="center">'+obj.journey_time+'</td>';
                                        html+='<td align="center">'+obj.journey_metar+'</td>';
                                        html+='<td align="center">'+obj.reached_metar+'</td>';
                                        html+='<td align="center">'+obj.reached_time+'</td>';
                                    }
                                    else if(event_type==4)
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.purpose+'</td>';
                                        html+='<td align="center">'+obj.from+'</td>';
                                        html+='<td align="center">'+obj.time_out+'</td>';
                                        html+='<td align="center">'+obj.to+'</td>';
                                        html+='<td align="center">'+obj.time_in+'</td>';
                                        html+='<td align="center">'+obj.mode+'</td>';
                                        html+='<td align="center">'+obj.breakdown_bill+'</td>';
                                    }
                                    else if(event_type==5)
                                    {
                                        html+='<td align="center">'+obj.from_date+'</td>';
                                        html+='<td align="center">'+obj.to_date+'</td>';
                                        html+='<td align="center">'+obj.particulars+'</td>';
                                        html+='<td align="center">'+obj.place+'</td>';
                                    }
                                    else
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.movement_details+'</td>';
                                        html+='<td align="center">'+obj.move_of_transfortaion+'</td>';
                                    }
                                    html+='<td align="center"><input type="hidden" name="orginal_amount_'+counter+'" id="orginal_amount_'+counter+'" value="'+obj.amount+'" style=""/>'+obj.amount+'</td>';
                                    html+='<td align="center"><input type="text" name="diduct_amount_'+counter+'" id="diduct_amount_'+counter+'" value="'+diduct_amount+'" style="width:200px;"/></td>';
                                    html+='<td align="center"><textarea name="deduct_remarks_'+counter+'" id="deduct_remarks_'+counter+'" style="width:200px;">'+diduct_remarks+'</textarea></td>';
                                html+='</tr>';
                            });
                            html+='<input type="hidden" name="hidden_event_id" id="hidden_event_id" value="'+event_id+'"><input type="hidden" name="hidden_total_bill_counter" id="hidden_total_bill_counter" value="'+counter+'"></tbody>';
                            html+='</table>';
                            document.getElementById("bill_details").style.visibility='visible';
                            jQuery("#bill_details_body").html(html);
                            jQuery("#bill_details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function bill_details_edit(event_id,bill_id,event_type)
        {
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/get_staff_conv_all_bill_edit",
                data: { [csrfName]: csrfHash,event_id : event_id,bill_id:bill_id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json['result'])
                        {
                            var diduct_amount = jQuery('#event_diduct_amount_'+event_id).val();
                            var all_deduct_amount = diduct_amount.split("####");
                            var event_ids = jQuery('#event_memo_id_'+event_id).val();
                            var all_ids = event_ids.split(",");
                            var diduct_remarks = jQuery('#event_diduct_remarks_'+event_id).val();
                            var all_deduct_remarks = diduct_remarks.split("####");
                            var counter=0;
                            var html="";
                            html+='<table style="width: 100%;" class="preview_table2">';
                            html+='<thead>';
                                if(event_type==1)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Movement Details</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Mode of Transportaion</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                    else if(event_type==2)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Particulars</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Place</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                    else if(event_type==3)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Description of Journey</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Journey Time</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Journey Metar</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Reached Metar</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Reached Time</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                    else if(event_type==4)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center" rowspan="2"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2">Purpose</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" colspan="4">Destination</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2">Mode</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2">Break Down Bill Amount</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center" rowspan="2"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';

                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center">From</td>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center">Time out</td>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center">To</td>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center">Time In</td>';
                                        html+='</tr>';

                                    }
                                    else if(event_type==5)
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">From Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">To Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Particulars</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Place</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                                    else
                                    {
                                        html+='<tr>';
                                        html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Date</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Movement Details</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center">Mode of Transportaion</td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                        html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                        html+='</tr>';
                                    }
                            html+='</thead>';
                            html+='<tbody id="">';
                            jQuery.each(json['result'],function(key,obj){
                                for (var i = 0; i < all_deduct_amount.length; i++) 
                                {
                                    var single_diduct_amount  = all_deduct_amount[i];
                                    var diduct_id = single_diduct_amount.split("__$");
                                    if(diduct_id[0]==obj.id)
                                    {
                                        var diduct_amount  = diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        var diduct_amount  = "";
                                    }
                                }
                                if(parseFloat(diduct_amount)<=0)//For 0 belance
                                {
                                    var diduct_amount  = "";
                                }
                                for (var i = 0; i < all_deduct_remarks.length; i++) 
                                {
                                    var single_diduct_remarks  = all_deduct_remarks[i];
                                    var diduct_id = single_diduct_remarks.split("__$");
                                    if(diduct_id[0]==obj.id)
                                    {
                                        var diduct_remarks  = diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        var diduct_remarks  = "";
                                    }
                                }
                                counter++;
                                html+='<tr>';
                                    if(all_ids.includes(obj.id))
                                    {
                                        html+='<td align="left"><input type="checkbox" checked name="chkBoxSelect_bill_'+counter+'" id="chkBoxSelect_bill_'+counter+'" /><input type="hidden" name="cost_id_'+counter+'" id="cost_id_'+counter+'" value="'+obj.id+'"></td>';
                                    }
                                    else
                                    {
                                        html+='<td align="left"><input type="checkbox" name="chkBoxSelect_bill_'+counter+'" id="chkBoxSelect_bill_'+counter+'" /><input type="hidden" name="cost_id_'+counter+'" id="cost_id_'+counter+'" value="'+obj.id+'"></td>';
                                    }
                                    
                                    if(event_type==1)
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.movement_details+'</td>';
                                        html+='<td align="center">'+obj.move_of_transfortaion+'</td>';
                                    }
                                    else if(event_type==2)
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.particulars+'</td>';
                                        html+='<td align="center">'+obj.place+'</td>';
                                    }
                                    else if(event_type==3)
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.description_of_journey+'</td>';
                                        html+='<td align="center">'+obj.journey_time+'</td>';
                                        html+='<td align="center">'+obj.journey_metar+'</td>';
                                        html+='<td align="center">'+obj.reached_metar+'</td>';
                                        html+='<td align="center">'+obj.reached_time+'</td>';
                                    }
                                    else if(event_type==4)
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.purpose+'</td>';
                                        html+='<td align="center">'+obj.from+'</td>';
                                        html+='<td align="center">'+obj.time_out+'</td>';
                                        html+='<td align="center">'+obj.to+'</td>';
                                        html+='<td align="center">'+obj.time_in+'</td>';
                                        html+='<td align="center">'+obj.mode+'</td>';
                                        html+='<td align="center">'+obj.breakdown_bill+'</td>';
                                    }
                                    else if(event_type==5)
                                    {
                                        html+='<td align="center">'+obj.from_date+'</td>';
                                        html+='<td align="center">'+obj.to_date+'</td>';
                                        html+='<td align="center">'+obj.particulars+'</td>';
                                        html+='<td align="center">'+obj.place+'</td>';
                                    }
                                    else
                                    {
                                        html+='<td align="center">'+obj.txrn_dt+'</td>';
                                        html+='<td align="center">'+obj.movement_details+'</td>';
                                        html+='<td align="center">'+obj.move_of_transfortaion+'</td>';
                                    }
                                    html+='<td align="center"><input type="hidden" name="orginal_amount_'+counter+'" id="orginal_amount_'+counter+'" value="'+obj.amount+'" style=""/>'+obj.amount+'</td>';
                                    html+='<td align="center"><input type="text" name="diduct_amount_'+counter+'" id="diduct_amount_'+counter+'" value="'+diduct_amount+'" style="width:200px;"/></td>';
                                    html+='<td align="center"><textarea name="deduct_remarks_'+counter+'" id="deduct_remarks_'+counter+'" style="width:200px;">'+diduct_remarks+'</textarea></td>';
                                html+='</tr>';
                            });
                            html+='<input type="hidden" name="hidden_event_id" id="hidden_event_id" value="'+event_id+'"><input type="hidden" name="hidden_total_bill_counter" id="hidden_total_bill_counter" value="'+counter+'"></tbody>';
                            html+='</table>';
                            document.getElementById("bill_details").style.visibility='visible';
                            jQuery("#bill_details_body").html(html);
                            jQuery("#bill_details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function call_service()
        {
            jQuery('#stuff_convence').jqxValidator('hide');
            jQuery("#bill_info_body").html('');
            var bill_month = jQuery("#bill_month").val();
            var vendor = jQuery("#staff").val();
            var year = jQuery("#year").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_expense_data_staff',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,vendor:vendor,bill_month:bill_month,year:year},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        jQuery("#load_button").hide();
                        jQuery("#re_generate").show();
                        jQuery("#district").jqxComboBox({ disabled: true });
                        jQuery("#staff").jqxComboBox({ disabled: true });
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
                        jQuery("#year").jqxDropDownList({ disabled: true });
              },
                error:   function(model, xhr, options){
                    alert('failed');
                },
            });
        }
        function CheckAll_2(checkAllBox)                            
        {                           
            var ChkState=checkAllBox.checked;
            var number=jQuery("#billcount").val();
            var counter=0;
            var amount = 0;
            var event_amount = 0;
            if (ChkState==true) 
            {
                for(var i=1; i<=number; i++){     
                    var x = document.getElementById("chkBoxSelect"+i).disabled;
                    if(x)   
                    {
                        continue;
                    }          
                    jQuery("#event_delete_"+i).val(0);
                    var event_id = jQuery("#event_id_"+i).val();
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;
                    counter++;  
                    amount = parseFloat(jQuery("#event_amount_"+event_id).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }
            }   
            else{
                for(var i=1; i<=number; i++){               
                    jQuery("#event_delete_"+i).val(1);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;                         
                }
                counter=0;
                event_amount=0;
            }           
            jQuery('#selected_amount').html(event_amount.toFixed(2));   
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2));             
        }   
        function CheckChanged_2(checkAllBox,counter)
        {
            var ChkState=checkAllBox.checked;
            if (ChkState==true) 
            {
                jQuery("#event_delete_"+counter).val(0);
            }
            else
            {
                jQuery("#event_delete_"+counter).val(1);
            }
            var number=jQuery("#billcount").val();
            var checkco=0;
            var amount = 0;
            var event_amount = 0;
            for(var i=1; i<=number; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    var event_id = jQuery("#event_id_"+i).val();
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+event_id).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
            document.getElementById("checkAll").checked=true;
            }else{
            document.getElementById("checkAll").checked=false;
            }   
            jQuery('#selected_amount').html(event_amount.toFixed(2));           
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2));         
        }
        function bill_validation()
        {
            var counter=0;
            var total_row = jQuery('#billcount').val();
            var check=0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true)
                {
                    check++;
                }
            }
            //For Add action without select any bill
            if(jQuery("#add_edit").val()=='add')
            {
                if (check<1)
                {
                    if (confirm("There is no bill selected. Are you want to cancel request?"))
                    {
                        
                        clear_form();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return true;
                }
            }
            else{
                if (check<1)
                {
                    return show_confrimation_pop_up('staff_bill');
                }
                else
                {
                    return true;
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
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Entry Form</li>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 10px;" class="back_image">
                                    <form class="form" name="stuff_convence" id="stuff_convence" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <input type="hidden" id="hidden_bill_amount" value="" name="hidden_bill_amount">
                                        <input type="hidden" id="delete_reason_staff_bill" value="" name="delete_reason_staff_bill">
                                        <input type="hidden" id="hidden_vendor_id" value="" name="hidden_vendor_id">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Serial No.</td>
                                                                <td width="60%" ><input name="sl_no" type="text" tabindex="1" readonly class="" style="width:250px" id="sl_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr id="month_row">
                                                                <td width="40%" style="font-weight: bold;"><strong>Month Of Bill<span style="color:red">*</span> </td>
                                                                <td width="60%">
                                                                    <div id="bill_month" name="bill_month" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <div id="year" name="year" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <input type="button" value="Load" id="load_button" style="margin-left: 5px;width:50px !important;height:25px;float:left" onclick="load_expense()" />
                                                                    <input name="re_generate" id="re_generate" class="crmbutton small create" onclick="clear_form()" value="Reload" type="button" style="display: none;margin-left: 5px;height:25px;float:left">
                                                                </td>
                                                            </tr>
                                                            <tr id="district_row">
                                                                <td width="40%" style="font-weight: bold;">District</td>
                                                                <td width="60%" ><div id="district" name="district" tabindex="3" style="padding-left: 3px" onchange="get_dropdown_data()"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Staff</td>
                                                                <td width="60%" id="drop_down_td"><div id="staff" tabindex="4" name="staff" style="padding-left: 3px" ></div></td>
                                                                <td width="60%" style="display:none" id="text_td"><span id="staff_name"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Despatch No.</td>
                                                                <td width="60%" ><input name="dispatch_no" readonly type="text" tabindex="5" class="" style="width:250px" id="dispatch_no" value="Auto Generate" /></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Memo Remarks</td>
                                                                <td width="60%" ><textarea name="memo_remarks" tabindex="10" class="text-input-big" id="memo_remarks" style="height:40px !important;width:250px"><?=isset($result->memo_remarks)?$result->memo_remarks:''?></textarea></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Approver List<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="approver_list" name="approver_list" style="padding-left: 3px" tabindex="11"></div></td>
                                                            </tr> 
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Tax Vat Text<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="tax_vat_text" name="tax_vat_text" style="padding-left: 3px" tabindex="11"></div></td>
                                                            </tr>  
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Payment Type<span style="color:red">*</span></td>
                                                                <td width="60%" ><div id="payment_type" name="payment_type" tabindex="12" style="padding-left: 3px;float:left"></div></td>
                                                            </tr>   
                                                            <tr id="ac_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">AC NO.<span style="color:red">*</span></td>
                                                                <td width="60%" ><input name="bank_ac_ac" type="text" tabindex="13" class="" style="width:250px" id="bank_ac_ac" value="" /></td>
                                                            </tr>
                                                            <tr id="rtgs_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">Rtgs Info<span style="color:red">*</span> </td>
                                                                <td width="60%" >
                                                                    <div id="bank" name="bank" style="padding-left: 3px" tabindex="13"></div>
                                                                    <div style="background-color:#eaeaea;padding:10px;width:233px" id="spfm">
                                                                    AC NO.<span style="color:red">*</span><br/><input name="ac_no_rtgs" onblur="" tabindex="14" type="text" class="" style="width:225px" id="ac_no_rtgs" value="" /><br/>
                                                                    Routing No.<br/><input name="routing_no" onblur="" tabindex="15" type="text" class="" style="width:225px" id="routing_no" value="" />
                                                                </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row">
                                                <td colspan="2">
                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bill Info</span>
                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                            <thead>
                                                                <tr>
                                                                    <td width="2%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></td>
                                                                    <td width="3%" style="font-weight: bold;text-align:center">SL</td>
                                                                    <td width="20%" style="font-weight: bold;text-align:center">Staff Pin</td>
                                                                    <td width="20%" style="font-weight: bold;text-align:center">Staff Name</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Conveyence Type</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Details</td>
                                                                    <td width="25%" style="font-weight: bold;text-align:center">Amount</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bill_info_body">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                        <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                                <? if(EDIT==1){?>
                                                <tr id="up_button" style="display: none;">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                        <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                    </div>
                                </div>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    &nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row">
                                <td>Attachment (If Any):</td>
                                <td>
                                    <span id="file_for_finance"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="bill_details" style="display: none;">
        <div style=""><strong>Bill Details</strong></div>
        <div style="" id="details_table">
            <form class="form" name="" id="" method="post" action="" enctype="">
            <span id="bill_details_body"></span>
            <div id="preview_bill_details" class="wrapper">
                </br></br>
                <input type="button" class="buttonSend" id="save" onclick="check_staff_conv_bill()" value="Save">
            </div>
            </form>
        </div>
    </div>
<?php endif ?>

<!-- For Court Entertainment -->
<?php if ($operation=='court_enter' && VIEWCOURTENTER==1): ?>

    <script type="text/javascript">
            var start=1990;
            let date =  new Date().getFullYear();
            var year = [];
            for (var i = date; i >=start; i--) {
                year.push({ value: i, label: i });
            }
            var legal_district = [];
            var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var employee_type = [<? $i=1; foreach($employee_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var approver_list = [<? $i=1; foreach($approver_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var theme = getDemoTheme();
            rules2=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                }
            ];
            rules3=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                }
            ];
            jQuery(document).ready(function () {
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: '98%', height: 25});
            jQuery("#year").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Year", source: year, width: 250, height: 25});
            jQuery("#approver_list").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Select Approver List",filterable: true,searchMode: 'containsignorecase', source: approver_list, width: 250, height: 25});
            jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Select Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 150, height: 25});
            jQuery("#employee_type").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Employee Type",filterable: true,searchMode: 'containsignorecase', source: employee_type, width: 150, height: 25});
            //jQuery("#employee_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Employee Type", source: employee_type, width: 180, height: 25});
            jQuery('#year').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
             });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'e_by_id', type: 'int'},
                        { name: 'sts', type: 'int'},
                        { name: 'bill_type', type: 'int'},
                        { name: 'status', type: 'string'},
                        { name: 'sl_no', type: 'string'},
                        { name: 'dispatch_no', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'},
                        { name: 'stf_by', type: 'string'},
                        { name: 'stf_dt', type: 'string'},
                        { name: 'bill_months', type: 'string'},
                        { name: 'bill_amount', type: 'string'},
                        { name: 'invoice_amount', type: 'string'},
                        { name: 'discount_amount', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/court_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
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
                    loadError: function(xhr, status, error){
                        alert(error);
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-250;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                        <? if(EDIT==1){?>
                          { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27 || dataRecord.sts==29)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else
                                {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOCHECKER==1){?>
                          { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 37){
                                        return '<div style=" margin-top: 8px;text-align:center">S</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                        <? }?>
                        <? if(VERIFY==1){?>
                          { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 26 || dataRecord.sts == 30 || dataRecord.sts==89){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.sts == 29) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        { text: 'TS', menu: false, datafield: 'Download', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.sts == 29){
                                //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_court_enter_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_court_enter_topsheet/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/icon_xls.gif"></div>';
                            }

                            }
                        },
                        // { text: 'BM', menu: false, datafield: 'Billmemo', align:'center', editable: false, sortable: false, width: '3%',
                        //     cellsrenderer: function (row) {
                        //     editrow = row;
                        //     var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        //     if(dataRecord.sts == 29){
                        //         //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_court_enter_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                        //         return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_court_enter_memo/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/icon_xls.gif"></div>';
                        //     }

                        //     }
                        // },
                        <? if(SENDTOFINANCE==1){?>
                          { text: 'STF', datafield: 'sendtofinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtofinance\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 70) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(VERIFYFINANCE==1){?>
                          { text: 'VF', datafield: 'verifyfinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 70){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verifyfinance\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        { text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'SL No.', datafield: 'sl_no', editable: false,align:'left',cellsalign:'center', sortable: true, menu: true, width: '11%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\','+dataRecord.bill_type+')"><span>'+dataRecord.sl_no+'</span></a></div>';
                                
                            }
                          },
                        { text: 'Despatch No.', datafield: 'dispatch_no',editable: false, width: '17%', align:'left',cellsalign:'left'},
                        { text: 'Bill Amount', datafield: 'bill_amount',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Discount Amount', datafield: 'discount_amount',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Invoice Amount', datafield: 'invoice_amount',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Bill Months', datafield: 'bill_months',editable: false, width: '20%', align:'left',cellsalign:'left'},
                        { text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance By', datafield: 'stf_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance Date', datafield: 'stf_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });   
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        //initGrid();
                        break;
                    case 1:
                        initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
                jQuery('#stuff_convence').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>

            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#stuff_convence').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#stuff_convence').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#stuff_convence').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#stuff_convence').jqxValidator('validate', validationResult);        
            });
            jQuery("#bill_details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false });
            jQuery('#bill_details').jqxWindow({ showCloseButton: false }); 
            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');        
            });
        });
        function call_ajax_submit(){
            
            var postdata = jQuery('#stuff_convence').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>bill_ho/add_edit_court_bill/"+add_edit+"/"+edit_row,
                data : postdata,
                datatype: "json",
                async:false,
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    //console.log(json);
                    //csrf_tokens=json.csrf_token;
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
                    }
                    var msg='';
                    if(edit_row>0){
                        msg='Updated';
                    }else{
                        msg="Saved";
                    }
                    clear_form();
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
                    if(add_edit=='edit'){
                        jQuery("#in_up_loading").hide();
                        jQuery("#in_up_button").show();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
                    }else{
                        jQuery("#in_req_button").show();
                        jQuery("#in_req_loading").hide();
                    }
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');

                }
            });
        }
        
        function get_dropdown_data(){
            var item = jQuery("#district").jqxComboBox('getSelectedItem');
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
                            jQuery("#staff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 250, height: 25});
                            jQuery('#staff').focusout(function() {
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
                jQuery("#staff").jqxComboBox('clearSelection');
                jQuery("#staff").val('');
            }
        }
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_court_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        var csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#search_area").hide();
                        jQuery('#searchTable').html(json.str);
                        jQuery("#bill_info_row").show();
                        CheckChanged_2('','');
                        jQuery('#show_emp_type').html(json.ops_emp_type);
                        jQuery('#show_billing_month').html(json.ops_month);
                        jQuery("#sl_no").val(json['result'].sl_no);
                        jQuery("#dispatch_no").val(json['result'].dispatch_no);
                        var educqu=json['result'].approver_list.split(',');
                        for (var i = 0; i < educqu.length; i++)
                        {
                            jQuery("#approver_list").jqxDropDownList('checkItem', educqu[i]);
                        }
                        
                        
              },
                error:   function(model, xhr, options){
                    alert('failed');
                    clear_form();
                },
            });
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
            
        }
        function clear_form(){
            jQuery("#sl_no").val('Auto Generate');
            jQuery("#dispatch_no").val('Auto Generate');
            //jQuery("#dispatch_no").val('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery('#searchTable').html('');
            jQuery('#hidden_billing_month').val('');
            jQuery('#hidden_bill_amount').val('');
            jQuery('#hidden_emp_type').val('');
            jQuery('#hidden_staff_pin').val('');
            jQuery("#search_area").show();
        }
        function search_bill() 
        {

            var staff_pin = jQuery('#staff_pin').val();
            var bill_month = jQuery('#bill_month').val();
            var employee_type=jQuery('#employee_type').val();
            var legal_region=jQuery('#legal_region').val();
            var legal_district=jQuery('#legal_district').val();
            var year=jQuery('#year').val();
            if(bill_month=='' && employee_type=='' && year=='')
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
                    url: "<?=base_url()?>index.php/bill_ho/get_expense_data_court/",
                    data : {[csrfName]: csrfHash,year:year,legal_district:legal_district,legal_region:legal_region,bill_month:bill_month,employee_type:employee_type,staff_pin: staff_pin},
                    datatype: "html",
                    success: function(response){
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#grid_loading").hide();
                        jQuery("#grid_search").show();
                        jQuery('#searchTable').html(json.str);
                        jQuery('#hidden_billing_month').val(bill_month);
                        jQuery('#hidden_emp_type').val(employee_type);
                        jQuery('#hidden_staff_pin').val(staff_pin);
                        jQuery('#show_emp_type').html(json.ops_emp_type);
                        jQuery('#show_billing_month').html(json.ops_month);
                        

                    }
                });
            }
        }

        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").show();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/court_bill_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_for_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_for_finance_select" name="hidden_file_for_finance_select" value="0">';
                            html+='<span id="hidden_file_for_finance">';
                            jQuery('#file_for_finance').html(html);

                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_from_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_from_finance_select" name="hidden_file_from_finance_select" value="0">';
                            html+='<span id="hidden_file_from_finance">';
                            jQuery('#file_from_finance').html(html);

                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
        function check_court_enter_bill()
        {
            var number=jQuery("#hidden_total_bill_counter").val();
            var event_id=jQuery("#hidden_event_id").val();
            var all_bills = "";
            var deduct_amount = "";
            var deduct_remarks = "";
            var checkco=0;
            var total_amount = 0;
            for(var i=1; i<=number; i++){                                                       
                if(document.getElementById("chkBoxSelect_bill_"+i).checked==true){
                    checkco++; 
                    if (isNaN(jQuery("#diduct_amount_"+i).val())) {
                        alert('Please insert only numeric value');
                        jQuery("#diduct_amount_"+i).focus();
                        return false;
                    }
                    if(parseFloat(jQuery("#diduct_amount_"+i).val())>parseFloat(jQuery("#orginal_amount_"+i).val()))
                    {
                        alert('Diduction Amount Bigger Then Amount');
                        jQuery("#diduct_amount_"+i).focus();
                        return false;
                    }
                    if(parseFloat(jQuery("#diduct_amount_"+i).val())<0)
                    {
                        alert('Provide Valid Diduction Amount');
                        jQuery("#diduct_amount_"+i).focus();
                        return false;
                    }
                    if(jQuery("#diduct_amount_"+i).val()!='' && parseFloat(jQuery("#diduct_amount_"+i).val())>0 && jQuery("#deduct_remarks_"+i).val()=='')
                    {
                        alert("Please Give Diduction Remarks");
                        jQuery("#deduct_remarks_"+i).focus();
                        return false;
                    }
                    total_amount = total_amount+parseFloat(jQuery("#orginal_amount_"+i).val());
                    all_bills+=jQuery("#cost_id_"+i).val()+',';
                    deduct_amount+=jQuery("#cost_id_"+i).val()+'__$'+jQuery("#diduct_amount_"+i).val()+'####';
                    deduct_remarks+=jQuery("#cost_id_"+i).val()+'__$'+jQuery("#deduct_remarks_"+i).val()+'####';
                }                                           
            }
            jQuery('#event_memo_id_'+event_id).val(all_bills);
            jQuery('#event_diduct_amount_'+event_id).val(deduct_amount);
            jQuery('#event_diduct_remarks_'+event_id).val(deduct_remarks);
            jQuery('#event_amount_'+event_id).val(total_amount);
            jQuery('#show_amount_'+event_id).html(total_amount);
            //For the parent grid selection
            var number=jQuery("#billcount").val();
            var checkco=0;
            var amount = 0;
            var event_amount = 0;
            for(var i=1; i<=number; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    var event_id = jQuery("#event_id_"+i).val();
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+event_id).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
            document.getElementById("checkAll").checked=true;
            }else{
            document.getElementById("checkAll").checked=false;
            }   
            jQuery('#selected_amount').html(event_amount.toFixed(2));           
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2)); 
            jQuery("#bill_details").jqxWindow('close');
        }
        function bill_details(event_id)
        {
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/get_court_enter_all_bill",
                data: { [csrfName]: csrfHash,event_id : event_id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json['result'])
                        {
                            var diduct_amount = jQuery('#event_diduct_amount_'+event_id).val();
                            var all_deduct_amount = diduct_amount.split("####");
                            var event_ids = jQuery('#event_memo_id_'+event_id).val();
                            var all_ids = event_ids.split(",");
                            var diduct_remarks = jQuery('#event_diduct_remarks_'+event_id).val();
                            var all_deduct_remarks = diduct_remarks.split("####");
                            var counter=0;
                            var html="";
                            html+='<table style="width: 100%;" class="preview_table2">';
                            html+='<thead>';
                                html+='<tr>';
                                    html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                    html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>Sl</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Loan AC</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>AC Name</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Case Type</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Case Number</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Activities Name</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Activities Date</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                html+='</tr>';
                            html+='</thead>';
                            html+='<tbody id="">';
                            jQuery.each(json['result'],function(key,obj){
                                for (var i = 0; i < all_deduct_amount.length; i++) 
                                {
                                    var single_diduct_amount  = all_deduct_amount[i];
                                    var diduct_id = single_diduct_amount.split("__$");
                                    if(diduct_id[0]==obj.id)
                                    {
                                        var diduct_amount  = diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        var diduct_amount  = "";
                                    }
                                }
                                for (var i = 0; i < all_deduct_remarks.length; i++) 
                                {
                                    var single_diduct_remarks  = all_deduct_remarks[i];
                                    var diduct_id = single_diduct_remarks.split("__$");
                                    if(diduct_id[0]==obj.id)
                                    {
                                        var diduct_remarks  = diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        var diduct_remarks  = "";
                                    }
                                }
                                counter++;
                                html+='<tr>';
                                    if(all_ids.includes(obj.id))
                                    {
                                        html+='<td align="left"><input type="checkbox" checked name="chkBoxSelect_bill_'+counter+'" id="chkBoxSelect_bill_'+counter+'" /><input type="hidden" name="cost_id_'+counter+'" id="cost_id_'+counter+'" value="'+obj.id+'"></td>';
                                    }
                                    else
                                    {
                                        html+='<td align="left"><input type="checkbox" name="chkBoxSelect_bill_'+counter+'" id="chkBoxSelect_bill_'+counter+'" /><input type="hidden" name="cost_id_'+counter+'" id="cost_id_'+counter+'" value="'+obj.id+'"></td>';
                                    }
                                    html+='<td align="center">'+counter+'</td>';
                                    html+='<td align="center">'+obj.loan_ac+'</td>';
                                    html+='<td align="center">'+obj.ac_name+'</td>';
                                    html+='<td align="center">'+obj.case_number+'</td>';
                                    html+='<td align="center">'+obj.req_type_name+'</td>';
                                    html+='<td align="center">'+obj.activities_name+'</td>';
                                    html+='<td align="center">'+obj.txrn_dt+'</td>';
                                    html+='<td align="center"><input type="hidden" name="orginal_amount_'+counter+'" id="orginal_amount_'+counter+'" value="'+obj.amount+'" style=""/>'+obj.amount+'</td>';
                                    html+='<td align="center"><input type="text" name="diduct_amount_'+counter+'" id="diduct_amount_'+counter+'" value="'+diduct_amount+'" style="width:200px;"/></td>';
                                    html+='<td align="center"><textarea name="deduct_remarks_'+counter+'" id="deduct_remarks_'+counter+'" style="width:200px;">'+diduct_remarks+'</textarea></td>';
                                html+='</tr>';
                            });
                            html+='<input type="hidden" name="hidden_event_id" id="hidden_event_id" value="'+event_id+'"><input type="hidden" name="hidden_total_bill_counter" id="hidden_total_bill_counter" value="'+counter+'"></tbody>';
                            html+='</table>';
                            document.getElementById("bill_details").style.visibility='visible';
                            jQuery("#bill_details_body").html(html);
                            jQuery("#bill_details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function bill_details_edit(event_id,bill_id)
        {
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/get_court_enter_all_bill_edit",
                data: { [csrfName]: csrfHash,event_id : event_id,bill_id:bill_id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json['result'])
                        {
                            var diduct_amount = jQuery('#event_diduct_amount_'+event_id).val();
                            var all_deduct_amount = diduct_amount.split("####");
                            var event_ids = jQuery('#event_memo_id_'+event_id).val();
                            var all_ids = event_ids.split(",");
                            var diduct_remarks = jQuery('#event_diduct_remarks_'+event_id).val();
                            var all_deduct_remarks = diduct_remarks.split("####");
                            var counter=0;
                            var html="";
                            html+='<table style="width: 100%;" class="preview_table2">';
                            html+='<thead>';
                                html+='<tr>';
                                    html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>S</strong></td>';
                                    html+='<td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>Sl</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Loan AC</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>AC Name</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Case Type</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Case Number</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Activities Name</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Activities Date</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Amount<span style="color:red">*</span></strong></td>';
                                    html+='<td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Deduction Remarks<span style="color:red">*</span></strong></td>';
                                html+='</tr>';
                            html+='</thead>';
                            html+='<tbody id="">';
                            jQuery.each(json['result'],function(key,obj){
                                for (var i = 0; i < all_deduct_amount.length; i++) 
                                {
                                    var single_diduct_amount  = all_deduct_amount[i];
                                    var diduct_id = single_diduct_amount.split("__$");
                                    if(diduct_id[0]==obj.id)
                                    {
                                        var diduct_amount  = diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        var diduct_amount  = "";
                                    }
                                }
                                if(parseFloat(diduct_amount)<=0)//For 0 belance
                                {
                                    var diduct_amount  = "";
                                }
                                for (var i = 0; i < all_deduct_remarks.length; i++) 
                                {
                                    var single_diduct_remarks  = all_deduct_remarks[i];
                                    var diduct_id = single_diduct_remarks.split("__$");
                                    if(diduct_id[0]==obj.id)
                                    {
                                        var diduct_remarks  = diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        var diduct_remarks  = "";
                                    }
                                }
                                counter++;
                                html+='<tr>';
                                    if(all_ids.includes(obj.id))
                                    {
                                        html+='<td align="left"><input type="checkbox" checked name="chkBoxSelect_bill_'+counter+'" id="chkBoxSelect_bill_'+counter+'" /><input type="hidden" name="cost_id_'+counter+'" id="cost_id_'+counter+'" value="'+obj.id+'"></td>';
                                    }
                                    else
                                    {
                                        html+='<td align="left"><input type="checkbox" name="chkBoxSelect_bill_'+counter+'" id="chkBoxSelect_bill_'+counter+'" /><input type="hidden" name="cost_id_'+counter+'" id="cost_id_'+counter+'" value="'+obj.id+'"></td>';
                                    }
                                    html+='<td align="left">'+counter+'</td>';
                                    html+='<td align="center">'+obj.loan_ac+'</td>';
                                    html+='<td align="center">'+obj.ac_name+'</td>';
                                    html+='<td align="center">'+obj.case_number+'</td>';
                                    html+='<td align="center">'+obj.req_type_name+'</td>';
                                    html+='<td align="center">'+obj.activities_name+'</td>';
                                    html+='<td align="center">'+obj.txrn_dt+'</td>';
                                    html+='<td align="center"><input type="hidden" name="orginal_amount_'+counter+'" id="orginal_amount_'+counter+'" value="'+obj.amount+'" style=""/>'+obj.amount+'</td>';
                                    html+='<td align="center"><input type="text" name="diduct_amount_'+counter+'" id="diduct_amount_'+counter+'" value="'+diduct_amount+'" style="width:200px;"/></td>';
                                    html+='<td align="center"><textarea name="deduct_remarks_'+counter+'" id="deduct_remarks_'+counter+'" style="width:200px;">'+diduct_remarks+'</textarea></td>';
                                html+='</tr>';
                            });
                            html+='<input type="hidden" name="hidden_event_id" id="hidden_event_id" value="'+event_id+'"><input type="hidden" name="hidden_total_bill_counter" id="hidden_total_bill_counter" value="'+counter+'"></tbody>';
                            html+='</table>';
                            document.getElementById("bill_details").style.visibility='visible';
                            jQuery("#bill_details_body").html(html);
                            jQuery("#bill_details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function call_service()
        {
            jQuery('#stuff_convence').jqxValidator('hide');
            jQuery("#bill_info_body").html('');
            var bill_month = jQuery("#bill_month").val();
            var vendor = jQuery("#staff").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_expense_data_court',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,vendor:vendor,bill_month:bill_month},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        jQuery("#district").jqxComboBox({ disabled: true });
                        jQuery("#staff").jqxComboBox({ disabled: true });
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
                        jQuery("#load_button").hide();
                        jQuery("#re_generate").show();
              },
                error:   function(model, xhr, options){
                    alert('failed');
                },
            });
        }
        function CheckAll_2(checkAllBox)                            
        {                           
            var ChkState=checkAllBox.checked;
            var number=jQuery("#billcount").val();
            var counter=0;
            var amount = 0;
            var event_amount = 0;
            if (ChkState==true) 
            {
                for(var i=1; i<=number; i++){     
                    var x = document.getElementById("chkBoxSelect"+i).disabled;
                    if(x)   
                    {
                        continue;
                    }          
                    jQuery("#event_delete_"+i).val(0);
                    var event_id = jQuery("#event_id_"+i).val();
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;
                    counter++;  
                    amount = parseFloat(jQuery("#event_amount_"+event_id).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }
            }   
            else{
                for(var i=1; i<=number; i++){               
                    jQuery("#event_delete_"+i).val(1);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;                         
                }
                counter=0;
                event_amount=0;
            }           
            jQuery('#selected_amount').html(event_amount.toFixed(2));   
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2));             
        }   
        function CheckChanged_2(checkAllBox,counter)
        {
            var ChkState=checkAllBox.checked;
            if (ChkState==true) 
            {
                jQuery("#event_delete_"+counter).val(0);
            }
            else
            {
                jQuery("#event_delete_"+counter).val(1);
            }
            var number=jQuery("#billcount").val();
            var checkco=0;
            var amount = 0;
            var event_amount = 0;
            for(var i=1; i<=number; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    var event_id = jQuery("#event_id_"+i).val();
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+event_id).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
            document.getElementById("checkAll").checked=true;
            }else{
            document.getElementById("checkAll").checked=false;
            }   
            jQuery('#selected_amount').html(event_amount.toFixed(2));           
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2));         
        }
        function bill_validation()
        {
            var counter=0;
            var total_row = jQuery('#billcount').val();
            var check=0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true)
                {
                    check++;
                }
            }
            //For Add action without select any bill
            if(jQuery("#add_edit").val()=='add')
            {
                if (check<1)
                {
                    if (confirm("There is no bill selected. Are you want to cancel request?"))
                    {
                        
                        clear_form();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return true;
                }
            }
            else{
                if (check<1)
                {
                    return show_confrimation_pop_up('court_bill');
                }
                else
                {
                    return true;
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
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Entry Form</li>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 10px;" class="back_image">
                                    <div id="search_area">
                                            <form method="POST" name="form" id="form"  style="margin:0px;">
                                               <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                               
                                               <div style="padding: 0px;width:100%;height:80px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                                    <table id="deal_body" style="display:block;width:90%">
                                                        <tr>
                                                            <td style="text-align:right;width:12%"><strong>Employee Type&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="employee_type" name="employee_type"></div></td>
                                                            <td style="text-align:right;width:11%"><strong>Year&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="year" name="year"></div></td>
                                                            <td style="text-align:right;width:11%"><strong>Billing Month&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="bill_month" name="bill_month"></div></td>
                                                            <td style="text-align:right;width:7%"><strong>Staff Pin</strong></td>
                                                            <td style="width:15%"><input name="staff_pin" tabindex="" type="text" class="" style="width:150px" id="staff_pin" value=""/></td>
                                                            <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_bill()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:right;width:12%"><strong>Region&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="legal_region" name="legal_region"></div></td>
                                                            <td style="text-align:right;width:11%"><strong>District&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="legal_district" name="legal_district"></div></td>
                                                            <td style="text-align:right;width:11%"></td>
                                                            <td style="width:10%"></td>
                                                            <td style="text-align:right;width:7%"></td>
                                                            <td style="width:15%"></td>
                                                            <td  style="text-align:right;width:5%">
                                                            </td>
                                                        </tr>
                                                    </table>
                                              </div>
                                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                                              
                                            </form>
                                        </div>
                                        <div id="bill_form_div">
                                            <form class="form" name="stuff_convence" id="stuff_convence" method="post" action="" enctype="multipart/form-data">
                                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <input type="hidden" id="add_edit" value="add" name="add_edit">
                                                <input type="hidden" id="hidden_staff_pin" value="" name="hidden_staff_pin">
                                                <input type="hidden" id="edit_row" value="" name="edit_row">
                                                <input type="hidden" id="hidden_bill_amount" value="" name="hidden_bill_amount">
                                               <input type="hidden" id="delete_reason_court_bill" value="" name="delete_reason_court_bill">
                                                <table style="width:100%;margin-top:25px" id="tab1Table" >
                                                    <tbody>
                                                        <tr>
                                                            <td width="50%">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;">Serial No.<span style="color:red">*</span> </td>
                                                                        <td width="60%" ><input name="sl_no" type="text" tabindex="1" readonly class="" style="width:250px" id="sl_no" value="Auto Generate" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;"><strong>Employee Type</td>
                                                                        <td width="60%">
                                                                            <strong><span id="show_emp_type"></span></strong>
                                                                            <input type="hidden" name="hidden_emp_type" id="hidden_emp_type" value="">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;">Despatch No.<span style="color:red">*</span> </td>
                                                                        <td width="60%" ><input name="dispatch_no" type="text" readonly tabindex="5" class="" style="width:250px" id="dispatch_no" value="Auto Generate" /></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="50%" style="display: contents;">
                                                                <table style="width: 100%;">
                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;"><strong>Month Of Bill</td>
                                                                        <td width="60%">
                                                                            <strong><span id="show_billing_month"></span></strong>
                                                                            <input type="hidden" name="hidden_billing_month" id="hidden_billing_month" value="">
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td width="40%" style="font-weight: bold;">Approver List<span style="color:red">*</span> </td>
                                                                        <td width="60%" ><div id="approver_list" name="approver_list" style="padding-left: 3px" tabindex="11"></div></td>
                                                                    </tr>  
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        <td colspan="2">
                                                            <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                                <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bill Info</span>
                                                                <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                    <thead>
                                                                        <tr>
                                                                            <td style="width:5%;border:1px solid #a0a0a0;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></td>
                                                                            <td style="width:5%;border:1px solid #a0a0a0;text-align:center"><strong>Sl</strong></td>
                                                                            <td style="width:15%;border:1px solid #a0a0a0;text-align:center"><strong>Pin</strong></td>
                                                                            <td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Employee Name</strong></td>
                                                                            <td style="width:15%;border:1px solid #a0a0a0;text-align:center"><strong>Employee AC number</strong></td>
                                                                            <td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Base Office</strong></td>
                                                                            <td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Region</strong></td>
                                                                            <td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Case Account Details</strong></td>
                                                                            <td style="width:10%;border:1px solid #a0a0a0;text-align:center"><strong>Amount</strong></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="searchTable">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                        <? if(ADD==1){?>
                                                        <tr id="add_button">
                                                            <td colspan="2" style="text-align: center;">
                                                                <br/>
                                                                <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                                <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                                <br/><br/><br/>
                                                            </td>
                                                        </tr>
                                                        <? } ?>
                                                        <? if(EDIT==1){?>
                                                        <tr id="up_button" style="display: none;">
                                                            <td colspan="2" style="text-align: center;">
                                                                <br/>
                                                                <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                                <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                                <br/><br/><br/>
                                                            </td>
                                                        </tr>
                                                        <? } ?>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    
                                    </div>
                                </div>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    &nbsp;&nbsp;&nbsp;
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/bill_ho/bulk_operation/apv/court_enter" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
                                    <strong>BM = </strong> Bill Memo&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="court_entertainment" id="court_entertainment" value="court_entertainment" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
                <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row">
                                <td>Attachment (If Any):</td>
                                <td>
                                    <span id="file_for_finance"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="bill_details" style="display: none;">
        <div style=""><strong>Bill Details</strong></div>
        <div style="" id="details_table">
            <form class="form" name="" id="" method="post" action="" enctype="">
            <span id="bill_details_body"></span>
            <div id="preview_bill_details" class="wrapper">
                </br></br>
                <input type="button" class="buttonSend" id="save" onclick="check_court_enter_bill()" value="Save">
            </div>
            </form>
        </div>
    </div>
<?php endif ?>

<!-- For Lawyer Bill -->
<?php if ($operation=='lawyer_bill' && VIEWLAWYERBILL==1): ?>

    <script type="text/javascript">
        var start=1990;
        let date =  new Date().getFullYear();
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        var tax_vat_text = [<? $i=1; foreach($tax_vat_text as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var status_grid = [<? $i=1; foreach($status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var lawyer = [];
        var legal_district = [];
        var bank = [<? $i=1; foreach($bank as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var payment_type = [<? $i=1; foreach($payment_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        //var legal_am = [<? $i=1; foreach($legal_am as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->pin.')"}'; $i++;}?>];
        var approver_list = [<? $i=1; foreach($approver_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
           var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var theme = getDemoTheme();
            rules2=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#lawyer input").focus();
                        return false;
                    }
                }  
                },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#memo_remarks', message: 'required!', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() == '' && jQuery("#special_bill_sts").val()=='1')
                    {
                        jQuery("#memo_remarks").focus();
                        return false;
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            rules3=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'required!', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() == '' && jQuery("#special_bill_sts").val()=='1')
                    {
                        jQuery("#memo_remarks").focus();
                        return false;
                    }
                    return true;

                } },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            jQuery(document).ready(function () {
            // jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 100, height: 25});
            // jQuery("#year").jqxDropDownList('val', date);
            jQuery("#year").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Year",filterable: true,searchMode: 'containsignorecase', source: year, width: 100, height: 25});
            //jQuery("#year").jqxDropDownList('val', date);
            jQuery("#year").jqxDropDownList('checkItem', date);
            jQuery("#tax_vat_text").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Tax Vat Text", source: tax_vat_text, width: 250, height: 25});
            jQuery("#approver_list").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Select Approver List",filterable: true,searchMode: 'containsignorecase', source: approver_list, width: 250, height: 25});
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
            jQuery("#lawyer_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: '98%', height: 25});
            jQuery("#payment_type").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Payment Type", source: payment_type, width: 250, height: 25});
            jQuery("#bank").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Bank", source: bank, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#legal_region_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: '98%', height: 25});
            jQuery("#status_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Status", source: status_grid, width: '98%', height: 25});
            jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});
            jQuery("#legal_district_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: '98%', height: 25});
            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');        
            });
            jQuery('#legal_region_grid').bind('change', function (event) {
                change_dropdown('legal_region_grid');        
            });
            jQuery('#legal_district').bind('change', function (event) {
                change_dropdown('legal_district_lawyer');        
            });
            jQuery('#legal_district_grid').bind('change', function (event) {
                change_dropdown('legal_district_lawyer_grid');        
            });
            <?php if (check_group('1')): ?>
                change_dropdown('legal_region','<?=$this->session->userdata['ast_user']['legal_region']?>');
            <?php endif ?>
            jQuery('#payment_type,#bank,#lawyer,#tax_vat_text,#legal_region,#legal_district').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
             });
            jQuery('#lawyer').bind('change', function (event) {
                var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    get_lawyer_email_phone(item.value);
                }
            });
            jQuery('#payment_type').bind('change', function (event) {
                jQuery('#lawyer_bill_form').jqxValidator('hide');
                jQuery("#bank_ac_ac").val('');
                jQuery("#bank").val('');
                jQuery("#ac_no_rtgs").val('');
                jQuery("#routing_no").val('');
                jQuery("#bank").jqxComboBox('clearSelection');
                var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    if (item.value==1)
                    {
                        jQuery("#ac_row").show();
                        jQuery("#rtgs_row").hide();
                    }
                    else
                    {
                        jQuery("#ac_row").hide();
                        jQuery("#rtgs_row").show();
                    }
                }
                else{
                    jQuery("#ac_row").hide();
                    jQuery("#rtgs_row").hide();
                }
            });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'e_by_id', type: 'int'},
                        { name: 'sts', type: 'int'},
                        { name: 'bill_type', type: 'int'},
                        { name: 'status', type: 'string'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'region_name', type: 'string'},
                        { name: 'district_name', type: 'string'},
                        { name: 'bill_amount', type: 'string'},
                        { name: 'discount_amount', type: 'string'},
                        { name: 'invoice_amount', type: 'string'},
                        { name: 'sl_no', type: 'string'},
                        { name: 'dispatch_no', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'},
                        { name: 'stf_by', type: 'string'},
                        { name: 'stf_dt', type: 'string'},
                        { name: 'bill_months', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/lawyer_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data)
                    {
                        if (data != null)
                        {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                            if(data[0].TotalRows>0){
                                jQuery('#xl_btn').show();
                            }else{
                                jQuery('#xl_btn').hide();
                            }
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error){
                        alert(error);
                    },
                    formatData: function (data) {
                        var legal_region = jQuery.trim(jQuery('input[name=legal_region_grid]').val());
                        var legal_district = jQuery.trim(jQuery('#legal_district_grid').val());
                        var lawyer = jQuery.trim(jQuery('#lawyer_grid').val());
                        var status = jQuery.trim(jQuery('#status_grid').val());
                        var from_date = jQuery.trim(jQuery('#from_date').val());
                        var to_date = jQuery.trim(jQuery('#to_date').val());
                        jQuery.extend(data, {
                            legal_region : legal_region,
                            legal_district : legal_district,
                            lawyer_grid : lawyer,
                            from_date : from_date,
                            to_date : to_date,
                            status_grid : status
                        });
                        return data;
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-320;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                        <? if(EDIT==1){?>
                          { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27 || dataRecord.sts==29)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else
                                {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOCHECKER==1){?>
                          { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 37){
                                        return '<div style=" margin-top: 8px;text-align:center">S</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                        <? }?>
                        <? if(VERIFY==1){?>
                          { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 26 || dataRecord.sts == 30 || dataRecord.sts==89){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.sts == 29) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOFINANCE==1){?>
                          { text: 'STF', datafield: 'sendtofinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtofinance\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 70) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(VERIFYFINANCE==1){?>
                          { text: 'VF', datafield: 'verifyfinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 70){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verifyfinance\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        <? if(VIEWMEMO==1){?>
                        { text: 'BM', menu: false, datafield: 'Download', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.sts == 29 || dataRecord.sts==70){
                                //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_lawyer_bill_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_lawyer_bill_memo/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/icon_xls.gif"></div>';
                            }

                            }
                        },
                        { text: 'PDF', menu: false, datafield: 'PDF', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                  if(dataRecord.sts == 29 || dataRecord.sts==70){  
                                    //return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><a href="<?=base_url()?>index.php/bill_ho/download_pdf_lawyer_bill/'+dataRecord.id+'" target="_blank"><img align="center" src="<?=base_url()?>images/pdf_icon.gif"></a></div>';
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_pdf_lawyer_bill/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/pdf_icon.gif"></div>';
                                }
                              }
                        },
                        <? }?>
                        { text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'Lawyer Name', datafield: 'lawyer_name',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'Bill Amount', datafield: 'bill_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Discount Amount', datafield: 'discount_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Invoice Amount', datafield: 'invoice_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Bill Months', datafield: 'bill_months',editable: false, width: '20%', align:'left',cellsalign:'left'},
                        { text: 'Region Name', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'District Name', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'SL No.', datafield: 'sl_no', editable: false,align:'left',cellsalign:'center', sortable: true, menu: true, width: '11%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\','+dataRecord.bill_type+')"><span>'+dataRecord.sl_no+'</span></a></div>';
                                
                            }
                          },
                        { text: 'Despatch No.', datafield: 'dispatch_no',editable: false, width: '17%', align:'left',cellsalign:'left'},
                        { text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance By', datafield: 'stf_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance Date', datafield: 'stf_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });   
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        //initGrid();
                        break;
                    case 1:
                        initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
                jQuery('#lawyer_bill_form').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>

            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#lawyer_bill_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#lawyer_bill_form').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (bill_validation()==true && isValid) {
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);        
            });
        });
        function call_ajax_submit(){
            
            var postdata = jQuery('#lawyer_bill_form').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>bill_ho/add_edit_lawyer_bill/"+add_edit+"/"+edit_row,
                data : postdata,
                datatype: "json",
                async:false,
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    //console.log(json);
                    //csrf_tokens=json.csrf_token;
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
                    }
                    var msg='';
                    if(edit_row>0){
                        msg='Updated';
                    }else{
                        msg="Saved";
                    }
                    clear_form();
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
                    if(add_edit=='edit'){
                        jQuery("#in_up_loading").hide();
                        jQuery("#in_up_button").show();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
                    }else{
                        jQuery("#in_req_button").show();
                        jQuery("#in_req_loading").hide();
                    }
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');

                }
            });
        }
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
                            jQuery("#tin_show").html(json['row_info']['tin_number']);
                            jQuery("#bin_show").html(json['row_info']['bin_number']);
                            if(json['row_info']['bank']==6) //For Brac Bank Account
                            {
                                jQuery("#payment_type").jqxComboBox('val',1);
                                jQuery("#bank_ac_ac").val(json['row_info']['ac_no']);
                            }
                            else
                            {
                                jQuery("#payment_type").jqxComboBox('val',2);
                                jQuery("#bank").jqxComboBox('val',json['row_info']['bank']);
                                jQuery("#ac_no_rtgs").val(json['row_info']['ac_no']);
                            }

                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_lawyer_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        var csrf_tokena = json.csrf_token;
                        jQuery("#month_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        jQuery("#bill_info_body_legal").append(json.legal_bill_str);
                        jQuery("#bill_info_row_legal").show();
                        CheckChanged_2('','','legal');
                        CheckChanged_2('','','pending');
                        jQuery("#sl_no").val(json['result'].sl_no);
                        jQuery("#drop_down_td").hide();
                        jQuery("#text_td").show();
                        jQuery("#lawyer_region_row").hide();
                        jQuery("#lawyer_district_row").hide();
                        jQuery("#lawyer_name").html(json['result'].vendor_name);
                        jQuery("#discount_amount").val(json['result'].discount_amount);
                        jQuery("#received_dt").val(json['result'].received_dt);
                        jQuery("#memo_remarks").val(json['result'].memo_remarks);
                        jQuery("#special_bill_sts").val(json['result'].special_bill_sts);
                        jQuery("#dispatch_no").val(json['result'].dispatch_no);
                        jQuery("#tax_vat_text").jqxComboBox('val',json['result'].tax_vat_text);
                        jQuery("#tin_show").html(json['lawyer_info']['tin_number']);
                        jQuery("#bin_show").html(json['lawyer_info']['bin_number']);
                        jQuery("#payment_type").jqxComboBox('val',json['result'].payment_type);
                        if(json['result'].payment_type==1)
                        {
                            jQuery("#bank_ac_ac").val(json['result'].bank_ac);
                        }
                        else
                        {
                            jQuery("#bank").val(json['result'].bank);
                            jQuery("#routing_no").val(json['result'].routing_no);
                            jQuery("#ac_no_rtgs").val(json['result'].bank_ac);
                        }
                        var educqu=json['result'].approver_list.split(',');
                        for (var i = 0; i < educqu.length; i++)
                        {
                            jQuery("#approver_list").jqxDropDownList('checkItem', educqu[i]);
                        }
                        
                        
              },
                error:   function(model, xhr, options){
                    alert('failed');
                    clear_form();
                },
            });
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
            
        }
        function clear_form(){
            jQuery("#lawyer_region_row").show();
            jQuery("#lawyer_district_row").show();
            document.getElementById("checkAll_legal").checked=false;
            document.getElementById("checkAll_pending").checked=false;
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#legal_region").jqxComboBox('clearSelection');
            jQuery("input[name='legal_region']").val('');
            jQuery("#legal_district").jqxComboBox('clearSelection');
            jQuery("input[name='legal_district']").val('');
            jQuery("#tax_vat_text").jqxComboBox('clearSelection');
            jQuery("input[name='tax_vat_text']").val('');
            //jQuery("#district").jqxComboBox('clearSelection');
            jQuery("#month_row").show();
            //jQuery("#district_row").show();
            jQuery("#sl_no").val('Auto Generate');
            jQuery("#dispatch_no").val('Auto Generate');
            //jQuery("#dispatch_no").val('');
            jQuery("#bill_amount").val('');
            jQuery("#special_bill_sts").val('0');
            jQuery("#hidden_vendor_id").val('');
            jQuery("#discount_amount").val('');
            jQuery("#memo_remarks").val('');
            jQuery("#received_dt").val('');
            jQuery("#payment_type").jqxComboBox('clearSelection');
            jQuery("input[name='payment_type']").val('');
            jQuery("#bill_info_body").html('');
            jQuery("#bill_info_body_legal").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery("#proxy_info_body").html('');
            jQuery("#proxy_row").hide();
            jQuery("#payment_type").jqxComboBox('val',1);
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#text_td").hide();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery("#legal_region").jqxComboBox({ disabled: false });
            jQuery("#legal_district").jqxComboBox({ disabled: false });
            jQuery("#lawyer").jqxComboBox({ disabled: false });
            jQuery("#bill_month").jqxDropDownList({ disabled: false });
            jQuery("#year").jqxDropDownList({ disabled: false });
            jQuery("#tin_show").html('-----');
            jQuery("#bin_show").html('-----');
        }

        function calculate_discount_amount(counter=null)
        {
            if (counter!=null) 
            {
                var org_amount = jQuery("#event_amount_"+counter).val();
                var discount_amount = jQuery("#discount_"+counter).val();
                if (parseFloat(discount_amount)<0) 
                {
                    alert("invalid Discount Amount!");
                    jQuery("#discount_"+counter).focus();
                    return false;
                }
                else if(parseFloat(discount_amount)>=parseFloat(org_amount))
                {
                    alert("Discount Amount Bigger then Main Amount!");
                    jQuery("#discount_"+counter).focus();
                    return false;
                }
            }
            var total_row = jQuery('#billcount').val();
            var check=0;
            var total_discount = 0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true && jQuery("#discount_"+i).val()!='')
                {
                    total_discount = parseFloat(total_discount)+parseFloat(jQuery("#discount_"+i).val());
                }
            }
            jQuery('#discount_amount').val(total_discount);

        }
        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#attachment_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#attachment_row").show();
                jQuery("#verify_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/lawyer_bill_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_for_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_for_finance_select" name="hidden_file_for_finance_select" value="0">';
                            html+='<span id="hidden_file_for_finance">';
                            jQuery('#file_for_finance').html(html);

                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_from_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_from_finance_select" name="hidden_file_from_finance_select" value="0">';
                            html+='<span id="hidden_file_from_finance">';
                            jQuery('#file_from_finance').html(html);

                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
        function load_expense()
        {
            var theme = getDemoTheme();
            var  rules= [];
            rules.push(
                    { input: '#bill_month', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#bill_month input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#lawyer input").focus();
                            return false;
                        }
                    }  
                    }
            );
            jQuery('#lawyer_bill_form').jqxValidator({
                  rules: rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    call_service();
                }
            }
            jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);
        }
        function call_service()
        {
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#bill_info_body").html('');
            jQuery("#proxy_info_body").html('');
            jQuery("#bill_info_body_legal").html('');
            var bill_month = jQuery("#bill_month").val();
            var year = jQuery("#year").val();
            var vendor = jQuery("#lawyer").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_expense_data_lawyer',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,vendor:vendor,bill_month:bill_month,year:year},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.proxy_str!='')
                        {
                            jQuery("#proxy_info_body").append(json.proxy_str);
                            jQuery("#proxy_row").show();
                        }
                        else
                        {
                            jQuery("#proxy_info_body").html('');
                            jQuery("#proxy_row").hide();
                        }
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_body_legal").append(json.legal_bill_str);
                        jQuery("#bill_info_row").show();
                        jQuery("#bill_info_row_legal").show();
                        jQuery("#load_button").hide();
                        jQuery("#re_generate").show();
                        jQuery("#legal_region").jqxComboBox({ disabled: true });
                        jQuery("#legal_district").jqxComboBox({ disabled: true });
                        jQuery("#lawyer").jqxComboBox({ disabled: true });
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
                        jQuery("#year").jqxDropDownList({ disabled: true });
              },
                error:   function(model, xhr, options){
                    alert('failed');
                },
            });
        }
        function CheckAll_2(checkAllBox,type)                            
        {                           
            var ChkState=checkAllBox.checked;
            var number=jQuery("#billcount").val();
            var legal_count=jQuery("#legal_bill_count").val();
            if(type=='legal')
            {
                var start=1;
                var end = legal_count;
            }
            else
            {
                var start=parseInt(legal_count)+1;
                var end = number;
            }
            var counter=0;
            var amount = 0;
            var event_amount = 0;
            if (ChkState==true) 
            {
                for(var i=start; i<=end; i++){  
                    var x = document.getElementById("chkBoxSelect"+i).disabled;
                    if(x)   
                    {
                        continue;
                    }             
                    jQuery("#event_delete_"+i).val(0);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;
                    counter++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }
            }   
            else{
                for(var i=start; i<=end; i++){               
                    jQuery("#event_delete_"+i).val(1);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;                         
                }
                counter=0;
                event_amount=0;
            }           
            if(type=='legal')
            {
                jQuery('#hidden_bill_amount_legal').val(event_amount.toFixed(2));
                jQuery('#selected_amount_legal').html(event_amount.toFixed(2));  
            }
            else
            {
                jQuery('#hidden_bill_amount_pending').val(event_amount.toFixed(2));
                jQuery('#selected_amount').html(event_amount.toFixed(2));  
            }
             
            var selected_amount_legal = parseFloat(jQuery('#hidden_bill_amount_legal').val());
            var selected_amount_pending = parseFloat(jQuery('#hidden_bill_amount_pending').val());    
            var total_amount = parseFloat(selected_amount_legal)+parseFloat(selected_amount_pending);
            jQuery('#hidden_bill_amount').val(total_amount.toFixed(2));  
            calculate_discount_amount();            
        }   
        function CheckChanged_2(checkAllBox,counter,type)
        {
            var ChkState=checkAllBox.checked;
            if (ChkState==true) 
            {
                jQuery("#event_delete_"+counter).val(0);
            }
            else
            {
                jQuery("#event_delete_"+counter).val(1);
            }
            var number=jQuery("#billcount").val();
            var legal_count=jQuery("#legal_bill_count").val();
            if(type=='legal')
            {
                var start=1;
                var end = legal_count;
                number = end;
            }
            else
            {
                var start=parseInt(legal_count)+1;
                var end = number;
            }
            var checkco=parseInt(start)-1;
            var amount = 0;
            var event_amount = 0;
            for(var i=start; i<=end; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
                if(type=='legal')
                {
                    document.getElementById("checkAll_legal").checked=true;
                }
                else
                {
                    document.getElementById("checkAll_pending").checked=true;
                }
            
            }else{
                if(type=='legal')
                {
                    document.getElementById("checkAll_legal").checked=false;
                }
                else
                {
                    document.getElementById("checkAll_pending").checked=false;
                }
            }   
            if(type=='legal')
            {
                jQuery('#hidden_bill_amount_legal').val(event_amount.toFixed(2));
                jQuery('#selected_amount_legal').html(event_amount.toFixed(2));  
            }
            else
            {
                jQuery('#hidden_bill_amount_pending').val(event_amount.toFixed(2));
                jQuery('#selected_amount').html(event_amount.toFixed(2));  
            }
             
            var selected_amount_legal = parseFloat(jQuery('#hidden_bill_amount_legal').val());
            var selected_amount_pending = parseFloat(jQuery('#hidden_bill_amount_pending').val());    
            var total_amount = parseFloat(selected_amount_legal)+parseFloat(selected_amount_pending);
            jQuery('#hidden_bill_amount').val(total_amount.toFixed(2));   
            calculate_discount_amount();               
        }
        function bill_validation()
        {
            var total_amount = parseFloat(jQuery('#hidden_bill_amount').val());
            if(total_amount>100000 && jQuery('#special_bill_sts').val()=='0')
            {
                if(confirm("Total Selected bill amount crossed over 100000! are you sure want to save this as special bill?"))
                {
                    jQuery('#special_bill_sts').val(1); 
                    if(jQuery("#memo_remarks").val()=='')
                    {
                        jQuery("#memo_remarks").focus();
                        return false;
                    }
                    return true;
                }
                jQuery('#special_bill_sts').val(0); 
                return false;
            }
            var counter=0;
            var total_row = jQuery('#billcount').val();
            var check=0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true)
                {
                    var org_amount = jQuery("#event_amount_"+i).val();
                    var discount_amount = jQuery("#discount_"+i).val();
                    if (parseFloat(discount_amount)<0) 
                    {
                        alert("invalid Discount Amount!");
                        jQuery("#discount_"+i).focus();
                        return false;
                    }
                    else if(parseFloat(discount_amount)>=parseFloat(org_amount))
                    {
                        alert("Discount Amount Bigger then Main Amount!");
                        jQuery("#discount_"+i).focus();
                        return false;
                    }
                    if(jQuery("#discount_"+i).val()!='' && jQuery("#discount_remarks_"+i).val()=='')
                    {
                        alert("Discount Remarks Required!");
                        jQuery("#discount_remarks_"+i).focus();
                        return false;
                    }
                    check++;
                }
            }
            //For Add action without select any bill
            if(jQuery("#add_edit").val()=='add')
            {
                if (check<1)
                {
                    if (confirm("There is no bill selected. Are you want to cancel request?"))
                    {
                        
                        clear_form();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return true;
                }
            }
            else{
                if (check<1)
                {
                    return show_confrimation_pop_up('lawyer_bill');
                }
                else
                {
                    return true;
                }
            }
            return true;
        }
        function search_data(){
            jQuery("#grid_search").hide();
            jQuery("#grid_loading").show();
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
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
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Entry Form</li>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 10px;" class="back_image">
                                    <form class="form" name="lawyer_bill_form" id="lawyer_bill_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <input type="hidden" id="special_bill_sts" value="0" name="special_bill_sts">
                                        <input type="hidden" id="delete_reason_lawyer_bill" value="" name="delete_reason_lawyer_bill">
                                        <input type="hidden" name="hidden_bill_amount" id="hidden_bill_amount" value="0.00">
                                        <input type="hidden" name="hidden_bill_amount_pending" id="hidden_bill_amount_pending" value="0.00">
                                        <input type="hidden" name="hidden_bill_amount_legal" id="hidden_bill_amount_legal" value="0.00">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Serial No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="sl_no" type="text" tabindex="1" readonly class="" style="width:250px" id="sl_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr id="month_row">
                                                                <td width="40%" style="font-weight: bold;"><strong>Month Of Bill<span style="color:red">*</span> </td>
                                                                <td width="60%">
                                                                    <div id="bill_month" name="bill_month" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <div id="year" name="year" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <input type="button" value="Load" id="load_button" style="margin-left: 5px;width:50px !important;height:25px;float:left" onclick="load_expense()" />
                                                                    <input name="re_generate" id="re_generate" class="crmbutton small create" onclick="clear_form()" value="Reload" type="button" style="display: none;margin-left: 5px;height:25px;float:left">
                                                                </td>
                                                            </tr>
                                                            <tr id="lawyer_region_row">
                                                                <td width="40%" style="font-weight: bold;">Legal Region</td>
                                                                <td width="60%" id=""><div id="legal_region" tabindex="3" name="legal_region" style="padding-left: 3px" ></div></td>
                                                                
                                                            </tr>
                                                            <tr id="lawyer_district_row">
                                                                <td width="40%" style="font-weight: bold;">Legal District</td>
                                                                <td width="60%" id=""><div id="legal_district" tabindex="3" name="legal_district" style="padding-left: 3px" ></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Lawyer<span style="color:red">*</span> </td>
                                                                <td width="60%" id="drop_down_td"><div id="lawyer" tabindex="3" name="lawyer" style="padding-left: 3px" ></div></td>
                                                                <td width="60%" style="display:none" id="text_td"><span id="lawyer_name"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Despatch No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="dispatch_no" readonly type="text" tabindex="4" class="" style="width:250px" id="dispatch_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Bill Amount</td>
                                                                <td width="60%" ><input name="bill_amount" type="text" tabindex="5" class="" readonly style="width:250px" id="bill_amount" value="" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Discount Amount</td>
                                                                <td width="60%" ><input name="discount_amount" readonly type="text" tabindex="6" class="" style="width:250px" id="discount_amount" value="<?=isset($result->discount_amount)?$result->discount_amount:''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Receiving Date From Field<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input type="text" name="received_dt" tabindex="7" placeholder="dd/mm/yyyy" style="width:250px;" id="received_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("received_dt");</script></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Memo Remarks</td>
                                                                <td width="60%" ><textarea name="memo_remarks" tabindex="9" class="text-input-big" id="memo_remarks" style="height:40px !important;width:250px"><?=isset($result->memo_remarks)?$result->memo_remarks:''?></textarea></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Approver List<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="approver_list" name="approver_list" style="padding-left: 3px" tabindex="10"></div></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Tax Vat Text<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="tax_vat_text" name="tax_vat_text" style="padding-left: 3px" tabindex="11"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Payment Type<span style="color:red">*</span></td>
                                                                <td width="60%" ><div id="payment_type" name="payment_type" tabindex="11" style="padding-left: 3px;float:left"></div></td>
                                                            </tr>   
                                                            <tr id="ac_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">AC NO.<span style="color:red">*</span></td>
                                                                <td width="60%" ><input name="bank_ac_ac" type="text" tabindex="12" class="" style="width:250px" id="bank_ac_ac" value="" /></td>
                                                            </tr>
                                                            <tr id="rtgs_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">Rtgs Info<span style="color:red">*</span> </td>
                                                                <td width="60%" >
                                                                    <div id="bank" name="bank" style="padding-left: 3px" tabindex="12"></div>
                                                                    <div style="background-color:#eaeaea;padding:10px;width:233px" id="spfm">
                                                                    AC NO.<span style="color:red">*</span><br/><input name="ac_no_rtgs" onblur="" tabindex="13" type="text" class="" style="width:225px" id="ac_no_rtgs" value="" /><br/>
                                                                    Routing No.<br/><input name="routing_no" onblur="" tabindex="14" type="text" class="" style="width:225px" id="routing_no" value="" />
                                                                </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">TIN</td>
                                                                <td width="60%" ><span id="tin_show">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">BIN</td>
                                                                <td width="60%" ><span id="bin_show">-----</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="proxy_row">
                                                    <td colspan="2">
                                                        <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                            <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Proxy Info</span>
                                                            <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                <thead>
                                                                    <tr>
                                                                        <td width="5%" style="font-weight: bold;text-align:center">SL</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center">Vendor Name</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center">Amount</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="proxy_info_body">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row_legal">
                                                    <td colspan="2">
                                                        <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                            <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:20px;">Bill Submit From Legal Team</span>
                                                            <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                <thead>
                                                                    <tr>
                                                                        <td width="7%" style="font-weight: bold;text-align:center;word-wrap:break-word;"><input type="checkbox" name="checkAll_legal" id="checkAll_legal" onClick="CheckAll_2(this,'legal')" /></td>
                                                                        <td width="3%" style="font-weight: bold;text-align:center;word-wrap:break-word;">SL</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Vendor Name</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Account No.</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Account Name</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Case No.</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Date of legal steps</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Purpose/Activities</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Amount</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Discount Amount</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Remarks</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="bill_info_body_legal">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row">
                                                <td colspan="2">
                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bill Info</span>
                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                            <thead>
                                                                <tr>
                                                                    <td width="6%" style="font-weight: bold;text-align:center;word-wrap:break-word"><input type="checkbox" name="checkAll_pending" id="checkAll_pending" onClick="CheckAll_2(this,'pending')" /></td>
                                                                    <td width="3%" style="font-weight: bold;text-align:center;word-wrap:break-word">SL</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word">Vendor Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word">Account No.</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word">Account Name</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word">Case No.</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word">Date of legal steps</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word">Purpose/Activities</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word">Amount</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word">Discount Amount</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word">Remarks</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bill_info_body">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                        <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                                <? if(EDIT==1){?>
                                                <tr id="up_button" style="display: none;">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                        <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                    </div>
                                </div>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:70px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                        <form method="POST" name="form" id="grid_search_form"  style="margin:0px;" action="<?=base_url()?>index.php/bill_ho/mk_xl_all_report_both_all_and_account_wise">
                                            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="hidden" name="report_type" id="report_type" value="lawyer_bill">
                                            <table id="deal_body" style="display:block;width:100%">
                                                <tr>
                                                    <td style="text-align:right;width:5%"><strong>Region&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="legal_region_grid" name="legal_region_grid"></div></td>
                                                    <td style="text-align:right;width:7%"><strong>District&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="legal_district_grid" name="legal_district_grid"></div></td>
                                                    <td style="text-align:right;width:5%"><strong>Lawyer </strong></td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="lawyer_grid" name="lawyer_grid"></div></td>
                                                    <td style="text-align:right;width:5%"><strong>Status</strong> </td>
                                                    <td style="width:20%"><div style="padding-left:1.8%" id="status_grid" name="status_grid"></div></td>
                                                    <td style="text-align:right;width:7%"><strong>From</strong> </td>
                                                    <td style="width:10%"><input type="text" name="from_date" placeholder="dd/mm/yyyy" style="width:80px;" id="from_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("from_date");</script></td>
                                                    <td style="text-align:right;width:7%"><strong>To</strong> </td>
                                                    <td style="width:10%"><input type="text" name="to_date" placeholder="dd/mm/yyyy" style="width:80px;" id="to_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("to_date");</script></td>
                                                    <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                        <span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                    </td>
                                                    <td style="width:10%;text-align: left;display: none;" id="xl_btn" valign="top">
                                                        <button type="submit" formtarget="_blank" name="all_bill" title="Bill Wise" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                        <button type="submit" formtarget="_blank" name="ac_wise" title="Account Wise"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                  </div>
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/bill_ho/bulk_operation/apv/lawyer_bill" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row">
                                <td>Attachment (If Any):</td>
                                <td>
                                    <span id="file_for_finance"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>

<!-- For Court Fee -->
<?php if ($operation=='court_fee' && VIEWCOURTFEE==1): ?>

    <script type="text/javascript">
        var start=1990;
        let date =  new Date().getFullYear();
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        var tax_vat_text = [<? $i=1; foreach($tax_vat_text as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var lawyer = [];
        var status_grid = [<? $i=1; foreach($status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var legal_district = [];
        var bank = [<? $i=1; foreach($bank as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var payment_type = [<? $i=1; foreach($payment_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var approver_list = [<? $i=1; foreach($approver_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var theme = getDemoTheme();
            rules2=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#lawyer input").focus();
                        return false;
                    }
                }  
                },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            rules3=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            jQuery(document).ready(function () {
            // jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year,promptText: "Bill Year", width: 100, height: 25});
            // //jQuery("#year").jqxDropDownList('val', date);
                jQuery("#year").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Year",filterable: true,searchMode: 'containsignorecase', source: year, width: 100, height: 25});
            //jQuery("#year").jqxDropDownList('val', date);
            jQuery("#year").jqxDropDownList('checkItem', date);
            jQuery("#tax_vat_text").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Tax Vat Text", source: tax_vat_text, width: 250, height: 25});
            jQuery("#approver_list").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Select Approver List",filterable: true,searchMode: 'containsignorecase', source: approver_list, width: 250, height: 25});
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
            jQuery("#lawyer_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: '98%', height: 25});
            jQuery("#payment_type").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Payment Type", source: payment_type, width: 250, height: 25});
            jQuery("#bank").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Bank", source: bank, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#legal_region_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: '98%', height: 25});
            jQuery("#status_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Status", source: status_grid, width: '98%', height: 25});
            jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});
            jQuery("#legal_district_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: '98%', height: 25});
            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');        
            });
            jQuery('#legal_region_grid').bind('change', function (event) {
                change_dropdown('legal_region_grid');        
            });
            jQuery('#legal_district').bind('change', function (event) {
                change_dropdown('legal_district_lawyer');        
            });
            jQuery('#legal_district_grid').bind('change', function (event) {
                change_dropdown('legal_district_lawyer_grid');        
            });
            <?php if (check_group('1')): ?>
                change_dropdown('legal_region','<?=$this->session->userdata['ast_user']['legal_region']?>');
            <?php endif ?>
            jQuery('#payment_type,#bank,#lawyer,#tax_vat_text,#legal_region,#legal_district').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
             });
            jQuery('#payment_type').bind('change', function (event) {
                jQuery('#court_fee_form').jqxValidator('hide');
                jQuery("#bank_ac_ac").val('');
                jQuery("#bank").val('');
                jQuery("#ac_no_rtgs").val('');
                jQuery("#routing_no").val('');
                jQuery("#bank").jqxComboBox('clearSelection');
                var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    if (item.value==1)
                    {
                        jQuery("#ac_row").show();
                        jQuery("#rtgs_row").hide();
                    }
                    else
                    {
                        jQuery("#ac_row").hide();
                        jQuery("#rtgs_row").show();
                    }
                }
                else{
                    jQuery("#ac_row").hide();
                    jQuery("#rtgs_row").hide();
                }
            });
            jQuery('#lawyer').bind('change', function (event) {
                var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    get_lawyer_email_phone(item.value);
                }
            });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'e_by_id', type: 'int'},
                        { name: 'sts', type: 'int'},
                        { name: 'bill_type', type: 'int'},
                        { name: 'status', type: 'string'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'region_name', type: 'string'},
                        { name: 'district_name', type: 'string'},
                        { name: 'bill_amount', type: 'string'},
                        { name: 'discount_amount', type: 'string'},
                        { name: 'invoice_amount', type: 'string'},
                        { name: 'sl_no', type: 'string'},
                        { name: 'dispatch_no', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'},
                        { name: 'stf_by', type: 'string'},
                        { name: 'stf_dt', type: 'string'},
                        { name: 'bill_months', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/court_fee_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data)
                    {
                        if (data != null)
                        {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                            if(data[0].TotalRows>0){
                                jQuery('#xl_btn').show();
                            }else{
                                jQuery('#xl_btn').hide();
                            }
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error){
                        alert(error);
                    },
                    formatData: function (data) {
                        var legal_region = jQuery.trim(jQuery('input[name=legal_region_grid]').val());
                        var legal_district = jQuery.trim(jQuery('#legal_district_grid').val());
                        var lawyer = jQuery.trim(jQuery('#lawyer_grid').val());
                        var status = jQuery.trim(jQuery('#status_grid').val());
                        var from_date = jQuery.trim(jQuery('#from_date').val());
                        var to_date = jQuery.trim(jQuery('#to_date').val());
                        jQuery.extend(data, {
                            legal_region : legal_region,
                            legal_district : legal_district,
                            lawyer_grid : lawyer,
                            from_date : from_date,
                            to_date : to_date,
                            status_grid : status
                        });
                        return data;
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-320;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                        <? if(EDIT==1){?>
                          { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27 || dataRecord.sts==29)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else
                                {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOCHECKER==1){?>
                          { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 37){
                                        return '<div style=" margin-top: 8px;text-align:center">S</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                        <? }?>
                        <? if(VERIFY==1){?>
                          { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 26 || dataRecord.sts == 30 || dataRecord.sts==89){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.sts == 29) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOFINANCE==1){?>
                          { text: 'STF', datafield: 'sendtofinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtofinance\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 70) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(VERIFYFINANCE==1){?>
                          { text: 'VF', datafield: 'verifyfinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 70){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verifyfinance\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        <? if(VIEWMEMO==1){?>
                        { text: 'BM', menu: false, datafield: 'Download', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.sts == 29 || dataRecord.sts==70){
                                //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_court_fee_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_court_fee_memo/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/icon_xls.gif"></div>';
                            }

                            }
                        },
                        { text: 'PDF', menu: false, datafield: 'PDF', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29 || dataRecord.sts==70){
                                    //return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><a href="<?=base_url()?>index.php/bill_ho/download_pdf_court_fee/'+dataRecord.id+'" target="_blank"><img align="center" src="<?=base_url()?>images/pdf_icon.gif"></a></div>';
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_pdf_court_fee/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/pdf_icon.gif"></div>';
                                }
                              }
                        },
                        <? }?>
                        { text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'Lawyer Name', datafield: 'lawyer_name',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'Bill Amount', datafield: 'bill_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Discount Amount', datafield: 'discount_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Invoice Amount', datafield: 'invoice_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Bill Months', datafield: 'bill_months',editable: false, width: '20%', align:'left',cellsalign:'left'},
                        { text: 'Region Name', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'District Name', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'SL No.', datafield: 'sl_no', editable: false,align:'left',cellsalign:'center', sortable: true, menu: true, width: '11%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\','+dataRecord.bill_type+')"><span>'+dataRecord.sl_no+'</span></a></div>';
                                
                            }
                          },
                        { text: 'Despatch No.', datafield: 'dispatch_no',editable: false, width: '17%', align:'left',cellsalign:'left'},
                        { text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance By', datafield: 'stf_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance Date', datafield: 'stf_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });   
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        //initGrid();
                        break;
                    case 1:
                        initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
                jQuery('#court_fee_form').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>

            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#court_fee_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#court_fee_form').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#court_fee_form').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#court_fee_form').jqxValidator('validate', validationResult);        
            });
        });
        
        function call_ajax_submit(){
            
            var postdata = jQuery('#court_fee_form').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>bill_ho/add_edit_court_fee/"+add_edit+"/"+edit_row,
                data : postdata,
                datatype: "json",
                async:false,
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    //console.log(json);
                    //csrf_tokens=json.csrf_token;
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
                    }
                    var msg='';
                    if(edit_row>0){
                        msg='Updated';
                    }else{
                        msg="Saved";
                    }
                    clear_form();
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
                    if(add_edit=='edit'){
                        jQuery("#in_up_loading").hide();
                        jQuery("#in_up_button").show();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
                    }else{
                        jQuery("#in_req_button").show();
                        jQuery("#in_req_loading").hide();
                    }
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');

                }
            });
        }
        
        function get_dropdown_data(){
            var item = jQuery("#district").jqxComboBox('getSelectedItem');
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
                            jQuery("#staff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 250, height: 25});
                            jQuery('#staff').focusout(function() {
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
                jQuery("#staff").jqxComboBox('clearSelection');
                jQuery("#staff").val('');
            }
        }
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
                            jQuery("#tin_show").html(json['row_info']['tin_number']);
                            jQuery("#bin_show").html(json['row_info']['bin_number']);
                            if(json['row_info']['bank']==6) //For Brac Bank Account
                            {
                                jQuery("#payment_type").jqxComboBox('val',1);
                                jQuery("#bank_ac_ac").val(json['row_info']['ac_no']);
                            }
                            else
                            {
                                jQuery("#payment_type").jqxComboBox('val',2);
                                jQuery("#bank").jqxComboBox('val',json['row_info']['bank']);
                                jQuery("#ac_no_rtgs").val(json['row_info']['ac_no']);
                            }
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_court_fee_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        var csrf_tokena = json.csrf_token;
                        jQuery("#month_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        jQuery("#bill_info_body_legal").append(json.legal_bill_str);
                        jQuery("#bill_info_row_legal").show();
                        CheckChanged_2('','','legal');
                        CheckChanged_2('','','pending');
                        jQuery("#sl_no").val(json['result'].sl_no);
                        jQuery("#drop_down_td").hide();
                        jQuery("#text_td").show();
                        jQuery("#lawyer_name").html(json['result'].vendor_name);
                        jQuery("#discount_amount").val(json['result'].discount_amount);
                        jQuery("#received_dt").val(json['result'].received_dt);
                        jQuery("#memo_remarks").val(json['result'].memo_remarks);
                        jQuery("#dispatch_no").val(json['result'].dispatch_no);
                        jQuery("#year").jqxDropDownList('val', json['result'].year);
                        jQuery("#tax_vat_text").jqxComboBox('val',json['result'].tax_vat_text);
                        jQuery("#tin_show").html(json['lawyer_info']['tin_number']);
                        jQuery("#bin_show").html(json['lawyer_info']['bin_number']);
                        jQuery("#payment_type").jqxComboBox('val',json['result'].payment_type);
                        if(json['result'].payment_type==1)
                        {
                            jQuery("#bank_ac_ac").val(json['result'].bank_ac);
                        }
                        else
                        {
                            jQuery("#bank").val(json['result'].bank);
                            jQuery("#routing_no").val(json['result'].routing_no);
                            jQuery("#ac_no_rtgs").val(json['result'].bank_ac);
                        }
                        var educqu=json['result'].approver_list.split(',');
                        for (var i = 0; i < educqu.length; i++)
                        {
                            jQuery("#approver_list").jqxDropDownList('checkItem', educqu[i]);
                        }
                        jQuery("#lawyer_region_row").hide();
                        jQuery("#lawyer_district_row").hide();
                        
              },
                error:   function(model, xhr, options){
                    alert('failed');
                    clear_form();
                },
            });
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
            
        }
        function clear_form(){
            jQuery("#lawyer_region_row").show();
            jQuery("#lawyer_district_row").show();
            document.getElementById("checkAll_legal").checked=false;
            document.getElementById("checkAll_pending").checked=false;
            //jQuery("#year").jqxDropDownList('val', date);
            jQuery("#legal_region").jqxComboBox('clearSelection');
            jQuery("input[name='legal_region']").val('');
            jQuery("#legal_district").jqxComboBox('clearSelection');
            jQuery("input[name='legal_district']").val('');
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#tax_vat_text").jqxComboBox('clearSelection');
            jQuery("input[name='tax_vat_text']").val('');
            //jQuery("#district").jqxComboBox('clearSelection');
            jQuery("#month_row").show();
            //jQuery("#district_row").show();
            jQuery("#sl_no").val('Auto Generate');
            jQuery("#dispatch_no").val('Auto Generate');
            //jQuery("#dispatch_no").val('');
            jQuery("#bill_amount").val('');
            jQuery("#hidden_vendor_id").val('');
            jQuery("#discount_amount").val('');
            jQuery("#memo_remarks").val('');
            jQuery("#received_dt").val('');
            jQuery("#payment_type").jqxComboBox('clearSelection');
            jQuery("input[name='payment_type']").val('');
            jQuery("#bill_info_body").html('');
            jQuery("#bill_info_body_legal").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery("#bill_info_row_legal").hide();
            jQuery("#proxy_row").hide();
            jQuery("#payment_type").jqxComboBox('val',1);
            jQuery('#court_fee_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#text_td").hide();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery("#legal_region").jqxComboBox({ disabled: false });
            jQuery("#legal_district").jqxComboBox({ disabled: false });
            jQuery("#lawyer").jqxComboBox({ disabled: false });
            jQuery("#bill_month").jqxDropDownList({ disabled: false });
            jQuery("#year").jqxDropDownList({ disabled: false });
            jQuery("#tin_show").html('-----');
            jQuery("#bin_show").html('-----');
        }


        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#attachment_row").hide();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#attachment_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/court_fee_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_for_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_for_finance_select" name="hidden_file_for_finance_select" value="0">';
                            html+='<span id="hidden_file_for_finance">';
                            jQuery('#file_for_finance').html(html);

                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_from_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_from_finance_select" name="hidden_file_from_finance_select" value="0">';
                            html+='<span id="hidden_file_from_finance">';
                            jQuery('#file_from_finance').html(html);
                            
                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
        function load_expense()
        {
            var theme = getDemoTheme();
            var  rules= [];
            rules.push(
                    // { input: '#bill_month', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    //     if(input.val() != '')
                    //     {
                    //         return true;                
                    //     }
                    //     else
                    //     {
                    //         jQuery("#bill_month input").focus();
                    //         return false;
                    //     }
                    // }  
                    // },
                    { input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#lawyer input").focus();
                            return false;
                        }
                    }  
                    }
            );
            jQuery('#court_fee_form').jqxValidator({
                  rules: rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    call_service();
                }
            }
            jQuery('#court_fee_form').jqxValidator('validate', validationResult);
        }
        function call_service()
        {
            jQuery('#court_fee_form').jqxValidator('hide');
            jQuery("#bill_info_body").html('');
            jQuery("#bill_info_body_legal").html('');
            var bill_month = jQuery("#bill_month").val();
            var year = jQuery("#year").val();
            var vendor = jQuery("#lawyer").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_expense_data_court_fee',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,vendor:vendor,bill_month:bill_month,year:year},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_body_legal").append(json.legal_bill_str);
                        jQuery("#bill_info_row").show();
                        jQuery("#bill_info_row_legal").show();
                        jQuery("#load_button").hide();
                        jQuery("#re_generate").show();
                        jQuery("#lawyer").jqxComboBox({ disabled: true });
                        jQuery("#legal_region").jqxComboBox({ disabled: true });
                        jQuery("#legal_district").jqxComboBox({ disabled: true });
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
                        jQuery("#year").jqxDropDownList({ disabled: true });
              },
                error:   function(model, xhr, options){
                    alert('failed');
                },
            });
        }
        function calculate_discount_amount(counter=null)
        {
            if (counter!=null) 
            {
                var org_amount = jQuery("#event_amount_"+counter).val();
                var discount_amount = jQuery("#discount_"+counter).val();
                if (parseFloat(discount_amount)<0) 
                {
                    alert("invalid Discount Amount!");
                    jQuery("#discount_"+counter).focus();
                    return false;
                }
                else if(parseFloat(discount_amount)>=parseFloat(org_amount))
                {
                    alert("Discount Amount Bigger then Main Amount!");
                    jQuery("#discount_"+counter).focus();
                    return false;
                }
            }
            var total_row = jQuery('#billcount').val();
            var check=0;
            var total_discount = 0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true && jQuery("#discount_"+i).val()!='')
                {
                    total_discount = parseFloat(total_discount)+parseFloat(jQuery("#discount_"+i).val());
                }
            }
            jQuery('#discount_amount').val(total_discount);

        }
        function CheckAll_2(checkAllBox,type)                            
        {                           
            var ChkState=checkAllBox.checked;
            var number=jQuery("#billcount").val();
            var legal_count=jQuery("#legal_bill_count").val();
            if(type=='legal')
            {
                var start=1;
                var end = legal_count;
            }
            else
            {
                var start=parseInt(legal_count)+1;
                var end = number;
            }
            var counter=0;
            var amount = 0;
            var event_amount = 0;
            if (ChkState==true) 
            {
                for(var i=start; i<=end; i++){  
                    var x = document.getElementById("chkBoxSelect"+i).disabled;
                    if(x)   
                    {
                        continue;
                    }             
                    jQuery("#event_delete_"+i).val(0);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;
                    counter++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }
            }   
            else{
                for(var i=start; i<=end; i++){               
                    jQuery("#event_delete_"+i).val(1);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;                         
                }
                counter=0;
                event_amount=0;
            }           
            if(type=='legal')
            {
                jQuery('#hidden_bill_amount_legal').val(event_amount.toFixed(2));
                jQuery('#selected_amount_legal').html(event_amount.toFixed(2));  
            }
            else
            {
                jQuery('#hidden_bill_amount_pending').val(event_amount.toFixed(2));
                jQuery('#selected_amount').html(event_amount.toFixed(2));  
            }
             
            var selected_amount_legal = parseFloat(jQuery('#hidden_bill_amount_legal').val());
            var selected_amount_pending = parseFloat(jQuery('#hidden_bill_amount_pending').val());    
            var total_amount = parseFloat(selected_amount_legal)+parseFloat(selected_amount_pending);
            jQuery('#hidden_bill_amount').val(total_amount.toFixed(2));  
            calculate_discount_amount();             
        }   
        function CheckChanged_2(checkAllBox,counter,type)
        {
            var ChkState=checkAllBox.checked;
            if (ChkState==true) 
            {
                jQuery("#event_delete_"+counter).val(0);
            }
            else
            {
                jQuery("#event_delete_"+counter).val(1);
            }
            var number=jQuery("#billcount").val();
            var legal_count=jQuery("#legal_bill_count").val();
            if(type=='legal')
            {
                var start=1;
                var end = legal_count;
                number = end;
            }
            else
            {
                var start=parseInt(legal_count)+1;
                var end = number;
            }
            var checkco=parseInt(start)-1;
            var amount = 0;
            var event_amount = 0;
            for(var i=start; i<=end; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
                if(type=='legal')
                {
                    document.getElementById("checkAll_legal").checked=true;
                }
                else
                {
                    document.getElementById("checkAll_pending").checked=true;
                }
            
            }else{
                if(type=='legal')
                {
                    document.getElementById("checkAll_legal").checked=false;
                }
                else
                {
                    document.getElementById("checkAll_pending").checked=false;
                }
            }   
            if(type=='legal')
            {
                jQuery('#hidden_bill_amount_legal').val(event_amount.toFixed(2));
                jQuery('#selected_amount_legal').html(event_amount.toFixed(2));  
            }
            else
            {
                jQuery('#hidden_bill_amount_pending').val(event_amount.toFixed(2));
                jQuery('#selected_amount').html(event_amount.toFixed(2));  
            }
             
            var selected_amount_legal = parseFloat(jQuery('#hidden_bill_amount_legal').val());
            var selected_amount_pending = parseFloat(jQuery('#hidden_bill_amount_pending').val());    
            var total_amount = parseFloat(selected_amount_legal)+parseFloat(selected_amount_pending);
            jQuery('#hidden_bill_amount').val(total_amount.toFixed(2));    
            calculate_discount_amount();        
        }
        function bill_validation()
        {
            var total_amount = parseFloat(jQuery('#hidden_bill_amount').val());
            if(total_amount>99999)
            {
                alert('Sorry Total Selected bill amount crossed over 99999');
                return false;
            }
            var counter=0;
            var total_row = jQuery('#billcount').val();
            var check=0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true)
                {
                    var org_amount = jQuery("#event_amount_"+i).val();
                    var discount_amount = jQuery("#discount_"+i).val();
                    if (parseFloat(discount_amount)<0) 
                    {
                        alert("invalid Discount Amount!");
                        jQuery("#discount_"+i).focus();
                        return false;
                    }
                    else if(parseFloat(discount_amount)>=parseFloat(org_amount))
                    {
                        alert("Discount Amount Bigger then Main Amount!");
                        jQuery("#discount_"+i).focus();
                        return false;
                    }
                    if(jQuery("#discount_"+i).val()!='' && jQuery("#discount_remarks_"+i).val()=='')
                    {
                        alert("Discount Remarks Required!");
                        jQuery("#discount_remarks_"+i).focus();
                        return false;
                    }
                    check++;
                }
            }
            //For Add action without select any bill
            if(jQuery("#add_edit").val()=='add')
            {
                if (check<1)
                {
                    if (confirm("There is no bill selected. Are you want to cancel request?"))
                    {
                        
                        clear_form();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return true;
                }
            }
            else{
                if (check<1)
                {
                    // if (confirm("There is no bill selected. Are you want to cancel request?"))
                    // {
                    //     jQuery('#bill_select').val(0);
                    //     return true;
                    // }
                    // else
                    // {
                    //     return false;
                    // }
                    return show_confrimation_pop_up('court_fee');
                }
                else
                {
                    return true;
                }
            }
            return true;
        }
        function search_data(){
            jQuery("#grid_search").hide();
            jQuery("#grid_loading").show();
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
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
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Entry Form</li>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 10px;" class="back_image">
                                    <form class="form" name="court_fee_form" id="court_fee_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <input type="hidden" id="delete_reason_court_fee" value="" name="delete_reason_court_fee">
                                        <input type="hidden" name="hidden_bill_amount" id="hidden_bill_amount" value="0.00">
                                        <input type="hidden" name="hidden_bill_amount_pending" id="hidden_bill_amount_pending" value="0.00">
                                        <input type="hidden" name="hidden_bill_amount_legal" id="hidden_bill_amount_legal" value="0.00">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Serial No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="sl_no" type="text" tabindex="1" readonly class="" style="width:250px" id="sl_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr id="month_row">
                                                                <td width="40%" style="font-weight: bold;"><strong>Month Of Bill</td>
                                                                <td width="60%">
                                                                    <div id="bill_month" name="bill_month" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <div id="year" name="year" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <input type="button" value="Load" id="load_button" style="margin-left: 5px;width:50px !important;height:25px;float:left" onclick="load_expense()" />
                                                                    <input name="re_generate" id="re_generate" class="crmbutton small create" onclick="clear_form()" value="Reload" type="button" style="display: none;margin-left: 5px;height:25px;float:left">
                                                                </td>
                                                            </tr>
                                                            <tr id="lawyer_region_row">
                                                                <td width="40%" style="font-weight: bold;">Legal Region</td>
                                                                <td width="60%" id=""><div id="legal_region" tabindex="3" name="legal_region" style="padding-left: 3px" ></div></td>
                                                                
                                                            </tr>
                                                            <tr id="lawyer_district_row">
                                                                <td width="40%" style="font-weight: bold;">Legal District</td>
                                                                <td width="60%" id=""><div id="legal_district" tabindex="3" name="legal_district" style="padding-left: 3px" ></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Lawyer<span style="color:red">*</span> </td>
                                                                <td width="60%" id="drop_down_td"><div id="lawyer" tabindex="3" name="lawyer" style="padding-left: 3px" ></div></td>
                                                                <td width="60%" style="display:none" id="text_td"><span id="lawyer_name"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Despatch No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="dispatch_no" readonly type="text" tabindex="4" class="" style="width:250px" id="dispatch_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Bill Amount</td>
                                                                <td width="60%" ><input name="bill_amount" type="text" tabindex="5" class="" readonly style="width:250px" id="bill_amount" value="<?=isset($result->bill_amount)?$result->bill_amount:''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Discount Amount</td>
                                                                <td width="60%" ><input name="discount_amount" readonly type="text" tabindex="6" class="" style="width:250px" id="discount_amount" value="<?=isset($result->discount_amount)?$result->discount_amount:''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Receiving Date From Field<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input type="text" name="received_dt" tabindex="7" placeholder="dd/mm/yyyy" style="width:250px;" id="received_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("received_dt");</script></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Memo Remarks</td>
                                                                <td width="60%" ><textarea name="memo_remarks" tabindex="9" class="text-input-big" id="memo_remarks" style="height:40px !important;width:250px"><?=isset($result->memo_remarks)?$result->memo_remarks:''?></textarea></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Approver List<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="approver_list" name="approver_list" style="padding-left: 3px" tabindex="10"></div></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Tax Vat Text<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="tax_vat_text" name="tax_vat_text" style="padding-left: 3px" tabindex="11"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Payment Type<span style="color:red">*</span></td>
                                                                <td width="60%" ><div id="payment_type" name="payment_type" tabindex="11" style="padding-left: 3px;float:left"></div></td>
                                                            </tr>   
                                                            <tr id="ac_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">AC NO.<span style="color:red">*</span></td>
                                                                <td width="60%" ><input name="bank_ac_ac" type="text" tabindex="12" class="" style="width:250px" id="bank_ac_ac" value="" /></td>
                                                            </tr>
                                                            <tr id="rtgs_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">Rtgs Info<span style="color:red">*</span> </td>
                                                                <td width="60%" >
                                                                    <div id="bank" name="bank" style="padding-left: 3px" tabindex="13"></div>
                                                                    <div style="background-color:#eaeaea;padding:10px;width:233px" id="spfm">
                                                                    AC NO.<span style="color:red">*</span><br/><input name="ac_no_rtgs" onblur="" tabindex="14" type="text" class="" style="width:225px" id="ac_no_rtgs" value="" /><br/>
                                                                    Routing No.<br/><input name="routing_no" onblur="" tabindex="15" type="text" class="" style="width:225px" id="routing_no" value="" />
                                                                </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">TIN</td>
                                                                <td width="60%" ><span id="tin_show">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">BIN</td>
                                                                <td width="60%" ><span id="bin_show">-----</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row_legal">
                                                <td colspan="2">
                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:20px;">Bill Submit From Legal Team</span>
                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                            <thead>
                                                                <tr>
                                                                    <td width="7%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll_legal" id="checkAll_legal" onClick="CheckAll_2(this,'legal')" /></td>
                                                                    <td width="3%" style="font-weight: bold;text-align:center">SL</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Vendor Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Suit Value</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Amount</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Discount Amount</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Remarks</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bill_info_body_legal">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                                <tr style="display: none;" id="bill_info_row">
                                                <td colspan="2">
                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:20px;">Bill Pending</span>
                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                            <thead>
                                                                <tr>
                                                                    <td width="5%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll_pending" id="checkAll_pending" onClick="CheckAll_2(this,'pending')" /></td>
                                                                    <td width="3%" style="font-weight: bold;text-align:center">SL</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Vendor Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Suit Value</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Amount</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Discount Amount</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Remarks</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bill_info_body">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                        <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                                <? if(EDIT==1){?>
                                                <tr id="up_button" style="display: none;">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                        <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                    </div>
                                </div>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:70px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                        <form method="POST" name="form" id="grid_search_form"  style="margin:0px;" action="<?=base_url()?>index.php/bill_ho/mk_xl_all_report_both_all_and_account_wise">
                                            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="hidden" name="report_type" id="report_type" value="court_fee">
                                            <table id="deal_body" style="display:block;width:100%">
                                                <tr>
                                                    <td style="text-align:right;width:7%"><strong>Region&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="legal_region_grid" name="legal_region_grid"></div></td>
                                                    <td style="text-align:right;width:9%"><strong>District&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="legal_district_grid" name="legal_district_grid"></div></td>
                                                    <td style="text-align:right;width:8%"><strong>Lawyer </strong></td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="lawyer_grid" name="lawyer_grid"></div></td>
                                                    <td style="text-align:right;width:7%"><strong>Status</strong> </td>
                                                    <td style="width:20%"><div style="padding-left:1.8%" id="status_grid" name="status_grid"></div></td>
                                                    <td style="text-align:right;width:7%"><strong>From</strong> </td>
                                                    <td style="width:10%"><input type="text" name="from_date" placeholder="dd/mm/yyyy" style="width:100px;" id="from_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("from_date");</script></td>
                                                    <td style="text-align:right;width:7%"><strong>To</strong> </td>
                                                    <td style="width:10%"><input type="text" name="to_date" placeholder="dd/mm/yyyy" style="width:100px;" id="to_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("to_date");</script></td>
                                                    <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                        <span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                    </td>
                                                    <td style="width:5%;text-align: right;display: none;" id="xl_btn" valign="top">
                                                        <button type="submit" formtarget="_blank" name="all_bill" title="Bill Wise" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                        <button type="submit" formtarget="_blank" name="ac_wise" title="Account Wise"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                  </div>
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/bill_ho/bulk_operation/apv/court_fee" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row">
                                <td>Attachment (If Any):</td>
                                <td style="text-align: left;">
                                    <span id="file_for_finance" style="float:left"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>

<!-- For Court Fee Return -->
<?php if ($operation=='court_return' && VIEWCOURTFEERETURN==1): ?>

    <script type="text/javascript">
            var theme = getDemoTheme();
            var return_type = [<? $i=1; foreach($return_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#return_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Return Type", source: return_type, width: 250, height: 25});
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'v_sts', type: 'int'},
                        { name: 'loan_ac', type: 'string'},
                        { name: 'ac_name', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'hm_ack_by', type: 'int'},
                        { name: 'district_name', type: 'string'},
                        { name: 'return_amount', type: 'string'},
                        { name: 'status', type: 'string'},
                        { name: 'sts', type: 'sts'},
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/court_return_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
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
                    loadError: function(xhr, status, error){
                        alert(error);
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-250;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                         <? if(ACKOWLEDGMENTREQUEST==1){?>
                            { text: 'ACK', datafield: 'acknowledgement', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if( dataRecord.v_sts == 93){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'acknowledgement\')" ><img align="center" src="<?=base_url()?>images/favorites.png"></div>';
                                }
                                else if(dataRecord.v_sts == 6){
                                        return '<div style=" margin-top: 8px;text-align:center">ACK</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                                }
                            },
                        
                          <? }?>
                        <? if(SENDTOCHECKER==1){?>
                        { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                        cellsrenderer: function(row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.hm_ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.v_sts == 6 || dataRecord.v_sts == 11)){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }
                            else if(dataRecord.v_sts == 10){
                                    return '<div style=" margin-top: 8px;text-align:center">S</div>';
                            }
                            else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                        },
                        
                          <? }?>
                           <? if(VERIFY==1){?>
                        { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.v_sts == 10){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.v_sts == 13){
                                        return '<div style=" margin-top: 8px;text-align:center">V</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                          <? }?>
                        { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        { text: 'Status', datafield: 'status',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Loan AC', datafield: 'loan_ac',editable: false, width: '15%'},
                        { text: 'AC Name', datafield: 'ac_name',editable: false, width: '15%'},
                        { text: 'Lawyer Name', datafield: 'lawyer_name',editable: false, width: '20%'},
                        { text: 'Lawyer District', datafield: 'district_name',editable: false, width: '20%'},
                        { text: 'Amount', datafield: 'return_amount',editable: false, width: '20%'},
                        { text: 'Entry By', datafield: 'e_by',editable: false, width: '15%'},
                        { text: 'Entry Date Time', datafield: 'e_dt',editable: false, width: '15%'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });   
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel,#acknowledgementcancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        initGrid2();
                        break;
                }
            }
            jQuery('#return_type').bind('change', function (event) {
                var item = jQuery("#return_type").jqxComboBox('getSelectedItem');
                if(item!=null && item.value==2)
                {
                    jQuery("#partial_row").show();
                    jQuery("#partial_remarks_row").show();
                }
                else
                {
                    jQuery("#partial_row").hide();
                    jQuery("#partial_remarks_row").hide();
                }      
            });
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });

        });
        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#acknowledgement_row").hide();

            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").hide();
            }else if(operation=='acknowledgement'){
                jQuery("#r_heading").html('Acknowledgement');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('acknowledgement');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").show();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>expenses/court_return_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            if(operation=='sendtochecker')
                            {
                                jQuery("#return_type_row").show();
                                jQuery('#return_type').jqxComboBox('val', json.return_type);
                                if(json.return_type==2)
                                {
                                    jQuery('#new_amount').val(json.return_amount);
                                    jQuery('#partial_remarks').val(json.remarks);
                                }
                            }
                            else
                            {
                                jQuery("#return_type_row").hide();
                                jQuery("#partial_row").hide();
                                jQuery("#partial_remarks_row").hide();
                                jQuery('#new_amount').val('');
                                jQuery('#partial_remarks').val('');
                            }
                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
    </script>
    <div id="container">
        <div id="body"  >
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    &nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action_court_return" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr style="display:none" id="return_type_row">
                                <td style="font-weight: bold;">Return Type</td>
                                <td><div id="return_type" name="return_type" style="padding-left: 3px" ></div></td>
                            </tr>
                            <tr id="partial_row" style="display:none">
                                <td width="40%" style="font-weight: bold;">New Amount<span style="color:red">*</span></td>
                                <td width="60%"><input name="new_amount" tabindex="3" type="text" class="" style="width:250px" id="new_amount" value=""/></td>
                            </tr>
                            <tr id="partial_remarks_row" style="display:none">
                                <td width="40%" style="font-weight: bold;">Remarks<span style="color:red">*</span></td>
                                <td width="60%"><textarea name="partial_remarks" id="partial_remarks" style="width:225px;"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="court_return_sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="acknowledgement_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="acknowledgement" value="Acknowledge">
                                    <input type="button" class="buttonclose" id="acknowledgementcancel" onclick="close()" value="Cancel">
                                    <span id="acknowledgement_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>
<!-- For Court Fee Adjustment -->
<?php if ($operation=='court_adjust' && VIEWCOURTFEEADJUST==1): ?>

    <script type="text/javascript">
            var theme = getDemoTheme();
            var return_type = [<? $i=1; foreach($return_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'v_sts', type: 'int'},
                        { name: 'loan_ac', type: 'string'},
                        { name: 'ac_name', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'hm_ack_by', type: 'int'},
                        { name: 'district_name', type: 'string'},
                        { name: 'status', type: 'string'},
                        { name: 'sts', type: 'sts'},
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/court_adjust_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
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
                    loadError: function(xhr, status, error){
                        alert(error);
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-250;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                         <? if(ACKOWLEDGMENTREQUEST==1){?>
                            { text: 'ACK', datafield: 'acknowledgement', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if( dataRecord.v_sts == 93){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'acknowledgement\')" ><img align="center" src="<?=base_url()?>images/favorites.png"></div>';
                                }
                                else if(dataRecord.v_sts == 6){
                                        return '<div style=" margin-top: 8px;text-align:center">ACK</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                                }
                            },
                        
                          <? }?>
                        <? if(SENDTOCHECKER==1){?>
                        { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                        cellsrenderer: function(row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.hm_ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.v_sts == 6 || dataRecord.v_sts == 11)){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }
                            else if(dataRecord.v_sts == 10){
                                    return '<div style=" margin-top: 8px;text-align:center">S</div>';
                            }
                            else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                        },
                        
                          <? }?>
                           <? if(VERIFY==1){?>
                        { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.v_sts == 10){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.v_sts == 13){
                                        return '<div style=" margin-top: 8px;text-align:center">V</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                          <? }?>
                        { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        { text: 'Status', datafield: 'status',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Loan AC', datafield: 'loan_ac',editable: false, width: '15%'},
                        { text: 'A/C Name', datafield: 'ac_name',editable: false, width: '15%'},
                        { text: 'Lawyer Name', datafield: 'lawyer_name',editable: false, width: '20%'},
                        { text: 'Lawyer District', datafield: 'district_name',editable: false, width: '20%'},
                        { text: 'Entry By', datafield: 'e_by',editable: false, width: '15%'},
                        { text: 'Entry Date Time', datafield: 'e_dt',editable: false, width: '15%'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });   
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel,#acknowledgementcancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });

        });
        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#acknowledgement_row").hide();

            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").hide();
            }else if(operation=='acknowledgement'){
                jQuery("#r_heading").html('Acknowledgement');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('acknowledgement');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").show();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#acknowledgement_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>expenses/court_adjust_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
    </script>
    <div id="container">
        <div id="body"  >
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    &nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action_court_adjust" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="acknowledgement_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="acknowledgement" value="Acknowledge">
                                    <input type="button" class="buttonclose" id="acknowledgementcancel" onclick="close()" value="Cancel">
                                    <span id="acknowledgement_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>
<!-- For Paper Bill -->
<?php if ($operation=='paper_bill' && VIEWPAPER==1): ?>

    <script type="text/javascript">
        var start=1990;
        let date =  new Date().getFullYear();
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        var status_grid = [<? $i=1; foreach($status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var vendor_type = ["Vendor", "Staff"];
        var legal_district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var tax_vat_text = [<? $i=1; foreach($tax_vat_text as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var paper_vendor = [<? $i=1; foreach($paper_vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var staff = [<? $i=1; foreach($staff as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'('.$row->pin.')'.'"}'; $i++;}?>];
        var bank = [<? $i=1; foreach($bank as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var payment_type = [<? $i=1; foreach($payment_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var approver_list = [<? $i=1; foreach($approver_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var status_grid = [<? $i=1; foreach($status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];   
        var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var theme = getDemoTheme();
            rules2=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'required!', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() == '' && jQuery("#special_bill_sts").val()=='1')
                    {
                        jQuery("#memo_remarks").focus();
                        return false;
                    }
                    return true;

                } },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#vendor_type', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#vendor_type input").focus();
                            return false;
                        }
                    }  
                },
                { input: '#paper_vendor', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var type = jQuery("#vendor_type").jqxComboBox('getSelectedItem');
                    if(type!=null)
                    {
                        if(type.value=='Vendor')
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#paper_vendor input").focus();
                                return false;
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
                { input: '#staff', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var type = jQuery("#vendor_type").jqxComboBox('getSelectedItem');
                    if(type!=null)
                    {
                        if(type.value=='Staff')
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#staff input").focus();
                                return false;
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
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            rules3=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'required!', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() == '' && jQuery("#special_bill_sts").val()=='1')
                    {
                        jQuery("#memo_remarks").focus();
                        return false;
                    }
                    return true;

                } },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            jQuery(document).ready(function () {
                //jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 100, height: 25});
            jQuery("#year").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Year",filterable: true,searchMode: 'containsignorecase', source: year, width: 100, height: 25});
            //jQuery("#year").jqxDropDownList('val', date);
            jQuery("#year").jqxDropDownList('checkItem', date);
            //jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#legal_region").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Legal Region",filterable: true,searchMode: 'containsignorecase', source: legal_region, width: 250, height: 25});
            jQuery("#status_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Status", source: status_grid, width: '98%', height: 25});
            jQuery("#tax_vat_text").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Tax Vat Text", source: tax_vat_text, width: 250, height: 25});
            jQuery("#approver_list").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Select Approver List",filterable: true,searchMode: 'containsignorecase', source: approver_list, width: 250, height: 25});
            jQuery("#vendor_type").jqxComboBox({theme: theme, width: 70, autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: vendor_type, height: 25});
            jQuery("#vendor_type_grid").jqxComboBox({theme: theme, width: 70, autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: vendor_type, height: 25});
            jQuery("#paper_vendor").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Paper Vendor", source: paper_vendor, width: 180, height: 25});
            jQuery("#paper_vendor_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Paper Vendor", source: paper_vendor, width: 180, height: 25});
            jQuery("#staff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 180, height: 25});
            jQuery("#staff_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 180, height: 25});
            jQuery("#payment_type").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Payment Type", source: payment_type, width: 250, height: 25});
            jQuery("#bank").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Bank", source: bank, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            jQuery("#legal_district").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Legal District",filterable: true,searchMode: 'containsignorecase', source: legal_district, width: 250, height: 25});
            jQuery('#staff_grid,#payment_type,#bank,#paper_vendor,#paper_vendor_grid,#tax_vat_text,#staff,#vendor_type,#vendor_type_grid').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
             });
            // jQuery('#legal_region').bind('change', function (event) {
            //     change_dropdown('legal_region','','','1');        
            // });
            jQuery("#vendor_type").jqxComboBox('val','Vendor');
            //jQuery("#vendor_type_grid").jqxComboBox('val','Vendor');
            jQuery('#payment_type').bind('change', function (event) {
                jQuery('#paper_bill_form').jqxValidator('hide');
                jQuery("#bank_ac_ac").val('');
                jQuery("#bank").val('');
                jQuery("#ac_no_rtgs").val('');
                jQuery("#routing_no").val('');
                jQuery("#bank").jqxComboBox('clearSelection');
                var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    if (item.value==1)
                    {
                        jQuery("#ac_row").show();
                        jQuery("#rtgs_row").hide();
                    }
                    else
                    {
                        jQuery("#ac_row").hide();
                        jQuery("#rtgs_row").show();
                    }
                }
                else{
                    jQuery("#ac_row").hide();
                    jQuery("#rtgs_row").hide();
                }
            });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'e_by_id', type: 'int'},
                        { name: 'sts', type: 'int'},
                        { name: 'bill_type', type: 'int'},
                        { name: 'status', type: 'string'},
                        { name: 'sl_no', type: 'string'},
                        { name: 'dispatch_no', type: 'string'},
                        { name: 'bill_amount', type: 'string'},
                        { name: 'discount_amount', type: 'string'},
                        { name: 'invoice_amount', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'},
                        { name: 'vendor_name', type: 'string'},
                        { name: 'bill_months', type: 'string'},
                        { name: 'stf_by', type: 'string'},
                        { name: 'stf_dt', type: 'string'},
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/paper_bill_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data)
                    {
                        if (data != null)
                        {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                            if(data[0].TotalRows>0){
                                jQuery('#xl_btn').show();
                            }else{
                                jQuery('#xl_btn').hide();
                            }
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error){
                        alert(error);
                    },
                    formatData: function (data) {
                        var vendor_type = jQuery.trim(jQuery('input[name=vendor_type_grid]').val());
                        var paper_vendor = jQuery.trim(jQuery('#paper_vendor_grid').val());
                        var staff = jQuery.trim(jQuery('#staff_grid').val());
                        var status = jQuery.trim(jQuery('#status_grid').val());
                        var from_date = jQuery.trim(jQuery('#from_date').val());
                        var to_date = jQuery.trim(jQuery('#to_date').val());
                        jQuery.extend(data, {
                            vendor_type : vendor_type,
                            paper_vendor : paper_vendor,
                            staff : staff,
                            from_date : from_date,
                            to_date : to_date,
                            status_grid : status
                        });
                        return data;
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-330;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                        <? if(EDIT==1){?>
                          { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27 || dataRecord.sts==29)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else
                                {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOCHECKER==1){?>
                          { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 37){
                                        return '<div style=" margin-top: 8px;text-align:center">S</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                        <? }?>
                        <? if(VERIFY==1){?>
                          { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 26 || dataRecord.sts == 30 || dataRecord.sts==89){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.sts == 29) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOFINANCE==1){?>
                          { text: 'STF', datafield: 'sendtofinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtofinance\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 70) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                         <? if(VERIFYFINANCE==1){?>
                          { text: 'VF', datafield: 'verifyfinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 70){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verifyfinance\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        <? if(VIEWMEMO==1){?>
                        { text: 'BM', menu: false, datafield: 'Download', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.sts == 29 || dataRecord.sts==70){
                                //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_paper_bill_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_paper_bill_memo/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/icon_xls.gif"></div>';
                            }

                            }
                        },
                        { text: 'PDF', menu: false, datafield: 'PDF', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29 || dataRecord.sts==70){
                                    //return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><a href="<?=base_url()?>index.php/bill_ho/download_pdf_paper_bill/'+dataRecord.id+'" target="_blank"><img align="center" src="<?=base_url()?>images/pdf_icon.gif"></a></div>';
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_pdf_paper_bill/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/pdf_icon.gif"></div>';
                                }
                            }
                        },
                        <? }?>
                        { text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'SL No.', datafield: 'sl_no', editable: false,align:'left',cellsalign:'center', sortable: true, menu: true, width: '11%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\','+dataRecord.bill_type+')"><span>'+dataRecord.sl_no+'</span></a></div>';
                                
                            }
                          },
                        { text: 'Despatch No.', datafield: 'dispatch_no',editable: false, width: '17%', align:'left',cellsalign:'left'},
                        { text: 'Bill Amount', datafield: 'bill_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Discount Amount', datafield: 'discount_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Invoice Amount', datafield: 'invoice_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Bill Months', datafield: 'bill_months',editable: false, width: '20%', align:'left',cellsalign:'left'},
                        { text: 'Vendor Name', datafield: 'vendor_name',editable: false, width: '20%', align:'left',cellsalign:'left'},
                        { text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance By', datafield: 'stf_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance Date', datafield: 'stf_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });   
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        //initGrid();
                        break;
                    case 1:
                        initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
                jQuery('#paper_bill_form').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>

            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#paper_bill_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#paper_bill_form').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#paper_bill_form').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (bill_validation()==true && isValid) {
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#paper_bill_form').jqxValidator('validate', validationResult);        
            });

        });
        function call_ajax_submit(){
            
            var postdata = jQuery('#paper_bill_form').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>bill_ho/add_edit_paper_bill/"+add_edit+"/"+edit_row,
                data : postdata,
                datatype: "json",
                async:false,
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    //console.log(json);
                    //csrf_tokens=json.csrf_token;
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
                    }
                    var msg='';
                    if(edit_row>0){
                        msg='Updated';
                    }else{
                        msg="Saved";
                    }
                    clear_form();
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
                    if(add_edit=='edit'){
                        jQuery("#in_up_loading").hide();
                        jQuery("#in_up_button").show();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
                    }else{
                        jQuery("#in_req_button").show();
                        jQuery("#in_req_loading").hide();
                    }
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');

                }
            });
        }
        
        function get_dropdown_data(){
            var item = jQuery("#district").jqxComboBox('getSelectedItem');
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
                            jQuery("#staff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 250, height: 25});
                            jQuery('#staff').focusout(function() {
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
                jQuery("#staff").jqxComboBox('clearSelection');
                jQuery("#staff").val('');
            }
        }
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_paper_bill_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        var csrf_tokena = json.csrf_token;
                        jQuery("#month_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery("#lawyer_region_row").hide();
                        jQuery("#lawyer_district_row").hide();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        CheckChanged_2('','');
                        jQuery("#sl_no").val(json['result'].sl_no);
                        jQuery("#drop_down_td").hide();
                        jQuery("#text_td").show();
                        jQuery("#paper_name").html(json['result'].vendor_name);
                        jQuery("#discount_amount").val(json['result'].discount_amount);
                        jQuery("#received_dt").val(json['result'].received_dt);
                        jQuery("#memo_remarks").val(json['result'].memo_remarks);
                        jQuery("#special_bill_sts").val(json['result'].special_bill_sts);
                        jQuery("#dispatch_no").val(json['result'].dispatch_no);
                        jQuery("#tax_vat_text").jqxComboBox('val',json['result'].tax_vat_text);
                        jQuery("#payment_type").jqxComboBox('val',json['result'].payment_type);
                        if(json['result'].payment_type==1)
                        {
                            jQuery("#bank_ac_ac").val(json['result'].bank_ac);
                        }
                        else
                        {
                            jQuery("#bank").val(json['result'].bank);
                            jQuery("#routing_no").val(json['result'].routing_no);
                            jQuery("#ac_no_rtgs").val(json['result'].bank_ac);
                        }
                        var educqu=json['result'].approver_list.split(',');
                        for (var i = 0; i < educqu.length; i++)
                        {
                            jQuery("#approver_list").jqxDropDownList('checkItem', educqu[i]);
                        }
                        jQuery("#branch_show").html(json.branch_name);
                        jQuery("#tin_show").html(json.tin);
                        jQuery("#bin_show").html(json.bin);
                        
                        
              },
                error:   function(model, xhr, options){
                    alert('failed');
                    clear_form();
                },
            });
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
            
        }
        function clear_form(){
            jQuery("#lawyer_region_row").show();
            jQuery("#lawyer_district_row").show();
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#paper_vendor").jqxComboBox('clearSelection');
            jQuery("input[name='paper_vendor']").val('');
            jQuery("#staff").jqxComboBox('clearSelection');
            jQuery("input[name='staff']").val('');
            jQuery("#tax_vat_text").jqxComboBox('clearSelection');
            jQuery("input[name='tax_vat_text']").val('');
            //jQuery("#district").jqxComboBox('clearSelection');
            jQuery("#month_row").show();
            //jQuery("#district_row").show();
            jQuery("#sl_no").val('Auto Generate');
            jQuery("#dispatch_no").val('Auto Generate');
            //jQuery("#dispatch_no").val('');
            jQuery("#bill_amount").val('');
            jQuery("#hidden_vendor_id").val('');
            jQuery("#discount_amount").val('');
            jQuery("#memo_remarks").val('');
            jQuery("#received_dt").val('');
            jQuery("#payment_type").jqxComboBox('clearSelection');
            jQuery("input[name='payment_type']").val('');
            jQuery("#bill_info_body").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#special_bill_sts").val('0');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery("#payment_type").jqxComboBox('val',1);
            jQuery('#paper_bill_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#text_td").hide();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery("#paper_vendor").jqxComboBox({ disabled: false });
            jQuery("#staff").jqxComboBox({ disabled: false });
            jQuery("#bill_month").jqxDropDownList({ disabled: false });
            jQuery("#year").jqxDropDownList({ disabled: false });
            jQuery("#branch_show").html('-----');
            jQuery("#tin_show").html('-----');
            jQuery("#bin_show").html('-----');
        }


        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").show();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/paper_bill_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_for_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_for_finance_select" name="hidden_file_for_finance_select" value="0">';
                            html+='<span id="hidden_file_for_finance">';
                            jQuery('#file_for_finance').html(html);
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_from_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_from_finance_select" name="hidden_file_from_finance_select" value="0">';
                            html+='<span id="hidden_file_from_finance">';
                            jQuery('#file_from_finance').html(html);
                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
        function load_expense()
        {
            var theme = getDemoTheme();
            var  rules= [];
            rules.push(
                    { input: '#bill_month', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#bill_month input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#vendor_type', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#vendor_type input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#paper_vendor', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        var type = jQuery("#vendor_type").jqxComboBox('getSelectedItem');
                        if(type!=null)
                        {
                            if(type.value=='Vendor')
                            {
                                if(input.val() != '')
                                {
                                    return true;                
                                }
                                else
                                {
                                    jQuery("#paper_vendor input").focus();
                                    return false;
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
                    { input: '#staff', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        var type = jQuery("#vendor_type").jqxComboBox('getSelectedItem');
                        if(type!=null)
                        {
                            if(type.value=='Staff')
                            {
                                if(input.val() != '')
                                {
                                    return true;                
                                }
                                else
                                {
                                    jQuery("#staff input").focus();
                                    return false;
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
                    }
            );
            jQuery('#paper_bill_form').jqxValidator({
                  rules: rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    call_service();
                }
            }
            jQuery('#paper_bill_form').jqxValidator('validate', validationResult);
        }
        function call_service()
        {
            jQuery('#paper_bill_form').jqxValidator('hide');
            jQuery("#bill_info_body").html('');
            var bill_month = jQuery("#bill_month").val();
            var vendor_type = jQuery("#vendor_type").val();
            var legal_district = jQuery("#legal_district").val();
            var legal_region = jQuery("#legal_region").val();
            if(vendor_type=='Vendor')
            {
                var vendor = jQuery("#paper_vendor").val();
            }
            else
            {
                var vendor = jQuery("#staff").val();
            }
            
            var year = jQuery("#year").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_expense_data_paper_bill',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,legal_region:legal_region,legal_district:legal_district,vendor_type:vendor_type,vendor:vendor,bill_month:bill_month,year:year},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        jQuery("#load_button").hide();
                        jQuery("#re_generate").show();
                        if(json.bank==6)
                        {
                            jQuery("#payment_type").jqxComboBox('val',1);
                            jQuery("#bank_ac_ac").val(json.vendor_ac);
                        }
                        else
                        {
                            jQuery("#payment_type").jqxComboBox('val',2);
                            jQuery("#ac_no_rtgs").val(json.vendor_ac);
                            jQuery("#bank").jqxComboBox('val',json.bank);
                        }
                        jQuery("#branch_show").html(json.branch_name);
                        jQuery("#tin_show").html(json.tin);
                        jQuery("#bin_show").html(json.bin);
                        
                        jQuery("#paper_vendor").jqxComboBox({ disabled: true });
                        jQuery("#staff").jqxComboBox({ disabled: true });
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
                        jQuery("#year").jqxDropDownList({ disabled: true });
              },
                error:   function(model, xhr, options){
                    alert('failed');
                },
            });
        }
        function calculate_discount_amount(counter=null)
        {
            if (counter!=null) 
            {
                var org_amount = jQuery("#event_amount_"+counter).val();
                var discount_amount = jQuery("#discount_"+counter).val();
                if (parseFloat(discount_amount)<0) 
                {
                    alert("invalid Discount Amount!");
                    jQuery("#discount_"+counter).focus();
                    return false;
                }
                else if(parseFloat(discount_amount)>=parseFloat(org_amount))
                {
                    alert("Discount Amount Bigger then Main Amount!");
                    jQuery("#discount_"+counter).focus();
                    return false;
                }
            }
            var total_row = jQuery('#billcount').val();
            var check=0;
            var total_discount = 0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true && jQuery("#discount_"+i).val()!='')
                {
                    total_discount = parseFloat(total_discount)+parseFloat(jQuery("#discount_"+i).val());
                }
            }
            jQuery('#discount_amount').val(total_discount);

        }
        function CheckAll_2(checkAllBox)                            
        {                           
            var ChkState=checkAllBox.checked;
            var number=jQuery("#billcount").val();
            var counter=0;
            var amount = 0;
            var event_amount = 0;
            if (ChkState==true) 
            {
                for(var i=1; i<=number; i++){  
                    var x = document.getElementById("chkBoxSelect"+i).disabled;
                    if(x)   
                    {
                        continue;
                    }             
                    jQuery("#event_delete_"+i).val(0);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;
                    counter++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }
            }   
            else{
                for(var i=1; i<=number; i++){               
                    jQuery("#event_delete_"+i).val(1);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;                         
                }
                counter=0;
                event_amount=0;
            }           
            jQuery('#selected_amount').html(event_amount.toFixed(2));   
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2));  
            calculate_discount_amount();           
        }   
        function CheckChanged_2(checkAllBox,counter)
        {
            var ChkState=checkAllBox.checked;
            if (ChkState==true) 
            {
                jQuery("#event_delete_"+counter).val(0);
            }
            else
            {
                jQuery("#event_delete_"+counter).val(1);
            }
            var number=jQuery("#billcount").val();
            var checkco=0;
            var amount = 0;
            var event_amount = 0;
            for(var i=1; i<=number; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
            document.getElementById("checkAll").checked=true;
            }else{
            document.getElementById("checkAll").checked=false;
            }   
            jQuery('#selected_amount').html(event_amount.toFixed(2));           
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2)); 
            calculate_discount_amount();        
        }
        function bill_validation()
        {
            var total_amount = jQuery('#hidden_bill_amount').val();
            // if(total_amount>85000)
            // {
            //     alert('Sorry Total Selected bill amount crossed over 85000');
            //     return false;
            // }
            if(total_amount>85000 && jQuery('#special_bill_sts').val()=='0')
            {
                if(confirm("Total Selected bill amount crossed over 100000! are you sure want to save this as special bill?"))
                {
                    jQuery('#special_bill_sts').val(1); 
                    if(jQuery("#memo_remarks").val()=='')
                    {
                        jQuery("#memo_remarks").focus();
                        return false;
                    }
                    return true;
                }
                jQuery('#special_bill_sts').val(0); 
                return false;
            }
            var counter=0;
            var total_row = jQuery('#billcount').val();
            var check=0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true)
                {
                    var org_amount = jQuery("#event_amount_"+i).val();
                    var discount_amount = jQuery("#discount_"+i).val();
                    if (parseFloat(discount_amount)<0) 
                    {
                        alert("invalid Discount Amount!");
                        jQuery("#discount_"+i).focus();
                        return false;
                    }
                    else if(parseFloat(discount_amount)>=parseFloat(org_amount))
                    {
                        alert("Discount Amount Bigger then Main Amount!");
                        jQuery("#discount_"+i).focus();
                        return false;
                    }
                    if(jQuery("#discount_"+i).val()!='' && jQuery("#discount_remarks_"+i).val()=='')
                    {
                        alert("Discount Remarks Required!");
                        jQuery("#discount_remarks_"+i).focus();
                        return false;
                    }
                    check++;
                }
            }
            //For Add action without select any bill
            if(jQuery("#add_edit").val()=='add')
            {
                if (check<1)
                {
                    if (confirm("There is no bill selected. Are you want to cancel request?"))
                    {
                        
                        clear_form();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return true;
                }
            }
            else{
                if (check<1)
                {
                    return show_confrimation_pop_up('paper_bill');
                }
                else
                {
                    return true;
                }
            }
            return true;
        }
        function change_vendor_type()
        {
            jQuery('#paper_bill_form').jqxValidator('hide');
            var type = jQuery("#vendor_type").jqxComboBox('getSelectedItem');
            if(type!=null)
            {
                jQuery("#paper_vendor").jqxComboBox('clearSelection');
                jQuery("input[name='paper_vendor']").val('');
                if(type.value=='Vendor')
                {
                    jQuery("#paper_vendor").show();
                    jQuery("#staff").hide();
                }
                else
                {
                    jQuery("#paper_vendor").hide();
                    jQuery("#staff").show();
                }
            }
        }
        function change_vendor_type_grid()
        {
            var type = jQuery("#vendor_type_grid").jqxComboBox('getSelectedItem');
            if(type!=null)
            {
                jQuery("#paper_vendor_grid").jqxComboBox('clearSelection');
                jQuery("input[name='paper_vendor_grid']").val('');
                if(type.value=='Vendor')
                {
                    jQuery("#paper_vendor_grid").show();
                    jQuery("#staff_grid").hide();
                }
                else
                {
                    jQuery("#paper_vendor_grid").hide();
                    jQuery("#staff_grid").show();
                }
            }
        }
        function search_data(){
            jQuery("#grid_search").hide();
            jQuery("#grid_loading").show();
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
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
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Entry Form</li>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 10px;" class="back_image">
                                    <form class="form" name="paper_bill_form" id="paper_bill_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <input type="hidden" id="delete_reason_paper_bill" value="" name="delete_reason_paper_bill">
                                        <input type="hidden" name="hidden_bill_amount" id="hidden_bill_amount" value="0.00">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Serial No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="sl_no" type="text" tabindex="1" readonly class="" style="width:250px" id="sl_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr id="month_row">
                                                                <td width="40%" style="font-weight: bold;"><strong>Month Of Bill<span style="color:red">*</span> </td>
                                                                <td width="60%">
                                                                    <div id="bill_month" name="bill_month" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                   <div id="year" name="year" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <input type="button" value="Load" id="load_button" style="margin-left: 5px;width:50px !important;height:25px;float:left" onclick="load_expense()" />
                                                                    <input name="re_generate" id="re_generate" class="crmbutton small create" onclick="clear_form()" value="Reload" type="button" style="display: none;margin-left: 5px;height:25px;float:left">
                                                                </td>
                                                            </tr>
                                                            <tr id="lawyer_region_row">
                                                                <td width="40%" style="font-weight: bold;">Legal Region</td>
                                                                <td width="60%" id=""><div id="legal_region" tabindex="3" name="legal_region" style="padding-left: 3px" ></div></td>
                                                                
                                                            </tr>
                                                            <tr id="lawyer_district_row">
                                                                <td width="40%" style="font-weight: bold;">Legal District</td>
                                                                <td width="60%" id=""><div id="legal_district" tabindex="3" name="legal_district" style="padding-left: 3px" ></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Paper Vendor<span style="color:red">*</span> </td>
                                                                <td width="60%" id="drop_down_td"><div id="vendor_type" tabindex="3" onchange="change_vendor_type()" name="vendor_type" style="padding-left: 3px;float:left" ></div><div id="paper_vendor" tabindex="3" name="paper_vendor" style="padding-left: 3px;float:left" ></div><div id="staff" tabindex="3" name="staff" style="padding-left: 3px;display:none;float:left" ></div></td>
                                                                <td width="60%" style="display:none" id="text_td"><span id="paper_name"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Despatch No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="dispatch_no" readonly type="text" tabindex="4" class="" style="width:250px" id="dispatch_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Bill Amount</td>
                                                                <td width="60%" ><input name="bill_amount" type="text" tabindex="5" class="" readonly style="width:250px" id="bill_amount" value="<?=isset($result->bill_amount)?$result->bill_amount:''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Discount Amount</td>
                                                                <td width="60%" ><input name="discount_amount" readonly type="text" tabindex="6" class="" style="width:250px" id="discount_amount" value="<?=isset($result->discount_amount)?$result->discount_amount:''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Receiving Date From Field<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input type="text" name="received_dt" tabindex="7" placeholder="dd/mm/yyyy" style="width:250px;" id="received_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("received_dt");</script></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Memo Remarks</td>
                                                                <td width="60%" ><textarea name="memo_remarks" tabindex="9" class="text-input-big" id="memo_remarks" style="height:40px !important;width:250px"><?=isset($result->memo_remarks)?$result->memo_remarks:''?></textarea></td>
                                                            </tr>  
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Approver List<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="approver_list" name="approver_list" style="padding-left: 3px" tabindex="10"></div></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Tax Vat Text<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="tax_vat_text" name="tax_vat_text" style="padding-left: 3px" tabindex="11"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Payment Type<span style="color:red">*</span></td>
                                                                <td width="60%" ><div id="payment_type" name="payment_type" tabindex="11" style="padding-left: 3px;float:left"></div></td>
                                                            </tr>   
                                                            <tr id="ac_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">AC NO.<span style="color:red">*</span></td>
                                                                <td width="60%" ><input name="bank_ac_ac" type="text" tabindex="12" class="" style="width:250px" id="bank_ac_ac" value="" /></td>
                                                            </tr>
                                                            <tr id="rtgs_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">Rtgs Info<span style="color:red">*</span> </td>
                                                                <td width="60%" >
                                                                    <div id="bank" name="bank" style="padding-left: 3px" tabindex="13"></div>
                                                                    <div style="background-color:#eaeaea;padding:10px;width:233px" id="spfm">
                                                                    AC NO.<span style="color:red">*</span><br/><input name="ac_no_rtgs" onblur="" tabindex="14" type="text" class="" style="width:225px" id="ac_no_rtgs" value="" /><br/>
                                                                    Routing No.<br/><input name="routing_no" onblur="" tabindex="15" type="text" class="" style="width:225px" id="routing_no" value="" />
                                                                </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Branch</td>
                                                                <td width="60%" ><span id="branch_show">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">TIN</td>
                                                                <td width="60%" ><span id="tin_show">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">BIN</td>
                                                                <td width="60%" ><span id="bin_show">-----</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row">
                                                <td colspan="2">
                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bill Info</span>
                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                            <thead>
                                                                <tr>
                                                                    <td width="2%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></td>
                                                                    <td width="3%" style="font-weight: bold;text-align:center">SL</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Paper Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Case No.</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Paper Publication Date</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Paper Publication Copy</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Approval Copy</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Amount</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Discount Amount</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Remarks</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bill_info_body">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                        <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                                <? if(EDIT==1){?>
                                                <tr id="up_button" style="display: none;">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                        <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                    </div>
                                </div>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:70px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                        <form method="POST" name="form" id="grid_search_form"  style="margin:0px;" action="<?=base_url()?>index.php/bill_ho/mk_xl_all_report_both_all_and_account_wise">
                                            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="hidden" name="report_type" id="report_type" value="paper_bill">
                                            <table id="deal_body" style="display:block;width:100%">
                                                <tr>
                                                    
                                                    <td style="text-align:right;width:7%"><strong>Vendor Type&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:10%"><div id="vendor_type_grid" tabindex="3" onchange="change_vendor_type_grid()" name="vendor_type_grid" style="padding-left: 3px;float:left" ></div></td>
                                                    <td style="text-align:right;width:8%"><strong>Vendor </strong></td>
                                                    <td style="width:10%">
                                                        <div id="paper_vendor_grid" tabindex="3" name="paper_vendor_grid" style="padding-left: 3px;float:left" ></div><div id="staff_grid" tabindex="3" name="staff_grid" style="padding-left: 3px;display:none;float:left" ></div>
                                                    </td>
                                                    <td style="text-align:right;width:7%"><strong>Status</strong> </td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="status_grid" name="status_grid"></div></td>
                                                    <td style="text-align:right;width:7%"><strong>From</strong> </td>
                                                    <td style="width:10%"><input type="text" name="from_date" placeholder="dd/mm/yyyy" style="width:100px;" id="from_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("from_date");</script></td>
                                                    <td style="text-align:right;width:7%"><strong>To</strong> </td>
                                                    <td style="width:10%"><input type="text" name="to_date" placeholder="dd/mm/yyyy" style="width:100px;" id="to_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("to_date");</script></td>
                                                    <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                        <span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                    </td>
                                                    <td style="width:5%;text-align: right;display: none;" id="xl_btn" valign="top">
                                                        <button type="submit" formtarget="_blank" name="all_bill" title="Bill Wise" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                        <button type="submit" formtarget="_blank" name="ac_wise" title="Account Wise"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                  </div>
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/bill_ho/bulk_operation/apv/paper_bill" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row">
                                <td>Attachment (If Any):</td>
                                <td>
                                    <span id="file_for_finance"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>

<!-- For Others Bill -->
<?php if ($operation=='other' && VIEWOTHERS==1): ?>

    <script type="text/javascript">
        var start=1990;
        let date =  new Date().getFullYear();
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        var tax_vat_text = [<? $i=1; foreach($tax_vat_text as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var bank = [<? $i=1; foreach($bank as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var payment_type = [<? $i=1; foreach($payment_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var approver_list = [<? $i=1; foreach($approver_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var theme = getDemoTheme();
            rules2=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#vendor_name', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#vendor_name").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            rules3=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            jQuery(document).ready(function () {
                jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 100, height: 25});
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#approver_list").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Select Approver List",filterable: true,searchMode: 'containsignorecase', source: approver_list, width: 250, height: 25});
            jQuery("#payment_type").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Payment Type", source: payment_type, width: 250, height: 25});
            jQuery("#bank").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Bank", source: bank, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            jQuery("#tax_vat_text").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Tax Vat Text", source: tax_vat_text, width: 250, height: 25});
            jQuery('#payment_type,#bank').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
             });
            jQuery('#payment_type,#tax_vat_text').bind('change', function (event) {
                jQuery('#other_bill_form').jqxValidator('hide');
                jQuery("#bank_ac_ac").val('');
                jQuery("#bank").val('');
                jQuery("#ac_no_rtgs").val('');
                jQuery("#routing_no").val('');
                jQuery("#bank").jqxComboBox('clearSelection');
                var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    if (item.value==1)
                    {
                        jQuery("#ac_row").show();
                        jQuery("#rtgs_row").hide();
                    }
                    else
                    {
                        jQuery("#ac_row").hide();
                        jQuery("#rtgs_row").show();
                    }
                }
                else{
                    jQuery("#ac_row").hide();
                    jQuery("#rtgs_row").hide();
                }
            });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'e_by_id', type: 'int'},
                        { name: 'sts', type: 'int'},
                        { name: 'bill_type', type: 'int'},
                        { name: 'status', type: 'string'},
                        { name: 'sl_no', type: 'string'},
                        { name: 'dispatch_no', type: 'string'},
                        { name: 'bill_amount', type: 'string'},
                        { name: 'discount_amount', type: 'string'},
                        { name: 'invoice_amount', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'},
                        { name: 'stf_by', type: 'string'},
                        { name: 'stf_dt', type: 'string'},
                        { name: 'bill_months', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/other_bill_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
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
                    loadError: function(xhr, status, error){
                        alert(error);
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-250;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                        <? if(EDIT==1){?>
                          { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27 || dataRecord.sts==29)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else
                                {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOCHECKER==1){?>
                          { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 37){
                                        return '<div style=" margin-top: 8px;text-align:center">S</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                        <? }?>
                        <? if(VERIFY==1){?>
                          { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 26 || dataRecord.sts == 30 || dataRecord.sts==89){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.sts == 29) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOFINANCE==1){?>
                          { text: 'STF', datafield: 'sendtofinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtofinance\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 70) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                         <? if(VERIFYFINANCE==1){?>
                          { text: 'VF', datafield: 'verifyfinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 70){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verifyfinance\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        <? if(VIEWMEMO==1){?>
                        { text: 'BM', menu: false, datafield: 'Download', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';

                            }
                        },
                        <? }?>
                        { text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'SL No.', datafield: 'sl_no', editable: false,align:'left',cellsalign:'center', sortable: true, menu: true, width: '11%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\','+dataRecord.bill_type+')"><span>'+dataRecord.sl_no+'</span></a></div>';
                                
                            }
                          },
                        { text: 'Despatch No.', datafield: 'dispatch_no',editable: false, width: '17%', align:'left',cellsalign:'left'},
                        { text: 'Bill Amount', datafield: 'bill_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Discount Amount', datafield: 'discount_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Invoice Amount', datafield: 'invoice_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Bill Months', datafield: 'bill_months',editable: false, width: '20%', align:'left',cellsalign:'left'},
                        { text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance By', datafield: 'stf_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance Date', datafield: 'stf_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });   
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        //initGrid();
                        break;
                    case 1:
                        initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
                jQuery('#other_bill_form').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>

            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#other_bill_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#other_bill_form').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#other_bill_form').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#other_bill_form').jqxValidator('validate', validationResult);        
            });


        });
        function call_ajax_submit(){
            
            var postdata = jQuery('#other_bill_form').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>bill_ho/add_edit_other_bill/"+add_edit+"/"+edit_row,
                data : postdata,
                datatype: "json",
                async:false,
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    //console.log(json);
                    //csrf_tokens=json.csrf_token;
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
                    }
                    var msg='';
                    if(edit_row>0){
                        msg='Updated';
                    }else{
                        msg="Saved";
                    }
                    clear_form();
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
                    if(add_edit=='edit'){
                        jQuery("#in_up_loading").hide();
                        jQuery("#in_up_button").show();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
                    }else{
                        jQuery("#in_req_button").show();
                        jQuery("#in_req_loading").hide();
                    }
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');

                }
            });
        }
        
        function get_dropdown_data(){
            var item = jQuery("#district").jqxComboBox('getSelectedItem');
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
                            jQuery("#staff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 250, height: 25});
                            jQuery('#staff').focusout(function() {
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
                jQuery("#staff").jqxComboBox('clearSelection');
                jQuery("#staff").val('');
            }
        }
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_other_bill_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        var csrf_tokena = json.csrf_token;
                        jQuery("#month_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        CheckChanged_2('','');
                        jQuery("#sl_no").val(json['result'].sl_no);
                        jQuery("#drop_down_td").hide();
                        jQuery("#text_td").show();
                        jQuery("#vendor_name_view").html(json['result'].vendor_name);
                        jQuery("#discount_amount").val(json['result'].discount_amount);
                        jQuery("#received_dt").val(json['result'].received_dt);
                        jQuery("#memo_remarks").val(json['result'].memo_remarks);
                        jQuery("#dispatch_no").val(json['result'].dispatch_no);
                        jQuery("#tax_vat_text").jqxComboBox('val',json['result'].tax_vat_text);
                        jQuery("#payment_type").jqxComboBox('val',json['result'].payment_type);
                        if(json['result'].payment_type==1)
                        {
                            jQuery("#bank_ac_ac").val(json['result'].bank_ac);
                        }
                        else
                        {
                            jQuery("#bank").val(json['result'].bank);
                            jQuery("#routing_no").val(json['result'].routing_no);
                            jQuery("#ac_no_rtgs").val(json['result'].bank_ac);
                        }
                        var educqu=json['result'].approver_list.split(',');
                        for (var i = 0; i < educqu.length; i++)
                        {
                            jQuery("#approver_list").jqxDropDownList('checkItem', educqu[i]);
                        }
                        
                        
              },
                error:   function(model, xhr, options){
                    alert('failed');
                    clear_form();
                },
            });
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
            
        }
        function clear_form(){
            jQuery("#year").jqxDropDownList('val', date);
            //jQuery("#paper_vendor").jqxComboBox('clearSelection');
            //jQuery("#district").jqxComboBox('clearSelection');
            jQuery("#month_row").show();
            //jQuery("#district_row").show();
            jQuery("#sl_no").val('Auto Generate');
            jQuery("#dispatch_no").val('Auto Generate');
            //jQuery("#dispatch_no").val('');
            jQuery("#vendor_name").val('');
            jQuery("#bill_amount").val('');
            jQuery("#hidden_vendor_id").val('');
            jQuery("#discount_amount").val('');
            jQuery("#memo_remarks").val('');
            jQuery("#received_dt").val('');
            jQuery("#payment_type").jqxComboBox('clearSelection');
            jQuery("input[name='payment_type']").val('');
            jQuery("#bill_info_body").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery("#payment_type").jqxComboBox('val',1);
            jQuery('#other_bill_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#text_td").hide();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery("#bill_month").jqxDropDownList({ disabled: false });
            jQuery("#year").jqxDropDownList({ disabled: false });
            document.getElementById("vendor_name").readOnly = false;
        }


        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").show();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/other_bill_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_for_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_for_finance_select" name="hidden_file_for_finance_select" value="0">';
                            html+='<span id="hidden_file_for_finance">';
                            jQuery('#file_for_finance').html(html);
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_from_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_from_finance_select" name="hidden_file_from_finance_select" value="0">';
                            html+='<span id="hidden_file_from_finance">';
                            jQuery('#file_from_finance').html(html);
                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
        function load_expense()
        {
            var theme = getDemoTheme();
            var  rules= [];
            rules.push(
                    { input: '#bill_month', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#bill_month input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#vendor_name', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#vendor_name").focus();
                            return false;
                        }
                    }  
                    }
            );
            jQuery('#other_bill_form').jqxValidator({
                  rules: rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    call_service();
                }
            }
            jQuery('#other_bill_form').jqxValidator('validate', validationResult);
        }
        function call_service()
        {
            jQuery('#other_bill_form').jqxValidator('hide');
            jQuery("#bill_info_body").html('');
            var bill_month = jQuery("#bill_month").val();
            var year = jQuery("#year").val();
            var vendor = jQuery("#vendor_name").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_expense_data_other_bill',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,vendor:vendor,bill_month:bill_month,year:year},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        jQuery("#load_button").hide();
                        jQuery("#re_generate").show();
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
                        jQuery("#year").jqxDropDownList({ disabled: true });
                        document.getElementById("vendor_name").readOnly = true;
              },
                error:   function(model, xhr, options){
                    alert('failed');
                },
            });
        }
        function CheckAll_2(checkAllBox)                            
        {                           
            var ChkState=checkAllBox.checked;
            var number=jQuery("#billcount").val();
            var counter=0;
            var amount = 0;
            var event_amount = 0;
            if (ChkState==true) 
            {
                for(var i=1; i<=number; i++){   
                    var x = document.getElementById("chkBoxSelect"+i).disabled;
                    if(x)   
                    {
                        continue;
                    }            
                    jQuery("#event_delete_"+i).val(0);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;
                    counter++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }
            }   
            else{
                for(var i=1; i<=number; i++){               
                    jQuery("#event_delete_"+i).val(1);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;                         
                }
                counter=0;
                event_amount=0;
            }           
            jQuery('#selected_amount').html(event_amount.toFixed(2));   
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2));             
        }   
        function CheckChanged_2(checkAllBox,counter)
        {
            var ChkState=checkAllBox.checked;
            if (ChkState==true) 
            {
                jQuery("#event_delete_"+counter).val(0);
            }
            else
            {
                jQuery("#event_delete_"+counter).val(1);
            }
            var number=jQuery("#billcount").val();
            var checkco=0;
            var amount = 0;
            var event_amount = 0;
            for(var i=1; i<=number; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
            document.getElementById("checkAll").checked=true;
            }else{
            document.getElementById("checkAll").checked=false;
            }   
            jQuery('#selected_amount').html(event_amount.toFixed(2));           
            jQuery('#bill_amount').val(event_amount.toFixed(2));    
            jQuery('#hidden_bill_amount').val(event_amount.toFixed(2));         
        }
        function bill_validation()
        {
            var counter=0;
            var total_row = jQuery('#billcount').val();
            var check=0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true)
                {
                    check++;
                }
            }
            //For Add action without select any bill
            if(jQuery("#add_edit").val()=='add')
            {
                if (check<1)
                {
                    if (confirm("There is no bill selected. Are you want to cancel request?"))
                    {
                        
                        clear_form();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return true;
                }
            }
            else{
                if (check<1)
                {
                    return show_confrimation_pop_up('other_bill');

                }
                else
                {
                    return true;
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
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Entry Form</li>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 10px;" class="back_image">
                                    <form class="form" name="other_bill_form" id="other_bill_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="delete_reason_other_bill" value="" name="delete_reason_other_bill">
                                        <input type="hidden" name="hidden_bill_amount" id="hidden_bill_amount" value="0.00">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Serial No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="sl_no" type="text" tabindex="1" readonly class="" style="width:250px" id="sl_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr id="month_row">
                                                                <td width="40%" style="font-weight: bold;"><strong>Month Of Bill<span style="color:red">*</span> </td>
                                                                <td width="60%">
                                                                    <div id="bill_month" name="bill_month" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <div id="year" name="year" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <input type="button" value="Load" id="load_button" style="margin-left: 5px;width:50px !important;height:25px;float:left" onclick="load_expense()" />
                                                                    <input name="re_generate" id="re_generate" class="crmbutton small create" onclick="clear_form()" value="Reload" type="button" style="display: none;margin-left: 5px;height:25px;float:left">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Vendor Name<span style="color:red">*</span> </td>
                                                                <td width="60%" id="drop_down_td"><input name="vendor_name" type="text" tabindex="3" class="" style="width:250px" id="vendor_name" value="" /></td>
                                                                <td width="60%" style="display:none" id="text_td"><span id="vendor_name_view"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Despatch No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="dispatch_no" readonly type="text" tabindex="4" class="" style="width:250px" id="dispatch_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Bill Amount</td>
                                                                <td width="60%" ><input name="bill_amount" type="text" tabindex="5" class="" readonly style="width:250px" id="bill_amount" value="" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Discount Amount</td>
                                                                <td width="60%" ><input name="discount_amount" type="text" tabindex="6" class="" style="width:250px" id="discount_amount" value="" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Receiving Date From Field<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input type="text" name="received_dt" tabindex="7" placeholder="dd/mm/yyyy" style="width:250px;" id="received_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("received_dt");</script></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Memo Remarks</td>
                                                                <td width="60%" ><textarea name="memo_remarks" tabindex="9" class="text-input-big" id="memo_remarks" style="height:40px !important;width:250px"><?=isset($result->memo_remarks)?$result->memo_remarks:''?></textarea></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Approver List<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="approver_list" name="approver_list" style="padding-left: 3px" tabindex="10"></div></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Tax Vat Text<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="tax_vat_text" name="tax_vat_text" style="padding-left: 3px" tabindex="11"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Payment Type<span style="color:red">*</span></td>
                                                                <td width="60%" ><div id="payment_type" name="payment_type" tabindex="11" style="padding-left: 3px;float:left"></div></td>
                                                            </tr>   
                                                            <tr id="ac_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">AC NO.<span style="color:red">*</span></td>
                                                                <td width="60%" ><input name="bank_ac_ac" type="text" tabindex="12" class="" style="width:250px" id="bank_ac_ac" value="" /></td>
                                                            </tr>
                                                            <tr id="rtgs_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">Rtgs Info<span style="color:red">*</span> </td>
                                                                <td width="60%" >
                                                                    <div id="bank" name="bank" style="padding-left: 3px" tabindex="13"></div>
                                                                    <div style="background-color:#eaeaea;padding:10px;width:233px" id="spfm">
                                                                    AC NO.<span style="color:red">*</span><br/><input name="ac_no_rtgs" onblur="" tabindex="14" type="text" class="" style="width:225px" id="ac_no_rtgs" value="" /><br/>
                                                                    Routing No.<br/><input name="routing_no" onblur="" tabindex="15" type="text" class="" style="width:225px" id="routing_no" value="" />
                                                                </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row">
                                                <td colspan="2">
                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bill Info</span>
                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                            <thead>
                                                                <tr>
                                                                    <td width="2%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></td>
                                                                    <td width="3%" style="font-weight: bold;text-align:center">SL</td>
                                                                    <td width="20%" style="font-weight: bold;text-align:center">Vendor Name</td>
                                                                    <td width="25%" style="font-weight: bold;text-align:center">Date of legal steps</td>
                                                                    <td width="25%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
                                                                    <td width="25%" style="font-weight: bold;text-align:center">Amount</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bill_info_body">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                        <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                                <? if(EDIT==1){?>
                                                <tr id="up_button" style="display: none;">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                        <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                    </div>
                                </div>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    &nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row">
                                <td>Attachment (If Any):</td>
                                <td>
                                    <span id="file_for_finance"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>
<!-- For HC Lawyer Bill -->
<?php if ($operation=='lawyer_bill_hc' && VIEWLAWYERBILL==1): ?>

    <script type="text/javascript">
        var start=1990;
        let date =  new Date().getFullYear();
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        var tax_vat_text = [<? $i=1; foreach($tax_vat_text as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var lawyer = [];
        var status_grid = [<? $i=1; foreach($status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var legal_district = [];
        var bank = [<? $i=1; foreach($bank as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var payment_type = [<? $i=1; foreach($payment_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        //var legal_am = [<? $i=1; foreach($legal_am as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->pin.')"}'; $i++;}?>];
        var approver_list = [<? $i=1; foreach($approver_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
           var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var theme = getDemoTheme();
            rules2=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#lawyer input").focus();
                        return false;
                    }
                }  
                },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            rules3=[
                { input: '#sl_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#sl_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#tax_vat_text', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#tax_vat_text input").focus();
                        return false;
                    }
                }  
                },
                { input: '#memo_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#memo_remarks").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#approver_list', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#approver_list input").focus();
                        return false;
                    }
                }  
                },
                { input: '#received_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#received_dt").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#received_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#discount_amount', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabatic('discount_amount'))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#discount_amount', message: 'Bigger then Amount', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(parseFloat(input.val(), 10)>0 && parseFloat(input.val(), 10)>=parseFloat(jQuery("#bill_amount").val(), 10))
                        {
                            jQuery("#discount_amount").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#payment_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='payment_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#payment_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#bank', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
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
                    else
                    {
                        return true;
                    }
                }  
                },
                { input: '#ac_no_rtgs', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#ac_no_rtgs").focus();
                                return false;
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
                { input: '#ac_no_rtgs', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==2)
                        {
                            if(!checknumber_alphabatic('ac_no_rtgs'))
                            {
                                jQuery("#ac_no_rtgs").focus();
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
                // { input: '#ac_no_rtgs', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#ac_no_rtgs").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: 'required!', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val() != '')
                //             {
                //                 return true;                
                //             }
                //             else
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                // { input: '#routing_no', message: '9 digit required!', action: 'blur,change', rule: function (input) {                    
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==2)
                //         {
                //             if(input.val().length >9 || input.val().length<9)
                //             {
                //                 jQuery("#routing_no").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // },
                { input: '#bank_ac_ac', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(input.val() != '')
                            {
                                return true;                
                            }
                            else
                            {
                                jQuery("#bank_ac_ac").focus();
                                return false;
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
                { input: '#bank_ac_ac', message: 'only numeric', action: 'blur,change', rule: function (input) {                    
                    var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                    if (item!=null)
                    {
                        if (item.value==1)
                        {
                            if(!checknumber_alphabatic('bank_ac_ac'))
                            {
                                jQuery("#bank_ac_ac").focus();
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
                // { input: '#bank_ac_ac', message: '16 digit required', action: 'blur,change', rule: function (input) {                   
                //     var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                //     if (item!=null)
                //     {
                //         if (item.value==1)
                //         {
                //             if(input.val().length >16 || input.val().length<16)
                //             {
                //                 jQuery("#bank_ac_ac").focus();
                //                 return false;               
                //             }
                //             else
                //             {
                //                 return true;
                //             }
                //         }
                //         else
                //         {
                //             return true;
                //         }

                //     }
                //     else
                //     {
                //         return true;
                //     }
                // }  
                // }
            ];
            jQuery(document).ready(function () {
            jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 100, height: 25});
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#lawyer_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: '98%', height: 25});
            jQuery("#tax_vat_text").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Tax Vat Text", source: tax_vat_text, width: 250, height: 25});
            jQuery("#approver_list").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Select Approver List",filterable: true,searchMode: 'containsignorecase', source: approver_list, width: 250, height: 25});
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
            jQuery("#payment_type").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Payment Type", source: payment_type, width: 250, height: 25});
            jQuery("#bank").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Bank", source: bank, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#legal_region_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: '98%', height: 25});
            jQuery("#status_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Status", source: status_grid, width: '98%', height: 25});
            jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});
            jQuery("#legal_district_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: '98%', height: 25});
            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');        
            });
            jQuery('#legal_region_grid').bind('change', function (event) {
                change_dropdown('legal_region_grid');        
            });
            jQuery('#legal_district').bind('change', function (event) {
                change_dropdown('legal_district_lawyer');        
            });
            jQuery('#legal_district_grid').bind('change', function (event) {
                change_dropdown('legal_district_lawyer_grid');        
            });
            <?php if (check_group('1')): ?>
                change_dropdown('legal_region','<?=$this->session->userdata['ast_user']['legal_region']?>');
            <?php endif ?>
            jQuery('#payment_type,#bank,#lawyer,#tax_vat_text,#legal_region,#legal_district').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
             });
            jQuery('#lawyer').bind('change', function (event) {
                var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    get_lawyer_email_phone(item.value);
                }
            });
            jQuery('#payment_type').bind('change', function (event) {
                jQuery('#lawyer_bill_form').jqxValidator('hide');
                jQuery("#bank_ac_ac").val('');
                jQuery("#bank").val('');
                jQuery("#ac_no_rtgs").val('');
                jQuery("#routing_no").val('');
                jQuery("#bank").jqxComboBox('clearSelection');
                var item = jQuery("#payment_type").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    if (item.value==1)
                    {
                        jQuery("#ac_row").show();
                        jQuery("#rtgs_row").hide();
                    }
                    else
                    {
                        jQuery("#ac_row").hide();
                        jQuery("#rtgs_row").show();
                    }
                }
                else{
                    jQuery("#ac_row").hide();
                    jQuery("#rtgs_row").hide();
                }
            });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'e_by_id', type: 'int'},
                        { name: 'sts', type: 'int'},
                        { name: 'bill_type', type: 'int'},
                        { name: 'status', type: 'string'},
                        { name: 'sl_no', type: 'string'},
                        { name: 'dispatch_no', type: 'string'},
                        { name: 'bill_amount', type: 'string'},
                        { name: 'discount_amount', type: 'string'},
                        { name: 'invoice_amount', type: 'string'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'region_name', type: 'string'},
                        { name: 'district_name', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'},
                        { name: 'stf_by', type: 'string'},
                        { name: 'stf_dt', type: 'string'},
                        { name: 'bill_months', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/bill_ho/lawyer_hc_grid',
                    cache: false,
                    filter: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function()
                    {
                        // update the grid and send a request to the server.
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data)
                    {
                        if (data != null)
                        {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                            if(data[0].TotalRows>0){
                                jQuery('#xl_btn').show();
                            }else{
                                jQuery('#xl_btn').hide();
                            }
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error){
                        alert(error);
                    },
                    formatData: function (data) {
                        var legal_region = jQuery.trim(jQuery('input[name=legal_region_grid]').val());
                        var legal_district = jQuery.trim(jQuery('#legal_district_grid').val());
                        var lawyer = jQuery.trim(jQuery('#lawyer_grid').val());
                        var status = jQuery.trim(jQuery('#status_grid').val());
                        var from_date = jQuery.trim(jQuery('#from_date').val());
                        var to_date = jQuery.trim(jQuery('#to_date').val());
                        jQuery.extend(data, {
                            legal_region : legal_region,
                            legal_district : legal_district,
                            lawyer_grid : lawyer,
                            from_date : from_date,
                            to_date : to_date,
                            status_grid : status
                        });
                        return data;
                    }
                });
                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function (row, datafield, columntype) {
                    var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                      return false;
                    };
                };
                var win_h=jQuery( window ).height()-320;
                jQuery("#jqxGrid2").jqxGrid({
                    width:'99%',
                    height:win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    //autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    enablehover: true,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj){
                        return obj.data;
                    },
                    columns: [
                        { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                        <? if(EDIT==1){?>
                          { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27 || dataRecord.sts==29)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else
                                {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOCHECKER==1){?>
                          { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 25 || dataRecord.sts == 27)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 37){
                                        return '<div style=" margin-top: 8px;text-align:center">S</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                        <? }?>
                        <? if(VERIFY==1){?>
                          { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 26 || dataRecord.sts == 30 || dataRecord.sts==89){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.sts == 29) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDTOFINANCE==1){?>
                          { text: 'STF', datafield: 'sendtofinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 29){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtofinance\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 70) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(VERIFYFINANCE==1){?>
                          { text: 'VF', datafield: 'verifyfinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 70){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verifyfinance\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        <? if(VIEWMEMO==1){?>
                        { text: 'BM', menu: false, datafield: 'Download', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.sts == 29){
                                //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/bill_ho/download_lawyer_bill_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_lawyer_bill_memo/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/icon_xls.gif"></div>';
                            }

                            }
                        },
                        { text: 'PDF', menu: false, datafield: 'PDF', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                  if(dataRecord.sts == 29){  
                                    //return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><a href="<?=base_url()?>index.php/bill_ho/download_pdf_lawyer_bill/'+dataRecord.id+'" target="_blank"><img align="center" src="<?=base_url()?>images/pdf_icon.gif"></a></div>';
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" ><img onclick="download_memo(\'<?=base_url()?>index.php/bill_ho/download_pdf_lawyer_bill/'+dataRecord.id+'\')" align="center" src="<?=base_url()?>images/pdf_icon.gif"></div>';
                                }
                              }
                        },
                        <? }?>
                        { text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'Lawyer Name', datafield: 'lawyer_name',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'SL No.', datafield: 'sl_no', editable: false,align:'left',cellsalign:'center', sortable: true, menu: true, width: '11%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\','+dataRecord.bill_type+')"><span>'+dataRecord.sl_no+'</span></a></div>';
                                
                            }
                          },
                        { text: 'Despatch No.', datafield: 'dispatch_no',editable: false, width: '17%', align:'left',cellsalign:'left'},
                        { text: 'Bill Amount', datafield: 'bill_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Discount Amount', datafield: 'discount_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Invoice Amount', datafield: 'invoice_amount',editable: false, width: '12%', align:'left',cellsalign:'left'},
                        { text: 'Bill Months', datafield: 'bill_months',editable: false, width: '20%', align:'left',cellsalign:'left'},
                        { text: 'Region Name', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'District Name', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance By', datafield: 'stf_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Send To Finance Date', datafield: 'stf_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
                 jQuery("#r_history").jqxWindow({ theme: theme,  width: 800, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#history_ok") });   
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1200, height:600, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#financecancel,#verify_cancel") });
                jQuery('#details').on('close', function (event) {
                    jQuery('#delete_convence').jqxValidator('hide');
                });
            }
            // jqx tab init
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        //initGrid();
                        break;
                    case 1:
                        initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
                jQuery('#lawyer_bill_form').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>

            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#lawyer_bill_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#lawyer_bill_form').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && bill_validation()==true) {
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);        
            });
        });
        function call_ajax_submit(){
            
            var postdata = jQuery('#lawyer_bill_form').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>bill_ho/add_edit_lawyer_bill/"+add_edit+"/"+edit_row,
                data : postdata,
                datatype: "json",
                async:false,
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    //console.log(json);
                    //csrf_tokens=json.csrf_token;
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
                    }
                    var msg='';
                    if(edit_row>0){
                        msg='Updated';
                    }else{
                        msg="Saved";
                    }
                    clear_form();
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
                    if(add_edit=='edit'){
                        jQuery("#in_up_loading").hide();
                        jQuery("#in_up_button").show();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
                    }else{
                        jQuery("#in_req_button").show();
                        jQuery("#in_req_loading").hide();
                    }
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');

                }
            });
        }
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
                            jQuery("#tin_show").html(json['row_info']['tin_number']);
                            jQuery("#bin_show").html(json['row_info']['bin_number']);
                            if(json['row_info']['bank']==6) //For Brac Bank Account
                            {
                                jQuery("#payment_type").jqxComboBox('val',1);
                                jQuery("#bank_ac_ac").val(json['row_info']['ac_no']);
                            }
                            else
                            {
                                jQuery("#payment_type").jqxComboBox('val',2);
                                jQuery("#bank").jqxComboBox('val',json['row_info']['bank']);
                                jQuery("#ac_no_rtgs").val(json['row_info']['ac_no']);
                            }

                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_lawyer_edit_data_hc',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        var csrf_tokena = json.csrf_token;
                        jQuery("#month_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        jQuery("#bill_info_body_legal").append(json.legal_bill_str);
                        jQuery("#bill_info_row_legal").show();
                        CheckChanged_2('','','legal');
                        CheckChanged_2('','','pending');
                        jQuery("#sl_no").val(json['result'].sl_no);
                        jQuery("#drop_down_td").hide();
                        jQuery("#text_td").show();
                        jQuery("#lawyer_region_row").hide();
                        jQuery("#lawyer_district_row").hide();
                        jQuery("#lawyer_name").html(json['result'].vendor_name);
                        jQuery("#discount_amount").val(json['result'].discount_amount);
                        jQuery("#received_dt").val(json['result'].received_dt);
                        jQuery("#memo_remarks").val(json['result'].memo_remarks);
                        jQuery("#dispatch_no").val(json['result'].dispatch_no);
                        jQuery("#tax_vat_text").jqxComboBox('val',json['result'].tax_vat_text);
                        jQuery("#tin_show").html(json['lawyer_info']['tin_number']);
                        jQuery("#bin_show").html(json['lawyer_info']['bin_number']);
                        jQuery("#payment_type").jqxComboBox('val',json['result'].payment_type);
                        if(json['result'].payment_type==1)
                        {
                            jQuery("#bank_ac_ac").val(json['result'].bank_ac);
                        }
                        else
                        {
                            jQuery("#bank").val(json['result'].bank);
                            jQuery("#routing_no").val(json['result'].routing_no);
                            jQuery("#ac_no_rtgs").val(json['result'].bank_ac);
                        }
                        var educqu=json['result'].approver_list.split(',');
                        for (var i = 0; i < educqu.length; i++)
                        {
                            jQuery("#approver_list").jqxDropDownList('checkItem', educqu[i]);
                        }
                        
                        
              },
                error:   function(model, xhr, options){
                    alert('failed');
                    clear_form();
                },
            });
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
            
        }
        function clear_form(){
            jQuery("#lawyer_region_row").show();
            jQuery("#lawyer_district_row").show();
            document.getElementById("checkAll_legal").checked=false;
            document.getElementById("checkAll_pending").checked=false;
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#legal_region").jqxComboBox('clearSelection');
            jQuery("input[name='legal_region']").val('');
            jQuery("#legal_district").jqxComboBox('clearSelection');
            jQuery("input[name='legal_district']").val('');
            jQuery("#tax_vat_text").jqxComboBox('clearSelection');
            jQuery("input[name='tax_vat_text']").val('');
            //jQuery("#district").jqxComboBox('clearSelection');
            jQuery("#month_row").show();
            //jQuery("#district_row").show();
            jQuery("#sl_no").val('Auto Generate');
            jQuery("#dispatch_no").val('Auto Generate');
            //jQuery("#dispatch_no").val('');
            jQuery("#bill_amount").val('');
            jQuery("#hidden_vendor_id").val('');
            jQuery("#discount_amount").val('');
            jQuery("#memo_remarks").val('');
            jQuery("#received_dt").val('');
            jQuery("#payment_type").jqxComboBox('clearSelection');
            jQuery("input[name='payment_type']").val('');
            jQuery("#bill_info_body").html('');
            jQuery("#bill_info_body_legal").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery("#proxy_info_body").html('');
            jQuery("#proxy_row").hide();
            jQuery("#payment_type").jqxComboBox('val',1);
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#text_td").hide();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery("#legal_region").jqxComboBox({ disabled: false });
            jQuery("#legal_district").jqxComboBox({ disabled: false });
            jQuery("#lawyer").jqxComboBox({ disabled: false });
            jQuery("#bill_month").jqxDropDownList({ disabled: false });
            jQuery("#year").jqxDropDownList({ disabled: false });
            jQuery("#tin_show").html('-----');
            jQuery("#bin_show").html('-----');
        }


        function details (id,editrow,operation) {
            jQuery("#return_reason").val('');
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            jQuery("#attachment_row_finance").hide();
            jQuery("#verify_return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#attachment_row").hide();
                jQuery("#verify_row").hide();
            }else if(operation=='verify'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
            }else if(operation=='sendtofinance'){
                jQuery("#r_heading").html('Send To Finance');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtofinance');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#finance_row").hide();
                jQuery("#attachment_row").show();
                jQuery("#verify_row").hide();
            }else if(operation=='verifyfinance'){
                jQuery("#r_heading").html('Verify');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#type").val('verifyfinance');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").show();
                jQuery("#verifyid").val(dataRecord['id']);
                jQuery("#verify_row").hide();
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#r_heading").html('Preview');
                jQuery("#attachment_row").hide();
                jQuery("#finance_row").hide();
                jQuery("#verify_row").hide();
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>bill_ho/lawyer_bill_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_for_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_for_finance_select" name="hidden_file_for_finance_select" value="0">';
                            html+='<span id="hidden_file_for_finance">';
                            jQuery('#file_for_finance').html(html);

                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'file_from_finance\')"/>';
                            html+='<input type="hidden" id="hidden_file_from_finance_select" name="hidden_file_from_finance_select" value="0">';
                            html+='<span id="hidden_file_from_finance">';
                            jQuery('#file_from_finance').html(html);

                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
        function load_expense()
        {
            var theme = getDemoTheme();
            var  rules= [];
            rules.push(
                    { input: '#bill_month', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#bill_month input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            return true;                
                        }
                        else
                        {
                            jQuery("#lawyer input").focus();
                            return false;
                        }
                    }  
                    }
            );
            jQuery('#lawyer_bill_form').jqxValidator({
                  rules: rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    call_service();
                }
            }
            jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);
        }
        function calculate_discount_amount(counter=null)
        {
            if (counter!=null) 
            {
                var org_amount = jQuery("#event_amount_"+counter).val();
                var discount_amount = jQuery("#discount_"+counter).val();
                if (parseFloat(discount_amount)<0) 
                {
                    alert("invalid Discount Amount!");
                    jQuery("#discount_"+counter).focus();
                    return false;
                }
                else if(parseFloat(discount_amount)>=parseFloat(org_amount))
                {
                    alert("Discount Amount Bigger then Main Amount!");
                    jQuery("#discount_"+counter).focus();
                    return false;
                }
            }
            var total_row = jQuery('#billcount').val();
            var check=0;
            var total_discount = 0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true && jQuery("#discount_"+i).val()!='')
                {
                    total_discount = parseFloat(total_discount)+parseFloat(jQuery("#discount_"+i).val());
                }
            }
            jQuery('#discount_amount').val(total_discount);

        }
        function call_service()
        {
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#bill_info_body").html('');
            jQuery("#proxy_info_body").html('');
            jQuery("#bill_info_body_legal").html('');
            var bill_month = jQuery("#bill_month").val();
            var year = jQuery("#year").val();
            var vendor = jQuery("#lawyer").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/bill_ho/get_expense_data_lawyer_hc',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,vendor:vendor,bill_month:bill_month,year:year},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.proxy_str!='')
                        {
                            jQuery("#proxy_info_body").append(json.proxy_str);
                            jQuery("#proxy_row").show();
                        }
                        else
                        {
                            jQuery("#proxy_info_body").html('');
                            jQuery("#proxy_row").hide();
                        }
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_body_legal").append(json.legal_bill_str);
                        jQuery("#bill_info_row").show();
                        jQuery("#bill_info_row_legal").show();
                        jQuery("#load_button").hide();
                        jQuery("#re_generate").show();
                        jQuery("#legal_region").jqxComboBox({ disabled: true });
                        jQuery("#legal_district").jqxComboBox({ disabled: true });
                        jQuery("#lawyer").jqxComboBox({ disabled: true });
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
                        jQuery("#year").jqxDropDownList({ disabled: true });
              },
                error:   function(model, xhr, options){
                    alert('failed');
                },
            });
        }
        function CheckAll_2(checkAllBox,type)                            
        {                           
            var ChkState=checkAllBox.checked;
            var number=jQuery("#billcount").val();
            var legal_count=jQuery("#legal_bill_count").val();
            if(type=='legal')
            {
                var start=1;
                var end = legal_count;
            }
            else
            {
                var start=parseInt(legal_count)+1;
                var end = number;
            }
            var counter=0;
            var amount = 0;
            var event_amount = 0;
            if (ChkState==true) 
            {
                for(var i=start; i<=end; i++){  
                    var x = document.getElementById("chkBoxSelect"+i).disabled;
                    if(x)   
                    {
                        continue;
                    }             
                    jQuery("#event_delete_"+i).val(0);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;
                    counter++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }
            }   
            else{
                for(var i=start; i<=end; i++){               
                    jQuery("#event_delete_"+i).val(1);
                    document.getElementById("chkBoxSelect"+i).checked=ChkState;                         
                }
                counter=0;
                event_amount=0;
            }           
            if(type=='legal')
            {
                jQuery('#hidden_bill_amount_legal').val(event_amount.toFixed(2));
                jQuery('#selected_amount_legal').html(event_amount.toFixed(2));  
            }
            else
            {
                jQuery('#hidden_bill_amount_pending').val(event_amount.toFixed(2));
                jQuery('#selected_amount').html(event_amount.toFixed(2));  
            }
             
            var selected_amount_legal = parseFloat(jQuery('#hidden_bill_amount_legal').val());
            var selected_amount_pending = parseFloat(jQuery('#hidden_bill_amount_pending').val());    
            var total_amount = parseFloat(selected_amount_legal)+parseFloat(selected_amount_pending);
            jQuery('#hidden_bill_amount').val(total_amount.toFixed(2));     
            calculate_discount_amount();          
        }   
        function CheckChanged_2(checkAllBox,counter,type)
        {
            var ChkState=checkAllBox.checked;
            if (ChkState==true) 
            {
                jQuery("#event_delete_"+counter).val(0);
            }
            else
            {
                jQuery("#event_delete_"+counter).val(1);
            }
            var number=jQuery("#billcount").val();
            var legal_count=jQuery("#legal_bill_count").val();
            if(type=='legal')
            {
                var start=1;
                var end = legal_count;
                number = end;
            }
            else
            {
                var start=parseInt(legal_count)+1;
                var end = number;
            }
            var checkco=parseInt(start)-1;
            var amount = 0;
            var event_amount = 0;
            for(var i=start; i<=end; i++){                                                       
                if(document.getElementById("chkBoxSelect"+i).checked==true){
                    checkco++;  
                    amount = parseFloat(jQuery("#event_amount_"+i).val(), 10);
                    if (isNaN(amount)) {
                  amount = 0;
                }
                    event_amount += amount;
                }                                           
            }
            if (number==checkco){
                if(type=='legal')
                {
                    document.getElementById("checkAll_legal").checked=true;
                }
                else
                {
                    document.getElementById("checkAll_pending").checked=true;
                }
            
            }else{
                if(type=='legal')
                {
                    document.getElementById("checkAll_legal").checked=false;
                }
                else
                {
                    document.getElementById("checkAll_pending").checked=false;
                }
            }   
            if(type=='legal')
            {
                jQuery('#hidden_bill_amount_legal').val(event_amount.toFixed(2));
                jQuery('#selected_amount_legal').html(event_amount.toFixed(2));  
            }
            else
            {
                jQuery('#hidden_bill_amount_pending').val(event_amount.toFixed(2));
                jQuery('#selected_amount').html(event_amount.toFixed(2));  
            }
             
            var selected_amount_legal = parseFloat(jQuery('#hidden_bill_amount_legal').val());
            var selected_amount_pending = parseFloat(jQuery('#hidden_bill_amount_pending').val());    
            var total_amount = parseFloat(selected_amount_legal)+parseFloat(selected_amount_pending);
            jQuery('#hidden_bill_amount').val(total_amount.toFixed(2)); 
            calculate_discount_amount();            
        }
        function bill_validation()
        {
            var total_amount = jQuery('#hidden_bill_amount').val();
            if(total_amount>85000)
            {
                alert('Sorry Total Selected bill amount crossed over 85000');
                return false;
            }
            var counter=0;
            var total_row = jQuery('#billcount').val();
            var check=0;
            for(var i=1; i<=total_row; i++)
            {
                if(document.getElementById("chkBoxSelect"+i).checked==true)
                {
                    var org_amount = jQuery("#event_amount_"+i).val();
                    var discount_amount = jQuery("#discount_"+i).val();
                    if (parseFloat(discount_amount)<0) 
                    {
                        alert("invalid Discount Amount!");
                        jQuery("#discount_"+i).focus();
                        return false;
                    }
                    else if(parseFloat(discount_amount)>=parseFloat(org_amount))
                    {
                        alert("Discount Amount Bigger then Main Amount!");
                        jQuery("#discount_"+i).focus();
                        return false;
                    }
                    if(jQuery("#discount_"+i).val()!='' && jQuery("#discount_remarks_"+i).val()=='')
                    {
                        alert("Discount Remarks Required!");
                        jQuery("#discount_remarks_"+i).focus();
                        return false;
                    }
                    check++;
                }
            }
            //For Add action without select any bill
            if(jQuery("#add_edit").val()=='add')
            {
                if (check<1)
                {
                    if (confirm("There is no bill selected. Are you want to cancel request?"))
                    {
                        
                        clear_form();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return true;
                }
            }
            else{
                if (check<1)
                {
                    return show_confrimation_pop_up('lawyer_bill');
                }
                else
                {
                    return true;
                }
            }
            return true;
        }
        function search_data(){
            jQuery("#grid_search").hide();
            jQuery("#grid_loading").show();
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
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
                        <?php $this->load->view('bill_ho/pages/left_side_nav',$operation_name); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Entry Form</li>
                                    <li>Data Grid</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 10px;" class="back_image">
                                    <form class="form" name="lawyer_bill_form" id="lawyer_bill_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <input type="hidden" id="delete_reason_lawyer_bill" value="" name="delete_reason_lawyer_bill">
                                        <input type="hidden" name="hidden_bill_amount" id="hidden_bill_amount" value="0.00">
                                        <input type="hidden" name="hidden_bill_amount_pending" id="hidden_bill_amount_pending" value="0.00">
                                        <input type="hidden" name="hidden_bill_amount_legal" id="hidden_bill_amount_legal" value="0.00">
                                        <input type="hidden" name="hc_lawyer_bill" id="hc_lawyer_bill" value="1">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Serial No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="sl_no" type="text" tabindex="1" readonly class="" style="width:250px" id="sl_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr id="month_row">
                                                                <td width="40%" style="font-weight: bold;"><strong>Month Of Bill<span style="color:red">*</span> </td>
                                                                <td width="60%">
                                                                    <div id="bill_month" name="bill_month" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <div id="year" name="year" style="padding-left: 3px;float:left" tabindex="2"></div>
                                                                    <input type="button" value="Load" id="load_button" style="margin-left: 5px;width:50px !important;height:25px;float:left" onclick="load_expense()" />
                                                                    <input name="re_generate" id="re_generate" class="crmbutton small create" onclick="clear_form()" value="Reload" type="button" style="display: none;margin-left: 5px;height:25px;float:left">
                                                                </td>
                                                            </tr>
                                                            <tr id="lawyer_region_row">
                                                                <td width="40%" style="font-weight: bold;">Legal Region</td>
                                                                <td width="60%" id=""><div id="legal_region" tabindex="3" name="legal_region" style="padding-left: 3px" ></div></td>
                                                                
                                                            </tr>
                                                            <tr id="lawyer_district_row">
                                                                <td width="40%" style="font-weight: bold;">Legal District</td>
                                                                <td width="60%" id=""><div id="legal_district" tabindex="3" name="legal_district" style="padding-left: 3px" ></div></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Lawyer<span style="color:red">*</span> </td>
                                                                <td width="60%" id="drop_down_td"><div id="lawyer" tabindex="3" name="lawyer" style="padding-left: 3px" ></div></td>
                                                                <td width="60%" style="display:none" id="text_td"><span id="lawyer_name"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Despatch No.<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="dispatch_no" readonly type="text" tabindex="4" class="" style="width:250px" id="dispatch_no" value="Auto Generate" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Bill Amount</td>
                                                                <td width="60%" ><input name="bill_amount" type="text" tabindex="5" class="" readonly style="width:250px" id="bill_amount" value="" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Discount Amount</td>
                                                                <td width="60%" ><input name="discount_amount" readonly type="text" tabindex="6" class="" style="width:250px" id="discount_amount" value="<?=isset($result->discount_amount)?$result->discount_amount:''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Receiving Date From Field<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input type="text" name="received_dt" tabindex="7" placeholder="dd/mm/yyyy" style="width:250px;" id="received_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("received_dt");</script></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Memo Remarks</td>
                                                                <td width="60%" ><textarea name="memo_remarks" tabindex="9" class="text-input-big" id="memo_remarks" style="height:40px !important;width:250px"><?=isset($result->memo_remarks)?$result->memo_remarks:''?></textarea></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Approver List<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="approver_list" name="approver_list" style="padding-left: 3px" tabindex="10"></div></td>
                                                            </tr>   
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Tax Vat Text<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="tax_vat_text" name="tax_vat_text" style="padding-left: 3px" tabindex="11"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Payment Type<span style="color:red">*</span></td>
                                                                <td width="60%" ><div id="payment_type" name="payment_type" tabindex="11" style="padding-left: 3px;float:left"></div></td>
                                                            </tr>   
                                                            <tr id="ac_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">AC NO.<span style="color:red">*</span></td>
                                                                <td width="60%" ><input name="bank_ac_ac" type="text" tabindex="12" class="" style="width:250px" id="bank_ac_ac" value="" /></td>
                                                            </tr>
                                                            <tr id="rtgs_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">Rtgs Info<span style="color:red">*</span> </td>
                                                                <td width="60%" >
                                                                    <div id="bank" name="bank" style="padding-left: 3px" tabindex="12"></div>
                                                                    <div style="background-color:#eaeaea;padding:10px;width:233px" id="spfm">
                                                                    AC NO.<span style="color:red">*</span><br/><input name="ac_no_rtgs" onblur="" tabindex="13" type="text" class="" style="width:225px" id="ac_no_rtgs" value="" /><br/>
                                                                    Routing No.<br/><input name="routing_no" onblur="" tabindex="14" type="text" class="" style="width:225px" id="routing_no" value="" />
                                                                </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">TIN</td>
                                                                <td width="60%" ><span id="tin_show">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">BIN</td>
                                                                <td width="60%" ><span id="bin_show">-----</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="proxy_row">
                                                    <td colspan="2">
                                                        <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                            <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Proxy Info</span>
                                                            <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                <thead>
                                                                    <tr>
                                                                        <td width="5%" style="font-weight: bold;text-align:center;word-wrap: break-word;">SL</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap: break-word;">Vendor Name</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap: break-word;">Account No.</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap: break-word;">Account Name</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap: break-word;">Case No.</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap: break-word;">Date of legal steps</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap: break-word;">Purpose/Activities</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap: break-word;">Amount</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="proxy_info_body">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row_legal">
                                                    <td colspan="2">
                                                        <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                            <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:20px;">Bill Submit From Legal Team</span>
                                                            <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                <thead>
                                                                    <tr>
                                                                        <td width="7%" style="font-weight: bold;text-align:center;word-wrap:break-word;"><input type="checkbox" name="checkAll_legal" id="checkAll_legal" onClick="CheckAll_2(this,'legal')" /></td>
                                                                        <td width="3%" style="font-weight: bold;text-align:center;word-wrap:break-word;">SL</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Vendor Name</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Account No.</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Account Name</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Case No.</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Date of legal steps</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Purpose/Activities</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Amount</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Discount Amount</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Remarks</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="bill_info_body_legal">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row">
                                                <td colspan="2">
                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bill Info</span>
                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                            <thead>
                                                                <tr>
                                                                    <td width="5%" style="font-weight: bold;text-align:center;word-wrap:break-word;"><input type="checkbox" name="checkAll_pending" id="checkAll_pending" onClick="CheckAll_2(this,'pending')" /></td>
                                                                    <td width="3%" style="font-weight: bold;text-align:center;word-wrap:break-word;">SL</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Vendor Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Account No.</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Account Name</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Case No.</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Date of legal steps</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Purpose/Activities</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Amount</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Discount Amount</td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center;word-wrap:break-word;">Remarks</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bill_info_body">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                        <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                                <? if(EDIT==1){?>
                                                <tr id="up_button" style="display: none;">
                                                    <td colspan="2" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                        <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                    </div>
                                </div>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:70px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                        <form method="POST" name="form" id="grid_search_form"  style="margin:0px;" action="<?=base_url()?>index.php/bill_ho/mk_xl_all_report_both_all_and_account_wise">
                                            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="hidden" name="report_type" id="report_type" value="lawyer_bill_hc">
                                            <table id="deal_body" style="display:block;width:100%">
                                                <tr>
                                                    <td style="text-align:right;width:7%"><strong>Region&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="legal_region_grid" name="legal_region_grid"></div></td>
                                                    <td style="text-align:right;width:9%"><strong>District&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="legal_district_grid" name="legal_district_grid"></div></td>
                                                    <td style="text-align:right;width:8%"><strong>Lawyer </strong></td>
                                                    <td style="width:15%"><div style="padding-left:1.8%" id="lawyer_grid" name="lawyer_grid"></div></td>
                                                    <td style="text-align:right;width:7%"><strong>Status</strong> </td>
                                                    <td style="width:20%"><div style="padding-left:1.8%" id="status_grid" name="status_grid"></div></td>
                                                    <td style="text-align:right;width:7%"><strong>From</strong> </td>
                                                    <td style="width:10%"><input type="text" name="from_date" placeholder="dd/mm/yyyy" style="width:100px;" id="from_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("from_date");</script></td>
                                                    <td style="text-align:right;width:7%"><strong>To</strong> </td>
                                                    <td style="width:10%"><input type="text" name="to_date" placeholder="dd/mm/yyyy" style="width:100px;" id="to_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("to_date");</script></td>
                                                    <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                        <span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                    </td>
                                                    <td style="width:5%;text-align: right;display: none;" id="xl_btn" valign="top">
                                                        <button type="submit" formtarget="_blank" name="all_bill" title="Bill Wise" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                        <button type="submit" formtarget="_blank" name="ac_wise" title="Account Wise"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                  </div>
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/bill_ho/bulk_operation/apv/lawyer_bill_hc" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>STF = </strong> Send To Finance,&nbsp;
                                    <strong>VF = </strong> Verify From Finance&nbsp;
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

    <div id="details" style="display: none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="<?=base_url()?>bill_ho/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row">
                                <td>Attachment (If Any):</td>
                                <td>
                                    <span id="file_for_finance"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                                    <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                                    <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="verify_return_row" style="display:none">
                                <td>Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonSend" id="approve" value="Approve">
                                    <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                                    <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="finance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr id="attachment_row_finance" style="display:none">
                                <td align="left">Attachment (If Any):</td>
                                <td align="left">
                                    <span id="file_from_finance"></span>
                                </td>
                            </tr>
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="reject" value="Return"/>
                                    <input type="button" class="buttonSend" id="finance_approve" value="Approve">
                                    <input type="button" class="buttonclose" id="financecancel" onclick="close()" value="Cancel">
                                    <span id="finance_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>

<script type="text/javascript">
    function r_history (id,life_cycle=null,bill_type) {
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
            url: "<?=base_url()?>bill_ho/r_history",
            data : {[csrfName]: csrfHash,id: id,life_cycle:life_cycle,bill_type:bill_type},
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
                                    html+='<td align="center">'+obj.oprs_reason+'</td>';
                                }else{html+='<td align="center"></td>';}
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

<div id="r_history" style="display: none;">
<div><strong>Life Cycle</strong></div>
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
        <div class="wrapper" style="text-align:center">
            </br></br><input type="button" align="center" class="button1" id="history_ok" value="Close" />
        </div>
        
    </div>
</div>

<div id="sendToCheckerMessageDialogContent"  style="display:none;">
 <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin-top:0px;">
    <input type="hidden" name="field_name" id="field_name" value="">
    <div class="hd"><h2 class="conf" style="margin-top:0px">No Bill Selected.Want to delete Request?</h2></div>
       <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
        <textarea name="comments" id="comments" style="width:370px;"></textarea>
        </br></br>
       <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="delete_action()">Delete</a> 
        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
        <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
</form>
</div>

<div id="billHoDeleteMessageDialogContent"  style="display:none;">
 <form method="POST" name="billHoDeleteMessageform" id="billHoDeleteMessageform"  style="margin-top:0px;">
    <input type="hidden" name="cos_id" id="cos_id" value="">
    <input type="hidden" name="ho_operation_name" id="ho_operation_name" value="">
    <div class="hd"><h2 class="conf" style="margin-top:0px">Are you sure want to <span id="operation_msg"></span> this cost?</h2></div>
       <div id="delete_div">
           <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
            <textarea name="delete_reason" id="delete_reason" style="width:370px;"></textarea>
            </br></br>
       </div>
       <div id="edit_div">
           <strong style="vertical-align:top">Amount<span style="color: red;">*</span></strong>
            <input type="text" name="new_amount" id="new_amount" value="">
            <strong style="vertical-align:top">Date<span style="color: red;">*</span></strong>
            <input type="text" name="new_txrn_dt" placeholder="dd/mm/yyyy" id="new_txrn_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("new_txrn_dt");</script>
            </br></br>
       </div>
       <a class="btn-small btn-small-normal" id="billHoDeleteMessageDialogConfirm" onclick="bills_delete_ho()"><span id="operation_name"></span></a> 
        <a class="btn-small btn-small-secondary" id="billHoDeleteMessageDialogCancel" onclick="close_pop_up()"><span>Cancel</span></a> 
        <span id="loadingDelete" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
</form>
</div>
<script type="text/javascript">
    function download_memo(url)
        {
            window.open(
            url, "_blank");
        }
    var options = { 
            complete: function(response) 
            {
                var json = jQuery.parseJSON(response.responseText); 
                window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message!='OK')
                {    
                    jQuery("#acknowledgement").show();
                    jQuery("#acknowledgementcancel").show();
                    jQuery("#acknowledgement_loading").hide();                           
                    jQuery("#verify_return").show();
                    jQuery("#approve").show();
                    jQuery("#court_return_approve").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery("#reject").show();
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery("#finance_approve").show();
                    jQuery("#financecancel").show();
                    jQuery("#finance_approval_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                    return false;
                }else{
                    jQuery("#acknowledgement").show();
                    jQuery("#acknowledgementcancel").show();
                    jQuery("#acknowledgement_loading").hide();    
                    jQuery("#verify_return").show();
                    jQuery("#approve").show();
                    jQuery("#court_return_approve").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery("#reject").show();
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery("#finance_approve").show();
                    jQuery("#financecancel").show();
                    jQuery("#finance_approval_loading").hide();
                    var msz='';
                    jQuery("#error").show();
                    jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                    jQuery('#details').jqxWindow('close');
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                            
                }
                            
            }  
        }; 
        jQuery("#delete_convence").ajaxForm(options);
        jQuery("#sendtochecker").click( function() {
             jQuery("#sendtochecker").hide();
            jQuery("#SendTocheckercancel").hide();
            jQuery("#checker_loading").show();
            jQuery("#delete_convence").submit();
        });
        jQuery("#acknowledgement").click( function() {
             jQuery("#acknowledgement").hide();
            jQuery("#acknowledgementcancel").hide();
            jQuery("#acknowledgement_loading").show();
            jQuery("#delete_convence").submit();
        });
        jQuery("#finance_approve").click( function() {
            jQuery('#type').val('verifyfinance');
            jQuery("#reject").hide();
            jQuery("#finance_approve").hide();
            jQuery("#financecancel").hide();
            jQuery("#finance_approval_loading").show();
            jQuery("#delete_convence").submit();
        });
        jQuery("#court_return_sendtochecker").click( function() {
            var item = jQuery("#return_type").jqxComboBox('getSelectedItem');
            if(item!=null)
            {
                if(item.value==2)
                {
                    if(jQuery("#new_amount").val()=='')
                    {
                        alert('Please Provide New Amount');
                        jQuery("#new_amount").focus();
                        return false;
                    }
                    if(jQuery("#new_amount").val()!='')
                    {
                        if(!checknumber_alphabaticDot('new_amount'))
                        {
                            alert('Number is required!');
                            jQuery("#new_amount").focus();
                            return false;
                        }
                        
                    }
                    if(jQuery("#partial_remarks").val()=='')
                    {
                        alert('Remarks Required');
                        jQuery("#partial_remarks").focus();
                        return false;
                    }
                }
                
            }
            else
            {
                alert('Return Type is required!');
                jQuery("#return_type input").focus();
                return false;
            }
            jQuery("#court_return_sendtochecker").hide();
            jQuery("#SendTocheckercancel").hide();
            jQuery("#checker_loading").show();
            jQuery("#delete_convence").submit();
        });
        jQuery("#approve").click( function() {
            jQuery('#type').val('verify');
             jQuery("#verify_return_row").hide();
            jQuery("#verify_return").hide();
            jQuery("#approve").hide();
            jQuery("#verify_reject").hide();
            jQuery("#verify_cancel").hide();
            jQuery("#verify_loading").show();
            jQuery("#delete_convence").submit();
        });
        jQuery("#verify_reject").click(function () {
            jQuery("#verify_return_row").show();
            jQuery('#type').val('verify_reject');
            if(jQuery("#return_reason_verify").val()=='')
            {
               alert('Please Give Return Reason');
                jQuery("#return_reason_verify").focus();
                return false; 
            }
            else
            {
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                jQuery("#delete_convence").submit();
            }
         });
        jQuery("#verify_return").click(function () {
            jQuery("#verify_return_row").show();
            jQuery('#type').val('verify_return');
            if(jQuery("#return_reason_verify").val()=='')
            {
               alert('Please Give Return Reason');
                jQuery("#return_reason_verify").focus();
                return false; 
            }
            else
            {
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                jQuery("#delete_convence").submit();
            }
         });
        jQuery("#reject").click(function () {
                jQuery("#return_row").show();
                jQuery("#attachment_row_finance").show();
                jQuery('#type').val('return_finance_approval');
                if(jQuery("#return_reason").val()=='')
                {
                   alert('Please Give Return Reason');
                    jQuery("#return_reason").focus();
                    return false; 
                }
                else
                {
                    jQuery("#reject").hide();
                    jQuery("#finance_approve").hide();
                    jQuery("#financecancel").hide();
                    jQuery("#finance_approval_loading").show();
                    jQuery("#delete_convence").submit();
                }
             });
</script>