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
    #back_area{
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }
</style>
<?php 
$operation_name=$operation;
if ($operation=='lawyer_bill' && VIEWLAWYERBILL==0)
{
    if(VIEWCOURTFEE==1)
    {
        $operation='court_fee';
        $operation_name='court_fee';
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
    else if(VIEWCOURTENTER==1)
    {
        $operation='court_enter';
        $operation_name='court_enter';
    }
    else if(VIEWSTAFFCONV==1)
    {
        $operation='staff_con';
        $operation_name='staff_con';
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
    
}
else if($operation=='lawyer_bill' && VIEWLAWYERBILL==1)
{
    $operation='lawyer_bill';
    $operation_name='lawyer_bill';
}
$operation_name= array('operation_name'=>$operation_name);
?>
<script type="text/javascript">
    function show_confrimation_pop_up(operation)
    {
        jQuery("#message").html(operation);
        jQuery("#operation").val(operation);
        jQuery("#button_tag").html(operation);
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
    function show_confrimation_pop_up2(field_name)
    {
        jQuery("#field_name").val(field_name);
        $('sendToCheckerMessageDialogConfirm2').style.display = 'inline';
        $('sendToCheckerMessageDialogCancel2').style.display = 'inline';
        $('loadingReturn').style.display = 'none';
        sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent2'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
        sendToCheckerMessageDialog.show();
    }
    function close_window2()
    {
        sendToCheckerMessageDialog.hide();
        var field_name = jQuery("#field_name").val();
        jQuery("#delete_reason_"+field_name).val('');
        jQuery("#comments_2").val('');
        return false;
    }
    function delete_action2()
    {
        if(jQuery("#comments_2").val()=='')
        {
            alert("Please Give Delete Reason");
            return false;
        }
        else
        {
            sendToCheckerMessageDialog.hide();
            var field_name = jQuery("#field_name").val();
            var comments = jQuery("#comments_2").val();
            jQuery("#delete_reason_"+field_name).val(comments);
            jQuery('#bill_select').val(0);
            call_ajax_submit();
            return true;
        }
    }
    function change_dropdown(operation,edit=null,module_name=null)
    {
        var id='';
        //check for add action
        if (edit==null && operation!='legal_district_lawyer') 
        {
            id = jQuery("#"+operation).val();
        }
        else if(operation=='legal_district_lawyer')
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
                        jQuery("#legal_district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Legal District", source: legal_district, width: 250, height: 25});
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

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
            });

            return false;
    }
</script>
<!-- For Lawyer Bill -->
<?php if ($operation=='lawyer_bill' && VIEWLAWYERBILL==1): ?>

    <script type="text/javascript">
        var start=1990;
        let date =  new Date().getFullYear();
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var lawyer = [];
        var legal_district = [];
        var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var theme = getDemoTheme();
            rules2=[
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
            ];
            jQuery(document).ready(function () {
            jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 100, height: 25});
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');        
            });
            jQuery('#legal_district').bind('change', function (event) {
                change_dropdown('legal_district_lawyer');        
            });
            <?php if (check_group('1')): ?>
                change_dropdown('legal_region',<?=$this->session->userdata['ast_user']['legal_region']?>);
            <?php endif ?>
            jQuery('#lawyer,#legal_region,#legal_district').focusout(function() {
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
                        { name: 'status', type: 'string'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'region_name', type: 'string'},
                        { name: 'district_name', type: 'string'},
                        { name: 'total_selected', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/expenses/lawyer_grid',
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
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 95  || dataRecord.sts == 90)){
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
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 95 || dataRecord.sts == 90)){
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
                                if(dataRecord.sts == 37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.sts == 29) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
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
                        { text: 'Lawyer Name', datafield: 'lawyer_name',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'Region Name', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'District Name', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Total Selection', datafield: 'total_selected',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        
                        { text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
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
                if (bill_validation()==true) {
                    jQuery("#in_up_button").hide();
                    jQuery("#in_up_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
                }
            });

            // Send to checaker Ajax Call
            jQuery("#sendtochecker").click(function () {
                    jQuery("#sendtochecker").hide();
                    jQuery("#SendTocheckercancel").hide();
                    jQuery("#checker_loading").show();
                    delete_submit();
             });
            jQuery("#approve").click( function() {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
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
                    delete_submit();
                }
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
                url: "<?=base_url()?>expenses/add_edit_lawyer_bill/"+add_edit+"/"+edit_row,
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
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_lawyer_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        jQuery("#month_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        CheckChanged_2('','');
                        jQuery("#drop_down_td").hide();
                        jQuery("#lawyer_region_row").hide();
                        jQuery("#lawyer_district_row").hide();
                        jQuery("#text_td").show();
                        jQuery("#lawyer_name").html(json['result'].lawyer_name);
                        
                        
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
            jQuery("#legal_region").jqxComboBox('clearSelection');
            jQuery("input[name='legal_region']").val('');
            jQuery("#legal_district").jqxComboBox('clearSelection');
            jQuery("input[name='legal_district']").val('');
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#month_row").show();
            //jQuery("#district_row").show();
            jQuery("#lawyer_name").html('');
            jQuery("#bill_info_body").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery("#lawyer").jqxComboBox({ disabled: false });
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
                url: "<?=base_url()?>expenses/lawyer_bill_details",
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
            var bill_month = jQuery("#bill_month").val();
            var year = jQuery("#year").val();
            var vendor = jQuery("#lawyer").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_expense_data_lawyer',
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
                        jQuery("#lawyer").jqxComboBox({ disabled: true });
                        jQuery("#year").jqxDropDownList({ disabled: true });
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
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
                    return show_confrimation_pop_up2('lawyer_bill');
                }
                else
                {
                    return true;
                }
            }
            return true;
        }
        function delete_submit(){
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
            //console.log(postData);
            //return false
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/expenses/delete_action_lawyer_bill/',
                data : postData,
                datatype: "json",
                success: function(response){
                    //console.log(response);
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
                        }
                        var msz='';
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                                
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
                        <?php $this->load->view('expenses/pages/left_side_nav',$operation_name); ?>
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
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
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
                                                                <td width="60%" style="display:none;text-align: left;" id="text_td"><span id="lawyer_name"></span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            
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
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Vendor Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Amount</td>
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
                                    
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                            href="<?=base_url()?>index.php/Expenses/bulk_operation/lawyer_apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify&nbsp;
                                    
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
                        <table style="margin-left: 495px;margin-top: 0px;">
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
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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
        
        var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var lawyer = [];
        var legal_district = [];
        var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var theme = getDemoTheme();
            rules2=[
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
            ];
            jQuery(document).ready(function () {
            jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,promptText: "Bill Year",source: year, width: 100, height: 25});
            //jQuery("#year").jqxDropDownList('val', date);
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});
            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');        
            });
            jQuery('#legal_district').bind('change', function (event) {
                change_dropdown('legal_district_lawyer');        
            });
            <?php if (check_group('1')): ?>
                change_dropdown('legal_region',<?=$this->session->userdata['ast_user']['legal_region']?>);
            <?php endif ?>
            jQuery('#lawyer,#legal_region,#legal_district').focusout(function() {
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
                        { name: 'status', type: 'string'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'region_name', type: 'string'},
                        { name: 'district_name', type: 'string'},
                        { name: 'total_selected', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/expenses/court_fee_grid',
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
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 95 || dataRecord.sts == 90)){
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
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 95 || dataRecord.sts == 90)){
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
                                if(dataRecord.sts == 37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.sts == 29) {
                                        return '<div style=" margin-top: 7px;text-align:center">V</div>';
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
                        { text: 'Lawyer Name', datafield: 'lawyer_name',editable: false, width: '25%', align:'left',cellsalign:'left'},
                        { text: 'Region Name', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'District Name', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Total Selection', datafield: 'total_selected',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        
                        { text: 'Create By', datafield: 'e_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Create Date', datafield: 'e_dt',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '18%', align:'left',cellsalign:'left'}
                        
                    ],
                            
                });
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
                if (bill_validation()==true) {
                    jQuery("#in_up_button").hide();
                    jQuery("#in_up_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
                }
            });

            // Send to checaker Ajax Call
            jQuery("#sendtochecker").click(function () {
                    jQuery("#sendtochecker").hide();
                    jQuery("#SendTocheckercancel").hide();
                    jQuery("#checker_loading").show();
                    delete_submit();
             });
            jQuery("#approve").click( function() {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
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
                    delete_submit();
                }
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
                url: "<?=base_url()?>expenses/add_edit_court_fee/"+add_edit+"/"+edit_row,
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
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_court_fee_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        jQuery("#month_row").hide();
                        jQuery("#bill_info_row").show();
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#bill_info_body").append(json.str);
                        jQuery("#bill_info_row").show();
                        CheckChanged_2('','');
                        jQuery("#drop_down_td").hide();
                        jQuery("#text_td").show();
                        jQuery("#lawyer_name").html(json['result'].lawyer_name);
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
            jQuery("#legal_region").jqxComboBox('clearSelection');
            jQuery("input[name='legal_region']").val('');
            jQuery("#legal_district").jqxComboBox('clearSelection');
            jQuery("input[name='legal_district']").val('');
            //jQuery("#year").jqxDropDownList('val', date);
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#month_row").show();
            //jQuery("#district_row").show();
            jQuery("#lawyer_name").html('');
            jQuery("#bill_info_body").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery("#lawyer").jqxComboBox({ disabled: false });
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
                url: "<?=base_url()?>expenses/court_fee_details",
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
            var bill_month = jQuery("#bill_month").val();
            var year = jQuery("#year").val();
            var vendor = jQuery("#lawyer").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_expense_data_court_fee',
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
                        jQuery("#lawyer").jqxComboBox({ disabled: true });
                        jQuery("#year").jqxDropDownList({ disabled: true });
                        jQuery("#bill_month").jqxDropDownList({ disabled: true });
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
                    return show_confrimation_pop_up2('lawyer_bill');
                }
                else
                {
                    return true;
                }
            }
            return true;
        }
        function delete_submit(){
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
            //console.log(postData);
            //return false
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/expenses/delete_action_court_fee/',
                data : postData,
                datatype: "json",
                success: function(response){
                    //console.log(response);
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
                        }
                        var msz='';
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                                
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
                        <?php $this->load->view('expenses/pages/left_side_nav',$operation_name); ?>
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
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
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
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            
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
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Vendor Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Amount</td>
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
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                            href="<?=base_url()?>index.php/Expenses/bulk_operation/court_fee_apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify&nbsp;
                                    
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
                        <table style="margin-left: 495px;margin-top: 0px;">
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
                                    <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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
            var csrf_tokens='';
            var court_fee_amount = [];
            var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var lawyer = [];
            var legal_district = [];
            var return_type = [<? $i=1; foreach($return_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#court_fee_amount").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Lawyer", source: lawyer, width: 180, height: 25});
            jQuery("#return_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Return Type", source: return_type, width: 250, height: 25});
            jQuery('#return_type').jqxComboBox('val', 1);
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});
            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');        
            });
            jQuery('#legal_district').bind('change', function (event) {
                change_dropdown('legal_district_lawyer','','court_return');        
            });
            <?php if (check_group('1')): ?>
                change_dropdown('legal_region',<?=$this->session->userdata['ast_user']['legal_region']?>);
            <?php endif ?>
            jQuery('#court_fee_amount,#lawyer,#return_type,#legal_region,#legal_district').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'v_sts', type: 'int'},
                        { name: 'verifier_group_id', type: 'int'},
                        { name: 'loan_ac', type: 'string'},
                        { name: 'ac_name', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
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
                    url: '<?=base_url()?>index.php/expenses/court_return_grid',
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
                var win_h=jQuery( window ).height()-240;
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
                        <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                        <?php } ?>
                        <?php if(EDIT==1){ ?>
                        { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if( dataRecord.v_sts == 35 || dataRecord.v_sts == 39  || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }
                            else if(dataRecord.v_sts == 37){
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
                                if((check_group_javascript(dataRecord.verifier_group_id) || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.v_sts == 37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.v_sts == 38){
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
                        { text: 'Amount', datafield: 'return_amount',editable: false, width: '20%'},
                        { text: 'Entry By', datafield: 'e_by',editable: false, width: '15%'},
                        { text: 'Entry Date Time', datafield: 'e_dt',editable: false, width: '15%'}
                        
                    ],
                            
                });
                    
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 700, height:450, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verify_cancel") });
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
                jQuery('#court_return_form').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            rules= [
                { input: '#lawyer', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#lawyer").val()=='')
                        {
                            jQuery("#lawyer").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                },
                { input: '#court_fee_amount', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#court_fee_amount").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='court_fee_amount']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#court_fee_amount input").focus();
                                return false;
                            }
                    }
                },
                { input: '#return_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#return_type").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='return_type']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#return_type input").focus();
                                return false;
                            }
                    }
                },
                { input: '#new_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        var item = jQuery("#return_type").jqxComboBox('getSelectedItem');
                        if(item!=null)
                        {
                            if(jQuery("#new_amount").val()=='' && item.value==2)
                            {
                                jQuery("#new_amount").focus();
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
                { input: '#new_amount', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                        var item = jQuery("#return_type").jqxComboBox('getSelectedItem');
                        if(item!=null)
                        {
                            if(input.val() != '' && item.value==2)
                            {
                                if(!checknumber_alphabaticDot('new_amount'))
                                {
                                    jQuery("#new_amount").focus();
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
                    }
                },
                { input: '#new_amount', message: 'Bigger Amount!', action: 'keyup, blur', rule: function(input,commit){
                        var item = jQuery("#return_type").jqxComboBox('getSelectedItem');
                        var item2 = jQuery("#court_fee_amount").jqxComboBox('getSelectedItem');
                        if(item!=null && item2!=null)
                        {
                            if(input.val() != '' && item.value==2)
                            {
                                var org_amount = parseFloat(item2.label);
                                if(parseFloat(input.val())>org_amount)
                                {
                                    jQuery("#new_amount").focus();
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
                { input: '#remarks', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        var item = jQuery("#return_type").jqxComboBox('getSelectedItem');
                        if(item!=null)
                        {
                            if(jQuery("#remarks").val()=='' && item.value==2)
                            {
                                jQuery("#remarks").focus();
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
            ];
            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                if ((jQuery("#hidden_court_fee_return_application_select").val()=='0' && jQuery('#application_select_add_edit').val()=='add') || (jQuery("#hidden_court_fee_return_application_select").val()=='0' && jQuery("#file_delete_value_court_fee_return_application").val()=='1' && jQuery('#application_select_add_edit').val()=='edit')) 
                {
                    alert('Please Upload Application File');
                    return false;
                }
                jQuery('#court_return_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        show_confrimation_pop_up('Save');
                    }
                }
                jQuery('#court_return_form').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                if ((jQuery("#hidden_court_fee_return_application_select").val()=='0' && jQuery('#application_select_add_edit').val()=='add') || (jQuery("#hidden_court_fee_return_application_select").val()=='0' && jQuery("#file_delete_value_court_fee_return_application").val()=='1' && jQuery('#application_select_add_edit').val()=='edit')) 
                {
                    alert('Please Upload Application File');
                    return false;
                }
                jQuery('#court_return_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        show_confrimation_pop_up('Update');
                    }
                }
                jQuery('#court_return_form').jqxValidator('validate', validationResult);        
            });
            // Delete Form Validation 
            jQuery('#delete_convence').jqxValidator({
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
            // Delete Ajax call
            jQuery("#delete_button").click(function () {
                
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#delete_button").hide();
                        jQuery("#deletecancel").hide();
                        jQuery("#delete_loading").show();
                        delete_submit();
                    }
                }
                jQuery('#delete_convence').jqxValidator('validate', validationResult);
             });

            // Send to checaker Ajax Call
            jQuery("#sendtochecker").click(function () {
                    jQuery("#sendtochecker").hide();
                    jQuery("#SendTocheckercancel").hide();
                    jQuery("#checker_loading").show();
                    delete_submit();
             });

            jQuery("#approve").click( function() {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
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
                    delete_submit();
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
                    delete_submit();
                }
             });
        
            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'court_fee_return_application\')"/>';
            html+='<input type="hidden" id="hidden_court_fee_return_application_select" name="hidden_court_fee_return_application_select" value="0">';
            html+='<span id="hidden_court_fee_return_application"></span><input type="hidden" id="application_select_add_edit" name="application_select_add_edit" value="add">';
            jQuery('#court_fee_return_application').html(html);

            jQuery('#return_type').bind('change', function (event) {
                var item = jQuery("#return_type").jqxComboBox('getSelectedItem');
                jQuery("#new_amount").val('');
                if(item!=null && item.value==2)
                {
                    jQuery("#partial_row").show();
                }
                else
                {
                    jQuery("#partial_row").hide();
                }      
            });
        });
        function call_ajax_submit(){
            $('sendToCheckerMessageDialogConfirm').style.display = 'none';
            $('sendToCheckerMessageDialogCancel').style.display = 'none';
            $('loadingReturn').style.display = 'inline';
            var postdata = jQuery('#court_return_form').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_id").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/add_edit_court_fee_return/"+add_edit+"/"+edit_row,
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
                        // if(add_edit=='edit'){
                        //     jQuery("#in_up_loading").hide();
                        //     jQuery("#in_up_button").show();
                        //     jQuery('#jqxTabs').jqxTabs('select', 1);
                            
                        // }else{
                        //     jQuery("#in_req_button").show();
                        //     jQuery("#in_req_loading").hide();
                        // }
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
                    $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                    $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                    $('loadingReturn').style.display = 'none';
                    close_window();
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
        function delete_submit(){
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
            //console.log(postData);
            //return false
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/expenses/delete_action_court_return/',
                data : postData,
                datatype: "json",
                success: function(response){
                    //console.log(response);
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
                        }
                        var msz='';
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                                
                    }
                }
            });
        }
        function edit(id,editrow){
            
            var val=id;
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/get_edit_info_court_return",
                data : {[csrfName]: csrfHash,id:val},
                datatype: "json",
                async:false,
                success: function(response){
                   
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.Message=='ok'){
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'court_fee_return_application\')"/>';
                        html+='<input type="hidden" id="hidden_court_fee_return_application_select" name="hidden_court_fee_return_application_select" value="0">';
                        html+='<span id="hidden_court_fee_return_application"></span><input type="hidden" id="application_select_add_edit" name="application_select_add_edit" value="add">';
                        jQuery('#court_fee_return_application').html(html);

                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery('#add_edit').val('edit');
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        jQuery('#legal_region').jqxComboBox('val', json.lawyer_info.region);
                        jQuery('#legal_district').jqxComboBox('val', json.lawyer_info.district);
                        jQuery('#lawyer').jqxComboBox('val', json.row_info.lawyer);
                        jQuery('#legal_region').jqxComboBox({ disabled: true });
                        jQuery('#legal_district').jqxComboBox({ disabled: true });
                        jQuery('#return_type').jqxComboBox('val', json.row_info.return_type);
                        jQuery('#new_amount').val(json.row_info.new_amount);
                        jQuery('#lawyer').jqxComboBox({ disabled: true });
                        var court_fee_amount = [
                            {value:json.row_info.bill_id,label:json.row_info.return_amount},
                        ];
                        jQuery("#court_fee_amount").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
                        jQuery('#court_fee_amount').jqxComboBox('val', json.row_info.bill_id);
                        jQuery('#court_fee_amount').jqxComboBox({ disabled: true });
                        jQuery("#pre_bill_id").val(json.row_info.bill_id);
                        jQuery("#hidden_loan_ac").val(json.row_info.loan_ac);
                        jQuery("#show_loan").html(json.row_info.loan_ac);
                        jQuery("#lawyer_district").val(json.row_info.lawyer_district);
                        jQuery("#lawyer_district_show").html(json.row_info.district_name);
                        jQuery("#ac_name_show").html(json.row_info.ac_name);
                        jQuery("#hidden_ac_name").val(json.row_info.ac_name);


                        var court_fee_return_application = json.row_info.court_fee_return_application;
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'court_fee_return_application\')"/>';
                        html+='<input type="hidden" id="hidden_court_fee_return_application_select" name="hidden_court_fee_return_application_select" value="0">';
                        if(court_fee_return_application!='' && court_fee_return_application!=null)
                        {
                            html +='<span id="hidden_court_fee_return_application"><img id="file_preview_court_fee_return_application" onclick="popup(\'<?=base_url()?>cma_file/court_fee_return_application/'+court_fee_return_application+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                            html +='<input type="hidden" id="hidden_court_fee_return_application_value" name="hidden_court_fee_return_application_value" value="'+court_fee_return_application+'">';
                            html +='<img id="file_delete_court_fee_return_application" onclick="file_delete(\'court_fee_return_application\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                            html +='<input type="hidden" id="file_delete_value_court_fee_return_application" name="file_delete_value_court_fee_return_application" value="0">';
                            html+='<span id="hidden_court_fee_return_application"></span><input type="hidden" id="application_select_add_edit" name="application_select_add_edit" value="edit">';
                        }
                        else
                        {
                            html+='<span id="hidden_court_fee_return_application"></span><input type="hidden" id="application_select_add_edit" name="application_select_add_edit" value="add">';
                        }
                        jQuery('#court_fee_return_application').html(html);

                        jQuery("#ac_td").hide();
                        jQuery("#show_td").show();
                        jQuery("#generate").hide();
                        jQuery("#re_generate").show();
                        jQuery("#show_loan").html(json.row_info.loan_ac);
                        jQuery("#loan_ac").val(json.row_info.loan_ac);
                        jQuery("#remarks").val(json.row_info.remarks);
                        jQuery("#edit_id").val(json.row_info.id);

                    }else{
                        alert("No Data Found");
                        jQuery('#add_edit').val('');
                    }
                }
            });
            
        }
        function re_load()
        {
            var court_fee_amount = [];
            jQuery("#court_fee_amount").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
            jQuery("#legal_region").jqxComboBox('clearSelection');
            jQuery("input[name='legal_region']").val('');
            jQuery("#legal_district").jqxComboBox('clearSelection');
            jQuery("input[name='legal_district']").val('');
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#court_fee_amount").jqxComboBox('clearSelection');
            jQuery("input[name='court_fee_amount']").val('');
            jQuery("#loan_ac").val('');
            jQuery('#court_fee_amount').jqxComboBox({ disabled: false });
            jQuery('#legal_region').jqxComboBox({ disabled: false });
            jQuery('#legal_district').jqxComboBox({ disabled: false });
            jQuery('#lawyer').jqxComboBox({ disabled: false });
            var court_fee_amount = [];
            jQuery("#court_fee_amount").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
            jQuery("#hidden_loan_ac").val('');
            jQuery("#show_loan").html('');
            jQuery("#lawyer_district_show").html('-----');
            jQuery("#ac_name_show").html('-----');
            jQuery("#hidden_ac_name").val('');
            jQuery("#ac_td").show();
            jQuery("#show_td").hide();
            jQuery("#generate").show();
            jQuery("#re_generate").hide();
            jQuery("#lawyer_district").val('');
            if(jQuery("#add_edit").val()=='add')
            {
                clear_form();
            }
            
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
        function clear_form(){
            var court_fee_amount = [];
            jQuery("#partial_row").hide();
            jQuery("#new_amount").val('');
            jQuery('#return_type').jqxComboBox('val', 1);
            jQuery("#court_fee_amount").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#court_fee_amount").jqxComboBox('clearSelection');
            jQuery("input[name='court_fee_amount']").val('');
            jQuery("#pre_bill_id").val('');
            jQuery("#loan_ac").val('');
            jQuery("#remarks").val('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();

            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'court_fee_return_application\')"/>';
            html+='<input type="hidden" id="hidden_court_fee_return_application_select" name="hidden_court_fee_return_application_select" value="0">';
            html+='<span id="hidden_court_fee_return_application"></span><input type="hidden" id="application_select_add_edit" name="application_select_add_edit" value="add">';
            jQuery('#court_fee_return_application').html(html);
            
        }
        function details (id,editrow,operation) {
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='delete'){
                jQuery('#comments').val('');
                jQuery("#verifyid").val('');
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#delete_row").show();
                jQuery("#type").val('delete');
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val(dataRecord['id']);
            }else if(operation=='sendtochecker'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verify_row").hide();
                jQuery("#verifyid").val(dataRecord['id']);
            }else if(operation=='verify'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#verifyid").val(dataRecord['id']);
            }else{
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
            }

            //console.log(dataRecord);
            jQuery("#r_heading").html('Expenses');

            
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
                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function validate_call()
        {
            jQuery('#court_return_form').jqxValidator('hide');
            var theme = getDemoTheme();
            var  rules= [];
            rules.push(
            { input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {                    
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
            { input: '#loan_ac', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#loan_ac").val()=='')
                {
                    jQuery("#loan_ac").focus();
                    return false;
                }
                else
                {
                    return true;
                }
                
            }
            },
            { input: '#loan_ac', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
             {
                if(input.val() != '')
                {
                    if(!checknumber_alphabaticwithstar('loan_ac'))
                    {
                        jQuery("#loan_ac").focus();
                        return false;

                    }
                }
                return true;

            } },
            { input: '#loan_ac', message: 'must be 16 digits', action: 'keyup, blur, change', rule: function (input, commit)
             {
                if(input.val() != '')
                {
                    if(input.val().length<16 || input.val().length>16)
                    {
                        jQuery("#loan_ac").focus();
                        return false;

                    }
                }
                return true;

            } },
            );
            jQuery('#court_return_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        load_data();
                    }
                }
                jQuery('#court_return_form').jqxValidator('validate', validationResult);
        }
        function load_data()
        {
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = $('court_return_form').toQueryString();
            jQuery("#show_loan").html('');
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_court_fee_return_data',
            async:false,
            type: "post",
            data: postData,
            datatype: "json",
            beforeSend: function(){
                jQuery("#loading-overlay").show();
            },
            success: function(response){
                jQuery("#loading-overlay").hide();
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str='';
                        var theme = getDemoTheme();
                        if(json.Message=='ok')
                        {
                            jQuery('#lawyer').jqxComboBox({ disabled: true });
                            var court_fee_amount = [];
                            jQuery.each(json['row'],function(key,obj){
                                court_fee_amount.push({ value: obj.id, label: obj.amount });
                                //alert(obj.name);
                            });
                            jQuery("#court_fee_amount").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
                            jQuery("#hidden_loan_ac").val(json['row'][0].loan_ac);
                            jQuery("#show_loan").html(json['row'][0].loan_ac);
                            jQuery("#lawyer_district").val(json['row'][0].lawyer_district_id);
                            jQuery("#lawyer_district_show").html(json['row'][0].district_name);
                            jQuery("#ac_name_show").html(json['row'][0].ac_name);
                            jQuery("#hidden_ac_name").val(json['row'][0].ac_name);
                            jQuery("#ac_td").hide();
                            jQuery("#show_td").show();
                            jQuery("#generate").hide();
                            jQuery("#re_generate").show();
                            
                        }
                        else
                        {
                            alert(json.Message);
                            jQuery('#lawyer').jqxComboBox({ disabled: false });
                            var court_fee_amount = [];
                            jQuery("#lawyer_district").val('');
                            jQuery("#court_fee_amount").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
                            jQuery("#hidden_loan_ac").val('');
                            jQuery("#show_loan").html('');
                            jQuery("#lawyer_district_show").html('-----');
                            jQuery("#ac_name_show").html('-----');
                            jQuery("#hidden_ac_name").val('');
                            jQuery("#ac_td").show();
                            jQuery("#show_td").hide();
                            jQuery("#generate").show();
                            jQuery("#re_generate").hide();
                        }

                },
                error:   function(model, xhr, options){
                    alert('failed');
                },
                });
        }
    </script>
    <div id="container">
        <div id="body"  >
            <div id="loading-overlay">
                <div class="loading-icon"></div>
            </div> 
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('expenses/pages/left_side_nav',$operation_name); ?>
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
                                    <form class="form" name="court_return_form" id="court_return_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_id" value="" name="edit_id">
                                        <input type="hidden" id="pre_bill_id" value="" name="pre_bill_id">
                                        <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;"><strong>Court Fee Return A/C No.</strong><span style="color:red">*</span> </td>
                                                                <td width="60%" id="ac_td">
                                                                    <input name="loan_ac" tabindex="3" type="text" maxlength="16" size="16" class="" style="width:250px" id="loan_ac" value=""/>
                                                                </td>
                                                                <td width="60%" id="show_td" style="display:none">
                                                                    <span id="show_loan"></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Court Fee Return A/C Name</td>
                                                                <td width="60%" ><span id="ac_name_show">-----</span><input type="hidden" name="hidden_ac_name" id="hidden_ac_name"></td>
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
                                                                <td width="40%" style="font-weight: bold;">Lawyer Name<span style="color:red">*</span></td>
                                                                <td width="60%">
                                                                    <div id="lawyer" name="lawyer" style="padding-left: 3px;float:left" ></div>
                                                                    <input name="generate" style="float:left;margin-left: 5px" id="generate" class="crmbutton small create" onclick="validate_call()" value="Load" type="button">
                                                                    <input name="re_generate" id="re_generate" class="crmbutton small create" onclick="re_load()" value="Load Again" type="button" style="display: none;">
                                                                </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Lawyer Application Attachment<span style="color:red">*</span> </td>
                                                                <td width="60%" ><span id="court_fee_return_application"></span></td>
                                                            </tr>
                                                            
                                                            
                                                        </table>
                                                    </td>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Lawyer District</td>
                                                                <td width="60%"><span id="lawyer_district_show">-----</span><input type="hidden" name="lawyer_district" id="lawyer_district"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Return Type</td>
                                                                <td width="60%"><div id="return_type" name="return_type" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr id="partial_row" style="display:none">
                                                                <td width="40%" style="font-weight: bold;">New Amount<span style="color:red">*</span></td>
                                                                <td width="60%"><input name="new_amount" tabindex="3" type="text" class="" style="width:250px" id="new_amount" value=""/></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Court Fee Amount</td>
                                                                <td width="60%"><div id="court_fee_amount" name="court_fee_amount" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Return Remarks</td>
                                                                <td width="60%"><textarea type="text" name="remarks" id="remarks" rows="3" cols="30"></textarea></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button" >
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
                                    <strong>D = </strong> Delete,&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify&nbsp;
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

    <div id="details" style="display:none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
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
            <div id="checker_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <!-- <input type="button" value="Send" id="sendtochecker" class="btn-small btn-small-normal enabledElem buttondelete" /> -->
                <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
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
            <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                <textarea name="comments" id="comments" style="width:370px;"></textarea>
                
                <br><br>
                <input type="button" class="buttondelete" id="delete_button" value="Delete">
                <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
                <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                
            </div>
            </form>
        </div>
    </div>
<?php endif ?>
<!-- For Court Fee Adjustment -->
<?php if ($operation=='court_adjust' && VIEWCOURTFEEADJUST==1): ?>

    <script type="text/javascript">
        var start=1990;
        let date =  new Date().getFullYear();
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        var purchase_status = ["Yes", "No"];
        var new_court_fee = [];
        var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var lawyer = [];
        var legal_district = [];
        var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var theme = getDemoTheme();
            rules2=[
                { input: '#purchase_status', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#purchase_status input").focus();
                        return false;
                    }
                }  
                },
                { input: '#new_court_fee', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        return true;                
                    }
                    else
                    {
                        jQuery("#new_court_fee input").focus();
                        return false;
                    }
                }  
                },
            ];
            jQuery(document).ready(function () {
            jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 100, height: 25});
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
            jQuery("#purchase_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Status", source: purchase_status, width: 250, height: 25});
            jQuery("#new_court_fee").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court Fee", source: new_court_fee, width: 250, height: 25});
            jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 100, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});
            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');        
            });
            jQuery('#legal_district').bind('change', function (event) {
                change_dropdown('legal_district_lawyer');        
            });
            <?php if (check_group('1')): ?>
                change_dropdown('legal_region',<?=$this->session->userdata['ast_user']['legal_region']?>);
            <?php endif ?>
            jQuery('#lawyer,#legal_region,#legal_district,#new_court_fee').focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
             });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'e_by_id', type: 'int'},
                        { name: 'lawyer_name', type: 'string'},
                        { name: 'v_sts', type: 'int'},
                        { name: 'verifier_group_id', type: 'int'},
                        { name: 'loan_ac', type: 'string'},
                        { name: 'ac_name', type: 'string'},
                        { name: 'district_name', type: 'string'},
                        { name: 'sts', type: 'int'},
                        { name: 'status', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'}
                       
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
                    url: '<?=base_url()?>index.php/expenses/court_adjust_grid',
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
                        <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                        <?php } ?>
                        <?php if(EDIT==1){ ?>
                        { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if( dataRecord.v_sts == 35 || dataRecord.v_sts == 39  || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }
                            else if(dataRecord.v_sts == 37){
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
                                if((check_group_javascript(dataRecord.verifier_group_id)==true || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.v_sts == 37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.v_sts == 38){
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
                if ((jQuery("#hidden_lawyer_ack_copy_select").val()=='0' && jQuery('#lawyer_ack_copy_add_edit').val()=='add') || (jQuery("#hidden_lawyer_ack_copy_select").val()=='0' && jQuery("#file_delete_value_lawyer_ack_copy").val()=='1' && jQuery('#lawyer_ack_copy_add_edit').val()=='edit')) 
                {
                    alert('Please Upload Lawyer Application');
                    return false;
                }
                jQuery('#lawyer_bill_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
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
                if ((jQuery("#hidden_lawyer_ack_copy_select").val()=='0' && jQuery('#lawyer_ack_copy_add_edit').val()=='add') || (jQuery("#hidden_lawyer_ack_copy_select").val()=='0' && jQuery("#file_delete_value_lawyer_ack_copy").val()=='1' && jQuery('#lawyer_ack_copy_add_edit').val()=='edit')) 
                {
                    alert('Please Upload Lawyer Application');
                    return false;
                }
                jQuery('#lawyer_bill_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        call_ajax_submit();
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);        
            });

            // Delete Form Validation 
            jQuery('#delete_convence').jqxValidator({
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
            // Delete Ajax call
            jQuery("#delete_button").click(function () {
                
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#delete_button").hide();
                        jQuery("#deletecancel").hide();
                        jQuery("#delete_loading").show();
                        delete_submit();
                    }
                }
                jQuery('#delete_convence').jqxValidator('validate', validationResult);
             });

            // Send to checaker Ajax Call
            jQuery("#sendtochecker").click(function () {
                    jQuery("#sendtochecker").hide();
                    jQuery("#SendTocheckercancel").hide();
                    jQuery("#checker_loading").show();
                    delete_submit();
             });

            jQuery("#approve").click( function() {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
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
                    delete_submit();
                }
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
                url: "<?=base_url()?>expenses/add_edit_court_adjust/"+add_edit+"/"+edit_row,
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
                    reload();
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
        function edit(id,editrow){
            jQuery("#bill_info_body").html('');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_court_adjust_edit_data',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,id:id},
            datatype: "json",
            success: function(response){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#lawyer_name").html(json['result'].lawyer_name);
                        jQuery('.load_table').hide();
                        jQuery('#adjust_div').show();
                        jQuery("#hidden_lawyer_id").val(json['result'].lawyer_id);
                        jQuery("#hidden_new_court_id").val(json['result'].new_account_bill_id);
                        jQuery('#adjustment_account').val(json['result'].loan_ac);
                        jQuery('#adjust_ac_no').html(json['result'].adjusted_loan_ac);
                        jQuery('#adjustment_amount').html(json['result'].adjustment_amount);
                        jQuery('#court_fee_amount_from').val(json['result'].adjustment_amount);
                        jQuery('#adjustment_lawyer_district').html(json['result'].district_name);
                        jQuery('#adjustment_lawyer_name').html(json['result'].lawyer_name);
                        jQuery('#adjust_bill_id').val(json['result'].adjustment_bill_id);
                        jQuery('#adjustment_reason').val(json['result'].adjustment_reason);
                        call_service2('edit',json['result'].new_account_bill_id);
                        jQuery("#new_court_fee").jqxComboBox('val',json['result'].new_account_bill_id+'_'+json['result'].adjustment_amount_with);
                        jQuery("#purchase_status").jqxComboBox('val',json['result'].purchase_status);
                        calculate_court_fee_amount();
                        var lawyer_ack_copy = json.result.lawyer_ack_copy;
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'lawyer_ack_copy\')"/>';
                        html+='<input type="hidden" id="hidden_lawyer_ack_copy_select" name="hidden_lawyer_ack_copy_select" value="0">';
                        if(lawyer_ack_copy!='' && lawyer_ack_copy!=null)
                        {
                            html +='<span id="hidden_lawyer_ack_copy"><img id="file_preview_lawyer_ack_copy" onclick="popup(\'<?=base_url()?>cma_file/lawyer_ack_copy/'+lawyer_ack_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                            html +='<input type="hidden" id="hidden_lawyer_ack_copy_value" name="hidden_lawyer_ack_copy_value" value="'+lawyer_ack_copy+'">';
                            html +='<img id="file_delete_lawyer_ack_copy" onclick="file_delete(\'lawyer_ack_copy\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                            html +='<input type="hidden" id="file_delete_value_lawyer_ack_copy" name="file_delete_value_lawyer_ack_copy" value="0">';
                            html+='<span id="hidden_lawyer_ack_copy"></span><input type="hidden" id="lawyer_ack_copy_add_edit" name="lawyer_ack_copy_add_edit" value="edit">';
                        }
                        else
                        {
                            html+='<span id="hidden_lawyer_ack_copy"></span><input type="hidden" id="lawyer_ack_copy_add_edit" name="lawyer_ack_copy_add_edit" value="add">';
                        }
                        jQuery('#lawyer_ack_copy').html(html);
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
            jQuery("#legal_region").jqxComboBox('clearSelection');
            jQuery("input[name='legal_region']").val('');
            jQuery("#legal_district").jqxComboBox('clearSelection');
            jQuery("input[name='legal_district']").val('');
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#month_row").show();
            //jQuery("#district_row").show();
            jQuery("#lawyer_name").html('');
            jQuery("#bill_info_body").html('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#bill_info_row").hide();
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
        }


        function details (id,editrow,operation) {
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='delete'){
                jQuery('#comments').val('');
                jQuery("#verifyid").val('');
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#delete_row").show();
                jQuery("#type").val('delete');
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val(dataRecord['id']);
            }else if(operation=='sendtochecker'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verify_row").hide();
                jQuery("#verifyid").val(dataRecord['id']);
            }else if(operation=='verify'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#verifyid").val(dataRecord['id']);
            }else{
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
            }

            //console.log(dataRecord);
            jQuery("#r_heading").html('Expenses');

            
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
        function load_court_fee()
        {
            var theme = getDemoTheme();
            var  rules= [];
            rules.push(
                    { input: '#adjustment_account', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#adjustment_account").val()=='')
                        {
                            jQuery("#adjustment_account").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                    },
                    { input: '#adjustment_account', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(!checknumber_alphabaticwithstar('adjustment_account'))
                            {
                                jQuery("#adjustment_account").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
                    { input: '#adjustment_account', message: 'must be 16 digits', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(input.val().length<16 || input.val().length>16)
                            {
                                jQuery("#adjustment_account").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
            );
            jQuery('#lawyer_bill_form').jqxValidator({
                  rules: rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    call_service2(jQuery("#add_edit").val(),jQuery("#hidden_new_court_id").val());
                }
            }
            jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);
        }
        function call_service()
        {
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#bill_info_body").html('');
            var bill_month = jQuery("#bill_month").val();
            var year = jQuery("#year").val();
            var vendor = jQuery("#lawyer").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_expense_data_court_adjust',
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
              },
                error:   function(model, xhr, options){
                    alert('failed');
                },
            });
        }
        function delete_submit(){
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
            //console.log(postData);
            //return false
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/expenses/delete_action_court_adjust/',
                data : postData,
                datatype: "json",
                success: function(response){
                    //console.log(response);
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
                        }
                        var msz='';
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                                
                    }
                }
            });
        }
        function adjust(amount,district_name,vendor_name,loan_ac,id,vendor_id)
        {
            jQuery('.load_table').hide();
            jQuery('#adjust_div').show();
            jQuery('#adjust_ac_no').html(loan_ac);
            jQuery('#adjustment_amount').html(amount);
            jQuery('#court_fee_amount_from').val(amount);
            jQuery('#hidden_lawyer_id').val(vendor_id);
            jQuery('#adjustment_lawyer_district').html(district_name);
            jQuery('#adjustment_lawyer_name').html(vendor_name);
            jQuery('#adjust_bill_id').val(id);
            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'lawyer_ack_copy\')"/>';
            html+='<input type="hidden" id="hidden_lawyer_ack_copy_select" name="hidden_lawyer_ack_copy_select" value="0">';
            html+='<span id="hidden_lawyer_ack_copy"></span><input type="hidden" id="lawyer_ack_copy_add_edit" name="lawyer_ack_copy_add_edit" value="add">';
            jQuery('#lawyer_ack_copy').html(html);
        }
        function reload()
        {
            jQuery('#due_court_fee').html('');
            jQuery('#adjust_ac_no').html('');
            jQuery('#adjustment_amount').html('');
            jQuery('#adjustment_lawyer_district').html('');
            jQuery('#adjustment_lawyer_name').html('');
            jQuery('#adjust_bill_id').val('');
            jQuery('#court_fee_amount_from').val('0');
            var court_fee_amount = [];
            jQuery("#new_court_fee").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
            jQuery('.load_table').show();
            jQuery('#adjust_div').hide();
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#lawyer").jqxComboBox('clearSelection');
            jQuery("input[name='lawyer']").val('');
            jQuery("#purchase_status").jqxComboBox('clearSelection');
            jQuery("input[name='purchase_status']").val('');
            jQuery("#lawyer_name").html('');
            jQuery("#bill_info_body").html('');
            jQuery("#bill_info_row").hide();
            jQuery('#lawyer_bill_form').jqxValidator('hide');
            jQuery("#drop_down_td").show();
            jQuery("#load_button").show();
            jQuery("#re_generate").hide();
            jQuery('#hidden_lawyer_id').val('');
            clear_form();
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
        function call_service2(add_edit,edit_id=null)
        {
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var loan_ac = jQuery('#adjustment_account').val();
            var lawyer = jQuery('#hidden_lawyer_id').val();
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_pending_court_fee',
            async:false,
            type: "post",
            data : {[csrfName]: csrfHash,loan_ac: loan_ac,lawyer:lawyer,add_edit:add_edit,edit_id:edit_id},
            datatype: "json",
            beforeSend: function(){
                jQuery("#loading-overlay").show();
            },
            success: function(response){
                jQuery("#loading-overlay").hide();
                var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str='';
                        var theme = getDemoTheme();
                        if(json.Message=='ok')
                        {
                            var court_fee_amount = [];
                            jQuery.each(json['row'],function(key,obj){
                                court_fee_amount.push({ value: obj.id+'_'+obj.amount, label: obj.amount });
                                //alert(obj.name);
                            });
                            jQuery("#new_court_fee").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
                            
                        }
                        else
                        {
                            alert(json.Message);
                            var court_fee_amount = [];
                            jQuery("#new_court_fee").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court Fee", source: court_fee_amount, width: 250, height: 25});
                        }

                },
                error:   function(model, xhr, options){
                    jQuery("#loading-overlay").hide();
                    alert('failed');
                },
                });
        }
        function calculate_court_fee_amount()
        {
            var pre_court_fee = parseFloat(jQuery('#court_fee_amount_from').val());
            var item = jQuery("#new_court_fee").jqxComboBox('getSelectedItem');
            if(item!=null)
            {
                var new_court_fee = parseFloat(item.label);

                var remainig_belance = parseFloat(pre_court_fee-new_court_fee).toFixed(2);
                jQuery('#due_court_fee').html(remainig_belance);
            }
        }
    </script>
    <div id="container">
        <div id="body"  >
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('expenses/pages/left_side_nav',$operation_name); ?>
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
                                    <div id="loading-overlay">
                                        <div class="loading-icon"></div>
                                    </div>  
                                    <div style="padding: 10px;" class="back_image">
                                    <form class="form" name="lawyer_bill_form" id="lawyer_bill_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <input type="hidden" id="adjust_bill_id" value="" name="adjust_bill_id">
                                        <input type="hidden" id="hidden_lawyer_id" value="0" name="hidden_lawyer_id">
                                        <input type="hidden" id="hidden_new_court_id" value="0" name="hidden_new_court_id">
                                        <input type="hidden" id="court_fee_amount_from" value="0" name="court_fee_amount_from">
                                        <table style="width:100%;" class="load_table" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;"></td>
                                                                <td width="60%" style="text-align:left"><strong><span style="color:green;">Load Disbursed Court Fee</span></strong></td>
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
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display: contents;">
                                                        <table style="width: 100%;">
                                                            
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;" id="bill_info_row">
                                                <td colspan="2">
                                                    <div style="margin:0 0px;padding-top:20px;">
                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bill Info</span>
                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                            <thead>
                                                                <tr>
                                                                    <td width="5%" style="font-weight: bold;text-align:center">SL</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Vendor Name</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
                                                                    <td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Adjust</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
                                                                    <td width="10%" style="font-weight: bold;text-align:center">Amount</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="bill_info_body">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div id="adjust_div" style="display:none">
                                            <div id="back_area" style="text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                                    <input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;margin-top:10px" />
                                              </div>
                                              <div>
                                                    <table style="width:100%;margin-top:20px" id="tab1Table" >
                                                        <tbody>
                                                            <tr>
                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Court Fee Adjustment Reason</td>
                                                                            <td width="60%" style="font-weight: bold;"><textarea name="adjustment_reason" class="text-input-big" id="adjustment_reason" style="height:40px !important;width:250px"></textarea></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Adjustment Account No. </td>
                                                                            <td width="60%" style="font-weight: bold;"><span id="adjust_ac_no"></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Adjustment Court Fee Amount</td>
                                                                            <td width="60%" style="font-weight: bold;"><span id="adjustment_amount"></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Court Fee Purchase Status</td>
                                                                            <td width="60%" ><div id="purchase_status" name="purchase_status" style="padding-left: 3px"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Lawyer Application<span style="color:red">*</span></td>
                                                                            <td width="60%" >
                                                                                <span id="lawyer_ack_copy"></span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Lawyer Name</td>
                                                                            <td width="60%" >
                                                                                <span id="adjustment_lawyer_name"></span>
                                                                            </td>
                                                                        </tr>  
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Lawyer District</td>
                                                                            <td width="60%" >
                                                                                <span id="adjustment_lawyer_district"></span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr id="month_row">
                                                                            <td width="40%" style="font-weight: bold;"><strong>New Assign Account No.<span style="color:red">*</span> </td>
                                                                            <td width="60%">
                                                                                <input type="text" name="adjustment_account" maxlength="16" size="16" id="adjustment_account" value="" style="width:200px;float: left;">
                                                                                <input type="button" value="Load" id="load_button2" style="margin-left: 5px;width:50px !important;height:25px;float:left" onclick="load_court_fee()" />
                                                                            </td>
                                                                        </tr>   
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">New Assign Court Fee<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="new_court_fee" name="new_court_fee" onchange="calculate_court_fee_amount()" style="padding-left: 3px"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Due Court Fee</td>
                                                                            <td width="60%" >
                                                                                <span id="due_court_fee"></span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <? if(ADD==1){?>
                                                                <tr id="add_button">
                                                                    <td colspan="2" style="text-align: center;">
                                                                        <br/>
                                                                        <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                                        <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                                        <br/><br/><br/>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                                <? if(EDIT==1){?>
                                                                <tr id="up_button" style="display: none;">
                                                                    <td colspan="2" style="text-align: center;">
                                                                        <br/>
                                                                        <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                                        <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                                        <br/><br/><br/>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                        </tbody>
                                                    </table>
                                              </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="border:none;" id="jqxGrid2"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                    &nbsp;&nbsp;&nbsp;
                                    <strong>D = </strong> Delete,&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify&nbsp;
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

    <div id="details" style="display:none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
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
            <div id="checker_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <!-- <input type="button" value="Send" id="sendtochecker" class="btn-small btn-small-normal enabledElem buttondelete" /> -->
                <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
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
                                <!-- <input type="button" class="buttondelete" id="verify_reject" value="Reject"/> -->
                                <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                                <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                <textarea name="comments" id="comments" style="width:370px;"></textarea>
                
                <br><br>
                <input type="button" class="buttondelete" id="delete_button" value="Delete">
                <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
                <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                
            </div>
            </form>
        </div>
    </div>
<?php endif ?>
<!-- For staff conveyence --> 
<?php if ($operation=='staff_con' && VIEWSTAFFCONV==1): ?>
    <script type="text/javascript">
            var start=1990;
            let date =  new Date().getFullYear();
            var year = [];
            for (var i = date; i >=start; i--) {
                year.push({ value: i, label: i });
            }
            var theme = getDemoTheme();
            var csrf_tokens='';
            var staff_conv_type = [<? $i=1; foreach($staff_conv_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var expense_activities = [<? $i=1; foreach($expense_activities as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 250, height: 25});
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#staff_conv_type").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: staff_conv_type, width: 250, height: 25});
            //jQuery("#staff_conv_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Conveyence Type", source: staff_conv_type, width: 250, height: 25});
            jQuery("#staff_conv_type").jqxDropDownList('val', 1);
            jQuery("#month").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Billing Month", source: month, width: 250, height: 25});
            jQuery('#month').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
            // Add edit form validation
            jQuery('#stuff_convence').jqxValidator({
                rules: [
                    { input: '#month', message: 'required!', action: 'blur,change', rule: function (input) {                 
                        if(input.val() != '')
                        {
                            var item = jQuery("#month").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='month']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#month input").focus();
                            return false;
                        }
                    }  
                    },
                ]
            });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'staff_pin', type: 'string'},
                        { name: 'v_sts', type: 'int'},
                        { name: 'employee_name', type: 'string'},
                        { name: 'functional_desig', type: 'string'},
                        { name: 'verifier_group_id', type: 'int'},
                        { name: 'billing_month', type: 'string'},
                        { name: 'legal_region', type: 'string'},
                        { name: 'district', type: 'string'},
                        { name: 'status', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
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
                    url: '<?=base_url()?>index.php/expenses/staff_grid',
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

                var win_h=jQuery( window ).height()-240;
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
                        <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                        <?php } ?>
                        <?php if(EDIT==1){ ?>
                        { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if( dataRecord.v_sts == 35 || dataRecord.v_sts == 39 || dataRecord.v_sts == 90 ){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }
                            else if(dataRecord.v_sts == 37){
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
                                if((check_group_javascript(dataRecord.verifier_group_id)==true || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.v_sts == 37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.v_sts == 38){
                                        return '<div style=" margin-top: 8px;text-align:center">V</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                          <? }?>
                          { text: 'RF', menu: false, datafield: 'reimbursemnt', align:'center', editable: false, sortable: false, width: '3%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.v_sts == 38){
                                    //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/expenses/download_staff_memo/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/expenses/download_staff_reimbursment/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                }
                            }
                        },
                        { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        { text: 'Status', datafield: 'status',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Staff Pin', datafield: 'staff_pin',editable: false, width: '10%'},
                        { text: 'Employee Name', datafield: 'employee_name',editable: false, width: '10%'},
                        { text: 'Functional Designation', datafield: 'functional_desig',editable: false, width: '15%'},
                        { text: 'Billing Month', datafield: 'billing_month',editable: false, width: '10%'},
                        { text: 'Legal Region', datafield: 'legal_region',editable: false, width: '10%'},
                        { text: 'District', datafield: 'district',editable: false, width: '10%'},
                        { text: 'Entry By', datafield: 'e_by',editable: false, width: '15%'},
                        { text: 'Entry Date Time', datafield: 'e_dt',editable: false, width: '15%'},
                        
                    ],
                            
                });
                    
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:450, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verify_cancel") });
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
                
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true) {
                        show_confrimation_pop_up('Save');
                    }
                }
                jQuery('#stuff_convence').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                
                var validationResult = function (isValid) {
                    if (isValid) {
                        show_confrimation_pop_up('Update');
                    }
                }
                jQuery('#stuff_convence').jqxValidator('validate', validationResult);        
            });
            // Delete Form Validation 
            jQuery('#delete_convence').jqxValidator({
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
            // Delete Ajax call
            jQuery("#delete_button").click(function () {
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#delete_button").hide();
                        jQuery("#deletecancel").hide();
                        jQuery("#delete_loading").show();
                        delete_submit();
                    }
                }
                jQuery('#delete_convence').jqxValidator('validate', validationResult);
             });

            // Send to checaker Ajax Call
            jQuery("#sendtochecker").click(function () {
                    jQuery("#sendtochecker").hide();
                    jQuery("#SendTocheckercancel").hide();
                    jQuery("#checker_loading").show();
                    delete_submit();
             });
            jQuery("#approve").click( function() {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
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
                    delete_submit();
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
                    delete_submit();
                }
             });


        });
        function call_ajax_submit(){
            $('sendToCheckerMessageDialogConfirm').style.display = 'none';
            $('sendToCheckerMessageDialogCancel').style.display = 'none';
            $('loadingReturn').style.display = 'inline';
            var postdata = jQuery('#stuff_convence').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/add_edit_staff_conv/"+add_edit+"/"+edit_row,
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
                    
                    $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                    $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                    $('loadingReturn').style.display = 'none';
                    close_window();
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
        function delete_submit(){
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
            //console.log(postData);
            //return false
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/expenses/delete_action_staff_conv/',
                data : postData,
                datatype: "json",
                success: function(response){
                    //console.log(response);
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
                        }
                        var msz='';
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                                
                    }
                }
            });
        }
        function edit(id,editrow){
            
            var val=id;
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/get_edit_info_staff_conv",
                data : {[csrfName]: csrfHash,id:val},
                datatype: "json",
                async:false,
                success: function(response){
                   
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.Message=='ok'){
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery('#add_edit').val('edit');
                        jQuery("#edit_row").val(id);
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        jQuery('#month').jqxComboBox('val', json.row_info.month);
                        jQuery("#year").jqxDropDownList('val', json.row_info.year);
                        jQuery("#staff_conv_type").jqxDropDownList('val', json.row_info.conv_type);
                        jQuery('#expense_counter').val('0');
                        jQuery('#expense_body').html('');
                        jQuery("#edit_id").val(json.row_info.id);
                        jQuery('#staff_conv_type').jqxDropDownList({ disabled: true });
                        var i=0;
                        //console.log(json['expense'])
                        jQuery.each(json['expense'],function(key,obj){
                            i++;
                            var counter = jQuery('#expense_counter').val();
                            var new_counter = parseInt(counter) + 1;
                            html_string = '';
                            var type = jQuery("#staff_conv_type").val();
                            if(type==1)
                            {
                                html_string += '<tr id="expense_'+new_counter+'">';
                                html_string += '<td>';
                                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="'+obj.id+'">';
                                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                                if(i>1)
                                {
                                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                                }
                                html_string += '<td>';
                                html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" >';
                                html_string += '</td>';
                                html_string += '<td><input name="movement_details_'+new_counter+'" type="text" class="" style="width:98%" id="movement_details_'+new_counter+'" value="'+obj.movement_details+'"/></td>';
                                html_string += '<td>';
                                html_string += '<input name="transportaion_mode_'+new_counter+'" type="text" class="" style="width:98%" id="transportaion_mode_'+new_counter+'" value="'+obj.move_of_transfortaion+'"/>';
                                html_string += '</td>';
                                html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" value="'+obj.amount+'"/></td>';
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
                                datePicker('activities_date_'+new_counter);
                            }
                            else if(type==2)
                            {
                                html_string += '<tr id="expense_'+new_counter+'">';
                                html_string += '<td>';
                                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="'+obj.id+'">';
                                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                                if(i>1)
                                {
                                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                                }
                                html_string += '<td>';
                                html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" >';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="particulars_'+new_counter+'" type="text" class="" style="width:98%" id="particulars_'+new_counter+'" value="'+obj.particulars+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="place_'+new_counter+'" type="text" class="" style="width:98%" id="place_'+new_counter+'" value="'+obj.place+'"/>';
                                html_string += '</td>';
                                html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" value="'+obj.amount+'"/></td>';
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
                                datePicker('activities_date_'+new_counter);
                            }
                            else if(type==3)
                            {
                                html_string += '<tr id="expense_'+new_counter+'">';
                                html_string += '<td>';
                                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="'+obj.id+'">';
                                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                                if(i>1)
                                {
                                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                                }
                                html_string += '<td>';
                                html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" >';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="description_'+new_counter+'" type="text" class="" style="width:98%" id="description_'+new_counter+'" value="'+obj.description_of_journey+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="journey_time_'+new_counter+'" type="text" class="" style="width:98%" id="journey_time_'+new_counter+'" value="'+obj.journey_time+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="journey_metar_'+new_counter+'" type="text" class="" style="width:98%" id="journey_metar_'+new_counter+'" value="'+obj.journey_metar+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="reached_metar_'+new_counter+'" type="text" class="" style="width:98%" id="reached_metar_'+new_counter+'" value="'+obj.reached_metar+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="reached_time_'+new_counter+'" type="text" class="" style="width:98%" id="reached_time_'+new_counter+'" value="'+obj.reached_time+'"/>';
                                html_string += '</td>';
                                html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" value="'+obj.amount+'"/></td>';
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
                                datePicker('activities_date_'+new_counter);
                            }
                            else if(type==4)
                            {
                                html_string += '<tr id="expense_'+new_counter+'">';
                                html_string += '<td>';
                                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="'+obj.id+'">';
                                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                                if(i>1)
                                {
                                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                                }
                                html_string += '<td>';
                                html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" >';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="purpose_'+new_counter+'" type="text" class="" style="width:98%" id="purpose_'+new_counter+'" value="'+obj.purpose+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="from_'+new_counter+'" type="text" class="" style="width:98%" id="from_'+new_counter+'" value="'+obj.from+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="time_out_'+new_counter+'" type="text" class="" style="width:98%" id="time_out_'+new_counter+'" value="'+obj.time_out+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="to_'+new_counter+'" type="text" class="" style="width:98%" id="to_'+new_counter+'" value="'+obj.to+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="time_in_'+new_counter+'" type="text" class="" style="width:98%" id="time_in_'+new_counter+'" value="'+obj.time_in+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="mode_'+new_counter+'" type="text" class="" style="width:98%" id="mode_'+new_counter+'" value="'+obj.mode+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="breakdown_bill_'+new_counter+'" type="text" class="" style="width:98%" id="breakdown_bill_'+new_counter+'" value="'+obj.breakdown_bill+'"/>';
                                html_string += '</td>';
                                html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" value="'+obj.amount+'"/></td>';
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
                                datePicker('activities_date_'+new_counter);
                            }
                            else if(type==5)
                            {
                                html_string += '<tr id="expense_'+new_counter+'">';
                                html_string += '<td>';
                                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="'+obj.id+'">';
                                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                                if(i>1)
                                {
                                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                                }
                                html_string += '<td>';
                                html_string += '<input type="text" name="from_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="from_date_'+new_counter+'" value="'+date_formater(obj.from_date)+'" >';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input type="text" name="to_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="to_date_'+new_counter+'" value="'+date_formater(obj.to_date)+'" >';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="particulars_'+new_counter+'" type="text" class="" style="width:98%" id="particulars_'+new_counter+'" value="'+obj.particulars+'"/>';
                                html_string += '</td>';
                                html_string += '<td>';
                                html_string += '<input name="place_'+new_counter+'" type="text" class="" style="width:98%" id="place_'+new_counter+'" value="'+obj.place+'"/>';
                                html_string += '</td>';
                                html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" value="'+obj.amount+'"/></td>';
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
                                datePicker('activities_date_'+new_counter);
                            }
                            else
                            {
                                html_string += '<tr id="expense_'+new_counter+'">';
                                html_string += '<td>';
                                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="'+obj.id+'">';
                                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                                if(i>1)
                                {
                                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                                }
                                html_string += '<td>';
                                html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" >';
                                html_string += '</td>';
                                html_string += '<td><input name="movement_details_'+new_counter+'" type="text" class="" style="width:98%" id="movement_details_'+new_counter+'" value="'+obj.movement_details+'"/></td>';
                                html_string += '<td>';
                                html_string += '<input name="transportaion_mode_'+new_counter+'" type="text" class="" style="width:98%" id="transportaion_mode_'+new_counter+'" value="'+obj.move_of_transfortaion+'"/>';
                                html_string += '</td>';
                                html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" value="'+obj.amount+'"/></td>';
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
                                datePicker('activities_date_'+new_counter);
                            }   
                            
                        });
                        

                    }else{
                        alert("No Data Found");
                        jQuery('#add_edit').val('');
                    }
                }
            });
            
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
        function clear_form(){
            jQuery("#month").jqxComboBox('clearSelection');
            jQuery("input[name='month']").val('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#year").jqxDropDownList('val', date);
            jQuery("#staff_conv_type").jqxDropDownList('val', 1);
            jQuery('#staff_conv_type').jqxDropDownList({ disabled: false });
            make_expense_table();
        }


        function details (id,editrow,operation) {
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='delete'){
                jQuery('#comments').val('');
                jQuery("#verifyid").val('');
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").hide();
                jQuery("#delete_row").show();
                jQuery("#type").val('delete');
                jQuery("#deleteEventId").val(dataRecord['id']);
            }else if(operation=='sendtochecker'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#verify_row").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verifyid").val(dataRecord['id']);
            }else if(operation=='verify'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#verifyid").val(dataRecord['id']);
            }else{
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
            }

            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>expenses/get_staff_conv_details",
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

            document.getElementById("details").style.details='block';
            jQuery("#details").jqxWindow('open');
        }

        function make_expense_table()
        {
            var type = jQuery("#staff_conv_type").val();
            var head = '';
            var body = '';
            if(type!='')
            {
                if(type==1)
                {
                    //For Table Head
                    head+='<tr>';
                    head+='<td width="5%" style="font-weight: bold;text-align:center">D</td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Date<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Movement Details<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Mode of Transportaion<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Amount BDT<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>';
                    head+='</tr>';

                    //For Table Body

                    body+='<tr id="expense_1">';
                    body+='<td></td>';
                    body+='<td>';
                    body+='<input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" >';
                    body+='</td>';
                    body+='<td>';
                    body+='<input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">';
                    body+='<input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">';
                    body+='<input name="movement_details_1" type="text" class="" style="width:98%" id="movement_details_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="transportaion_mode_1" type="text" class="" style="width:98%" id="transportaion_mode_1"/>';
                    body+='</td>';
                    body+='<td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>';
                    body+='<td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>';
                    body+='</tr>';
                    datePicker('activities_date_1');
                    jQuery("#expense_head").html(head);
                    jQuery("#expense_body").html(body);
                }
                else if(type==2)
                {
                    //For Table Head
                    head+='<tr>';
                    head+='<td width="5%" style="font-weight: bold;text-align:center">D</td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Date<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Particulars<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Place<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Amount BDT<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>';
                    head+='</tr>';

                    //For Table Body

                    body+='<tr id="expense_1">';
                    body+='<td></td>';
                    body+='<td>';
                    body+='<input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" >';
                    body+='</td>';
                    body+='<td>';
                    body+='<input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">';
                    body+='<input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">';
                    body+='<input name="particulars_1" type="text" class="" style="width:98%" id="particulars_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="place_1" type="text" class="" style="width:98%" id="place_1"/>';
                    body+='</td>';
                    body+='<td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>';
                    body+='<td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>';
                    body+='</tr>';
                    datePicker('activities_date_1');
                    jQuery("#expense_head").html(head);
                    jQuery("#expense_body").html(body);
                }
                else if(type==3)
                {
                    //For Table Head
                    head+='<tr>';
                    head+='<td width="5%" style="font-weight: bold;text-align:center">D</td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center">Date<span style="color:red">*</span></td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Description of Journey<span style="color:red">*</span></td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center">Journey Time<span style="color:red">*</span></td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center">Journey Metar<span style="color:red">*</span></td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center">Reached Metar<span style="color:red">*</span></td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center">Reached Time<span style="color:red">*</span></td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Amount BDT<span style="color:red">*</span></td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Remarks</td>';
                    head+='</tr>';

                    //For Table Body

                    body+='<tr id="expense_1">';
                    body+='<td></td>';
                    body+='<td>';
                    body+='<input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" >';
                    body+='</td>';
                    body+='<td>';
                    body+='<input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">';
                    body+='<input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">';
                    body+='<input name="description_1" type="text" class="" style="width:98%" id="description_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="journey_time_1" type="text" class="" style="width:98%" id="journey_time_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="journey_metar_1" type="text" class="" style="width:98%" id="journey_metar_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="reached_metar_1" type="text" class="" style="width:98%" id="reached_metar_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="reached_time_1" type="text" class="" style="width:98%" id="reached_time_1"/>';
                    body+='</td>';
                    body+='<td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>';
                    body+='<td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>';
                    body+='</tr>';
                    datePicker('activities_date_1');
                    jQuery("#expense_head").html(head);
                    jQuery("#expense_body").html(body);
                }
                else if(type==4)
                {
                    //For Table Head
                    head+='<tr>';
                    head+='<td width="5%" style="font-weight: bold;text-align:center" rowspan="2">D</td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Date<span style="color:red">*</span></td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Purpose<span style="color:red">*</span></td>';
                    head+='<td width="35%" style="font-weight: bold;text-align:center" colspan="4">Destination</td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Mode<span style="color:red">*</span></td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Break Down Bill Amount<span style="color:red">*</span></td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Amount BDT<span style="color:red">*</span></td>';
                    head+='<td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Remarks</td>';
                    head+='</tr>';

                    head+='<tr>';
                    head+='<td style="font-weight: bold;text-align:center">From<span style="color:red">*</span></td>';
                    head+='<td style="font-weight: bold;text-align:center">Time out<span style="color:red">*</span></td>';
                    head+='<td style="font-weight: bold;text-align:center">To<span style="color:red">*</span></td>';
                    head+='<td style="font-weight: bold;text-align:center">Time In<span style="color:red">*</span></td>';
                    head+='</tr>';

                    //For Table Body

                    body+='<tr id="expense_1">';
                    body+='<td></td>';
                    body+='<td>';
                    body+='<input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" >';
                    body+='</td>';
                    body+='<td>';
                    body+='<input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">';
                    body+='<input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">';
                    body+='<input name="purpose_1" type="text" class="" style="width:98%" id="purpose_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="from_1" type="text" class="" style="width:98%" id="from_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="time_out_1" type="text" class="" style="width:98%" id="time_out_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="to_1" type="text" class="" style="width:98%" id="to_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="time_in_1" type="text" class="" style="width:98%" id="time_in_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="mode_1" type="text" class="" style="width:98%" id="mode_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="breakdown_bill_1" type="text" class="" style="width:98%" id="breakdown_bill_1"/>';
                    body+='</td>';
                    body+='<td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>';
                    body+='<td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>';
                    body+='</tr>';
                    datePicker('activities_date_1');
                    jQuery("#expense_head").html(head);
                    jQuery("#expense_body").html(body);
                }
                else if(type==5)
                {
                    //For Table Head
                    head+='<tr>';
                    head+='<td width="5%" style="font-weight: bold;text-align:center">D</td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">From Date<span style="color:red">*</span></td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">To Date<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Particulars<span style="color:red">*</span></td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Place<span style="color:red">*</span></td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Amount BDT<span style="color:red">*</span></td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Remarks</td>';
                    head+='</tr>';

                    //For Table Body

                    body+='<tr id="expense_1">';
                    body+='<td></td>';
                    body+='<td>';
                    body+='<input type="text" name="from_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="from_date_1" value="" >';
                    body+='</td>';
                    body+='<td>';
                    body+='<input type="text" name="to_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="to_date_1" value="" >';
                    body+='</td>';
                    body+='<td>';
                    body+='<input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">';
                    body+='<input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">';
                    body+='<input name="particulars_1" type="text" class="" style="width:98%" id="particulars_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="place_1" type="text" class="" style="width:98%" id="place_1"/>';
                    body+='</td>';
                    body+='<td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>';
                    body+='<td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>';
                    body+='</tr>';
                    datePicker('from_date_1');
                    datePicker('to_date_1');
                    jQuery("#expense_head").html(head);
                    jQuery("#expense_body").html(body);
                }
                else
                {
                    //For Table Head
                    head+='<tr>';
                    head+='<td width="5%" style="font-weight: bold;text-align:center">D</td>';
                    head+='<td width="15%" style="font-weight: bold;text-align:center">Date<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Movement Details<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Mode of Transportaion<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Amount BDT<span style="color:red">*</span></td>';
                    head+='<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>';
                    head+='</tr>';

                    //For Table Body

                    body+='<tr id="expense_1">';
                    body+='<td></td>';
                    body+='<td>';
                    body+='<input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" >';
                    body+='</td>';
                    body+='<td>';
                    body+='<input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">';
                    body+='<input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">';
                    body+='<input name="movement_details_1" type="text" class="" style="width:98%" id="movement_details_1"/>';
                    body+='</td>';
                    body+='<td>';
                    body+='<input name="transportaion_mode_1" type="text" class="" style="width:98%" id="transportaion_mode_1"/>';
                    body+='</td>';
                    body+='<td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>';
                    body+='<td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>';
                    body+='</tr>';
                    datePicker('activities_date_1');
                    jQuery("#expense_head").html(head);
                    jQuery("#expense_body").html(body);
                }
                jQuery("#expense_counter").val(1);
            }
        }
        function add_more_expense()
        {
            var theme = getDemoTheme();
            var counter = jQuery('#expense_counter').val();
            var new_counter = parseInt(counter) + 1;
            var type = jQuery("#staff_conv_type").val();
            if(type!='')
            {
                if(type==1)
                {
                    html_string = '';
                    html_string += '<tr id="expense_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                    html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'" value="">';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" >';
                    html_string += '</td>';
                    html_string += '<td><input name="movement_details_'+new_counter+'" type="text" class="" style="width:98%" id="movement_details_'+new_counter+'"/></td>';
                    html_string += '<td>';
                    html_string += '<input name="transportaion_mode_'+new_counter+'" type="text" class="" style="width:98%" id="transportaion_mode_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" /></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                    jQuery('#expense_' + counter).after(html_string);
                    jQuery('#expense_counter').val(new_counter);
                    
                    datePicker('activities_date_'+new_counter);
                }
                else if(type==2)
                {
                    html_string = '';
                    html_string += '<tr id="expense_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                    html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'" value="">';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" >';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="particulars_'+new_counter+'" type="text" class="" style="width:98%" id="particulars_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="place_'+new_counter+'" type="text" class="" style="width:98%" id="place_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" /></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                    jQuery('#expense_' + counter).after(html_string);
                    jQuery('#expense_counter').val(new_counter);
                    
                    datePicker('activities_date_'+new_counter);
                }
                else if(type==3)
                {
                    html_string = '';
                    html_string += '<tr id="expense_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                    html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'" value="">';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" >';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="description_'+new_counter+'" type="text" class="" style="width:98%" id="description_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="journey_time_'+new_counter+'" type="text" class="" style="width:98%" id="journey_time_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="journey_metar_'+new_counter+'" type="text" class="" style="width:98%" id="journey_metar_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="reached_metar_'+new_counter+'" type="text" class="" style="width:98%" id="reached_metar_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="reached_time_'+new_counter+'" type="text" class="" style="width:98%" id="reached_time_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" /></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                    jQuery('#expense_' + counter).after(html_string);
                    jQuery('#expense_counter').val(new_counter);
                    
                    datePicker('activities_date_'+new_counter);
                }
                else if(type==4)
                {
                    html_string = '';
                    html_string += '<tr id="expense_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                    html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'" value="">';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" >';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="purpose_'+new_counter+'" type="text" class="" style="width:98%" id="purpose_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="from_'+new_counter+'" type="text" class="" style="width:98%" id="from_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="time_out_'+new_counter+'" type="text" class="" style="width:98%" id="time_out_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="to_'+new_counter+'" type="text" class="" style="width:98%" id="to_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="time_in_'+new_counter+'" type="text" class="" style="width:98%" id="time_in_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="mode_'+new_counter+'" type="text" class="" style="width:98%" id="mode_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="breakdown_bill_'+new_counter+'" type="text" class="" style="width:98%" id="breakdown_bill_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" /></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                    jQuery('#expense_' + counter).after(html_string);
                    jQuery('#expense_counter').val(new_counter);
                    
                    datePicker('activities_date_'+new_counter);
                }
                else if(type==5)
                {
                    html_string = '';
                    html_string += '<tr id="expense_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                    html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'" value="">';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input type="text" name="from_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="from_date_'+new_counter+'" value="" >';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input type="text" name="to_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="to_date_'+new_counter+'" value="" >';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                    html_string += '<input name="particulars_'+new_counter+'" type="text" class="" style="width:98%" id="particulars_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input name="place_'+new_counter+'" type="text" class="" style="width:98%" id="place_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" /></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                    jQuery('#expense_' + counter).after(html_string);
                    jQuery('#expense_counter').val(new_counter);
                    datePicker('from_date_'+new_counter);
                    datePicker('to_date_'+new_counter);
                }
                else
                {
                    html_string = '';
                    html_string += '<tr id="expense_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                    html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'" value="">';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                    html_string += '</td>';
                    html_string += '<td>';
                    html_string += '<input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" >';
                    html_string += '</td>';
                    html_string += '<td><input name="movement_details_'+new_counter+'" type="text" class="" style="width:98%" id="movement_details_'+new_counter+'"/></td>';
                    html_string += '<td>';
                    html_string += '<input name="transportaion_mode_'+new_counter+'" type="text" class="" style="width:98%" id="transportaion_mode_'+new_counter+'"/>';
                    html_string += '</td>';
                    html_string += '<td><input name="amount_'+new_counter+'" type="text" class="" style="width:90%" id="amount_'+new_counter+'" /></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                    jQuery('#expense_' + counter).after(html_string);
                    jQuery('#expense_counter').val(new_counter);
                    
                    datePicker('activities_date_'+new_counter);
                }
            }
            
        }
        function delete_row_expense (row_id) {
            jQuery('#expense_' + row_id).hide();
            jQuery('#expense_delete_' + row_id).val(1);
        }
        function expense_validation()
        {
            var counter = jQuery('#expense_counter').val();
            for (i=1;i<=counter;i++) 
            {
                if(jQuery('#expense_delete_'+i).val()==0) 
                {
                    var type = jQuery("#staff_conv_type").val();
                    if(type!='')
                    {
                        if(type==1)
                        {
                            if(jQuery.trim(jQuery('#activities_date_'+i).val())=='')
                            {
                                alert('Date Required');
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
                            if(jQuery.trim(jQuery('#movement_details_'+i).val())=='')
                            {
                                alert('Movement Details Required');
                                jQuery('#movement_details_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#transportaion_mode_'+i).val())=='')
                            {
                                alert('Transportaion Mode Required');
                                jQuery('#transportaion_mode_'+i).focus();
                                return false;
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
                        else if(type==2)
                        {
                            if(jQuery.trim(jQuery('#activities_date_'+i).val())=='')
                            {
                                alert('Date Required');
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
                            if(jQuery.trim(jQuery('#particulars_'+i).val())=='')
                            {
                                alert('Particulars Required');
                                jQuery('#particulars_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#place_'+i).val())=='')
                            {
                                alert('Place Required');
                                jQuery('#place_'+i).focus();
                                return false;
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
                        else if(type==3)
                        {
                            if(jQuery.trim(jQuery('#activities_date_'+i).val())=='')
                            {
                                alert('Date Required');
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
                            if(jQuery.trim(jQuery('#description_'+i).val())=='')
                            {
                                alert('Description Required');
                                jQuery('#description_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#journey_time_'+i).val())=='')
                            {
                                alert('Journey Time Required');
                                jQuery('#journey_time_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#journey_metar_'+i).val())=='')
                            {
                                alert('Journey Metar Required');
                                jQuery('#journey_metar_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#reached_metar_'+i).val())=='')
                            {
                                alert('Reached Metar Required');
                                jQuery('#reached_metar_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#reached_time_'+i).val())=='')
                            {
                                alert('Reached Time Required');
                                jQuery('#reached_time_'+i).focus();
                                return false;
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
                        else if(type==4)
                        {
                            if(jQuery.trim(jQuery('#activities_date_'+i).val())=='')
                            {
                                alert('Date Required');
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
                            if(jQuery.trim(jQuery('#purpose_'+i).val())=='')
                            {
                                alert('Purpose Required');
                                jQuery('#purpose_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#from_'+i).val())=='')
                            {
                                alert('From Required');
                                jQuery('#from_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#time_out_'+i).val())=='')
                            {
                                alert('Time Out Required');
                                jQuery('#time_out_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#to_'+i).val())=='')
                            {
                                alert('To Required');
                                jQuery('#to_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#time_in_'+i).val())=='')
                            {
                                alert('Time In Required');
                                jQuery('#time_in_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#mode_'+i).val())=='')
                            {
                                alert('Mode Required');
                                jQuery('#mode_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#breakdown_bill_'+i).val())=='')
                            {
                                alert('Breakdown Bill Required');
                                jQuery('#breakdown_bill_'+i).focus();
                                return false;
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
                        else if(type==5)
                        {
                            if(jQuery.trim(jQuery('#from_date_'+i).val())=='')
                            {
                                alert('From Date Required');
                                jQuery('#from_date_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#from_date_'+i).val())!='')
                            {
                                if(!validate_date(jQuery('#from_date_'+i).val()))
                                {
                                    alert('From Date Invalid');
                                    jQuery('#from_date_'+i).focus();
                                    return false;
                                }
                            }
                            if(jQuery.trim(jQuery('#to_date_'+i).val())=='')
                            {
                                alert('To Date Required');
                                jQuery('#to_date_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#to_date_'+i).val())!='')
                            {
                                if(!validate_date(jQuery('#to_date_'+i).val()))
                                {
                                    alert('To Date Invalid');
                                    jQuery('#to_date_'+i).focus();
                                    return false;
                                }
                            }
                            if(jQuery.trim(jQuery('#particulars_'+i).val())=='')
                            {
                                alert('Particulars Required');
                                jQuery('#particulars_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#place_'+i).val())=='')
                            {
                                alert('Place Required');
                                jQuery('#place_'+i).focus();
                                return false;
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
                        else
                        {
                            if(jQuery.trim(jQuery('#activities_date_'+i).val())=='')
                            {
                                alert('Date Required');
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
                            if(jQuery.trim(jQuery('#movement_details_'+i).val())=='')
                            {
                                alert('Movement Details Required');
                                jQuery('#movement_details_'+i).focus();
                                return false;
                            }
                            if(jQuery.trim(jQuery('#transportaion_mode_'+i).val())=='')
                            {
                                alert('Transportaion Mode Required');
                                jQuery('#transportaion_mode_'+i).focus();
                                return false;
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
                        <?php $this->load->view('expenses/pages/left_side_nav',$operation_name); ?>
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
                                    <div style="padding: 10px;">
                                    <form class="form" name="stuff_convence" id="stuff_convence" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Conveyence Type<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="staff_conv_type" name="staff_conv_type" style="padding-left: 3px" onchange="make_expense_table()"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Year<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="year" name="year" style="padding-left: 3px"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Month<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="month" name="month" style="padding-left: 3px"></div></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display:contents;">
                                                        <table style="width: 100%;">
                                                           <tr>
                                                                <td width="40%" style="font-weight: bold;">Staff Name</td>
                                                                <td width="60%" ><?=$this->session->userdata["ast_user"]["user_name"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Staff PIN</td>
                                                                <td width="60%" ><?=$this->session->userdata["ast_user"]["pin"]?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Functional Designation</td>
                                                                <td width="60%" ><?=$this->session->userdata["ast_user"]["user_designation"]?></td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="2">
                                                        <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                            <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expenses</span>
                                                            <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                <input type="hidden" name="expense_counter" id="expense_counter" value="1">
                                                                <thead id="expense_head">
                                                                    
                                                                </thead>
                                                                <tbody id="expense_body">
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr id="add_guarantor_row">
                                                                        <td colspan="11" style="text-align: right">
                                                                            Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button" >
                                                    <td colspan="4" style="text-align: center;">
                                                        <br/>
                                                        <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                                        <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                        <br/><br/><br/>
                                                    </td>
                                                </tr>
                                                <? } ?>
                                                <? if(EDIT==1){?>
                                                <tr id="up_button" style="display: none;">
                                                    <td colspan="4" style="text-align: center;">
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
                                    <strong>D = </strong> Delete,&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify&nbsp;
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

    <div id="details" style="display:none;">
        <div style=""><strong>Staff Conveyence Details</strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
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
            <div id="checker_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <!-- <input type="button" value="Send" id="sendtochecker" class="btn-small btn-small-normal enabledElem buttondelete" /> -->
                <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
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
            <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                <textarea name="comments" id="comments" style="width:370px;"></textarea>
                
                <br><br>
                <input type="button" class="buttondelete" id="delete_button" value="Delete">
                <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
                <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                
            </div>
            </form>
        </div>
    </div>
<?php endif ?>
<!-- For Court Entertainment Bill -->
<?php if ($operation=='court_enter' && VIEWCOURTENTER==1): ?>
    <script type="text/javascript">
            var theme = getDemoTheme();
            var csrf_tokens='';
            var proposed_type = ["Loan", "Card"];
            var functional_designation = [<? $i=1; foreach($functional_designation as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var employee_type = [<? $i=1; foreach($employee_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var expense_activities = [<? $i=1; foreach($expense_activities as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var month = [<? $i=1; foreach($billing_month as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#functional_desig").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Functional Designation", source: functional_designation, height: 25});
            jQuery("#employee_type").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Employee Type", source: employee_type, height: 25});
            jQuery("#req_type_1").jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Case Type", source: req_type, height: 25});
            jQuery("#activities_name_1").jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Expense Activities", source: expense_activities, height: 25});
            jQuery("#billing_month").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Bill Month", source: month, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Legal Region", source: legal_region, height: 25});
            jQuery("#district").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
            jQuery('#employee_type,#billing_month,#legal_region,#district,#req_type_1').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
            jQuery("#proposed_type_1").jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: proposed_type, height: 25});
            jQuery("#proposed_type_1").jqxComboBox('val','Loan');
            jQuery('#staff_pin').html('<?=$this->session->userdata["ast_user"]["pin"]?>');
            jQuery('#staff_name').html('<?=$this->session->userdata["ast_user"]["user_name"]?>');
            jQuery('#mobile_no').val('<?=$this->session->userdata["ast_user"]["mobile_number"]?>');
            jQuery('#account_number').val('<?=$this->session->userdata["ast_user"]["bank_ac"]?>');
            jQuery('#functional_desig').jqxComboBox('val', '<?=$this->session->userdata["ast_user"]["functional_designation_id"]?>');
            
            jQuery('#functional_desig').jqxComboBox({ disabled: true });

            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'employee_type', type: 'int'},
                        { name: 'staff_pin', type: 'string'},
                        { name: 'v_sts', type: 'int'},
                        { name: 'employee_name', type: 'string'},
                        { name: 'job_grade', type: 'string'},
                        { name: 'functional_desig', type: 'string'},
                        { name: 'verifier_group_id', type: 'int'},
                        { name: 'mobile_no', type: 'string'},
                        { name: 'billing_month', type: 'string'},
                        { name: 'account_number', type: 'string'},
                        { name: 'legal_region', type: 'string'},
                        { name: 'district', type: 'string'},
                        { name: 'base_office_name', type: 'string'},
                        { name: 'status', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
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
                    url: '<?=base_url()?>index.php/expenses/court_enter_grid',
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
                var win_h=jQuery( window ).height()-240;
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
                        <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                        <?php } ?>
                        <?php if(EDIT==1){ ?>
                        { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if( dataRecord.v_sts == 35 || dataRecord.v_sts == 39  || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }
                            else if(dataRecord.v_sts == 37){
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
                                if((check_group_javascript(dataRecord.verifier_group_id)==true || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.v_sts == 37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.v_sts == 38){
                                        return '<div style=" margin-top: 8px;text-align:center">V</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                          <? }?>
                        <? if(REIMBURSMENT==1){?>
                            { text: 'TS', menu: false, datafield: 'reimbursemnt', align:'center', editable: false, sortable: false, width: '3%',
                                cellsrenderer: function (row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                                if(dataRecord.v_sts == 38){
                                    //For Bill Memo
                                    //return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/expenses/download_court_enter_reimbursment/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
                                    //For Top Sheet
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/expenses/download_court_enter_topsheet/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/icon_xls.gif"></a></div>';
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
                        { text: 'Status', datafield: 'status',editable: false, width: '18%', align:'left',cellsalign:'left'},
                        { text: 'Employee Type', datafield: 'employee_type',editable: false, width: '15%'},
                        { text: 'Staff Pin', datafield: 'staff_pin',editable: false, width: '10%'},
                        { text: 'Employee Name', datafield: 'employee_name',editable: false, width: '10%'},
                        { text: 'Job Grade', datafield: 'job_grade',editable: false, width: '15%'},
                        { text: 'Functional Designation', datafield: 'functional_desig',editable: false, width: '15%'},
                        { text: 'Mobile No.', datafield: 'mobile_no',editable: false, width: '10%'},
                        { text: 'Billing Month', datafield: 'billing_month',editable: false, width: '10%'},
                        { text: 'Legal Region', datafield: 'legal_region',editable: false, width: '10%'},
                        { text: 'District', datafield: 'district',editable: false, width: '10%'},
                        { text: 'Base Office Name', datafield: 'base_office_name',editable: false, width: '10%'},
                        { text: 'Entry By', datafield: 'e_by',editable: false, width: '15%'},
                        { text: 'Entry Date Time', datafield: 'e_dt',editable: false, width: '15%'},
                        
                    ],
                            
                });
                    
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:450, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verify_cancel") });
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
                jQuery('#court_entertainment').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            rules= [
                { input: '#employee_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#employee_type").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='employee_type']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#employee_type input").focus();
                                return false;
                            }
                    }
                },
                { input: '#job_grade', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#job_grade").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                 }
                },
                { input: '#functional_desig', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#functional_desig").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                 }
                },
                { input: '#mobile_no', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#mobile_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                 }
                },
                { input: '#mobile_no', message: 'invalid', action: 'keyup, blur, change', rule: function (input, commit) {
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
                    } 
                },
                { input: '#billing_month', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#billing_month").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='billing_month']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#billing_month input").focus();
                                return false;
                            }
                    }
                },
                { input: '#account_number', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#account_number").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                 }
                },
                { input: '#account_number', message: 'only numeric', action: 'blur,change', rule: function (input) {
                    if (input.val()!='')
                    {
                        if(!checknumber_alphabatic('account_number'))
                        {
                            jQuery("#account_number").focus();
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
                // { input: '#account_number', message: '16 digit required', action: 'blur,change', rule: function (input) {  
                //     if (input.val()!='')
                //     {
                //         if(input.val().length >16 || input.val().length<16)
                //         {
                //             jQuery("#account_number").focus();
                //             return false;               
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
                { input: '#legal_region', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='legal_region']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#legal_region input").focus();
                                return false;
                            }
                    }
                },
                { input: '#district', message: 'required!', action: 'blur,change', rule: function(input,commit){
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
                { input: '#base_office_name', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#base_office_name").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                 }
                },
            ];
            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#court_entertainment').jqxValidator({
                        rules: rules, theme: theme
                });
                
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true) {
                        
                        show_confrimation_pop_up('Save');
                    }
                }
                jQuery('#court_entertainment').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#court_entertainment').jqxValidator({
                        rules: rules, theme: theme
                });
                
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true) {
                        
                        show_confrimation_pop_up('Update');
                    }
                }
                jQuery('#court_entertainment').jqxValidator('validate', validationResult);        
            });
            // Delete Form Validation 
            jQuery('#delete_convence').jqxValidator({
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
            // Delete Ajax call
            jQuery("#delete_button").click(function () {
                
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#delete_button").hide();
                        jQuery("#deletecancel").hide();
                        jQuery("#delete_loading").show();
                        delete_submit();
                    }
                }
                jQuery('#delete_convence').jqxValidator('validate', validationResult);
             });

            // Send to checaker Ajax Call
            jQuery("#sendtochecker").click(function () {
                    jQuery("#sendtochecker").hide();
                    jQuery("#SendTocheckercancel").hide();
                    jQuery("#checker_loading").show();
                    delete_submit();
             });
            jQuery("#approve").click( function() {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
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
                    delete_submit();
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
                    delete_submit();
                }
             });

                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'court_approval_file\')"/>';
                html+='<input type="hidden" id="hidden_court_approval_file_select" name="hidden_court_approval_file_select" value="0">';
                html+='<span id="hidden_court_approval_file"></span><input type="hidden" id="approval_select_add_edit" name="approval_select_add_edit" value="add">';
                jQuery('#court_approval_file').html(html);

        });
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
        function clear_ac(counter)
        {
            jQuery("#account_no_"+counter).val('');
            jQuery("#hidden_loan_ac_"+counter).val('');
            jQuery("#ac_name_"+counter).val('');
            jQuery("#case_no_"+counter).val('');
            jQuery("#suit_id_"+counter).val('');
            jQuery("#req_type_"+counter).jqxComboBox('clearSelection');
            jQuery("#req_type_"+counter).val('');
        }
        function mask(str,textbox,counter){
            jQuery("#ac_name_"+counter).val('');
            jQuery("#case_no_"+counter).val('');
            jQuery("#suit_id_"+counter).val('');
            jQuery("#req_type_"+counter).jqxComboBox('clearSelection');
            jQuery("#req_type_"+counter).val('');
            var item = jQuery("#proposed_type_"+counter).jqxComboBox('getSelectedItem');
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
                        jQuery("#hidden_loan_ac_"+counter).val(str);
                    }
                    else//For single value enter
                    {
                        //For New value
                        var orginal_loan_ac=jQuery("#hidden_loan_ac_"+counter).val();
                        if (orginal_loan_ac.length<str.length) 
                        {
                            var index = str.length-1;
                            var new_val=str.slice(index);
                            orginal_loan_ac+=new_val;
                            //alert(orginal_loan_ac);
                            jQuery("#hidden_loan_ac_"+counter).val(orginal_loan_ac);
                        }
                        //For delete key
                        else{
                            var len=str.length;
                            var new_val=orginal_loan_ac.slice(0,len);
                            jQuery("#hidden_loan_ac_"+counter).val(new_val);
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
                              if (letter_Count<6 || jQuery("#hidden_loan_ac_"+counter).val().length!=16) 
                              {
                                textbox.value = '';
                                jQuery("#hidden_loan_ac_"+counter).val('');
                                alert('Wrong way to input Card No please try again');
                              }
                        }
                    }
                }
            }
            
        }
        function call_ajax_submit(){
            $('sendToCheckerMessageDialogConfirm').style.display = 'none';
            $('sendToCheckerMessageDialogCancel').style.display = 'none';
            $('loadingReturn').style.display = 'inline';
            var postdata = jQuery('#court_entertainment').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_id = jQuery("#edit_id").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/add_edit_court_enter/"+add_edit+"/"+edit_id,
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
                        alert(json.Message);
                        return false;
                    }
                    var msg='';
                    if(edit_id>0){
                        msg='Updated';
                    }else{
                        msg="Saved";
                    }
                    clear_form();
                    $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                    $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                    $('loadingReturn').style.display = 'none';
                    close_window();
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
        function delete_submit(){
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
            //console.log(postData);
            //return false
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/expenses/delete_action_court_enter/',
                data : postData,
                datatype: "json",
                success: function(response){
                    //console.log(response);
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
                        }
                        var msz='';
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                                
                    }
                }
            });
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
        function edit(id,editrow){
            
            var val=id;
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/get_edit_info_court_enter",
                data : {[csrfName]: csrfHash,id:val},
                datatype: "json",
                async:false,
                success: function(response){
                   
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.Message=='ok'){
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'court_approval_file\')"/>';
                        html+='<input type="hidden" id="hidden_court_approval_file_select" name="hidden_court_approval_file_select" value="0">';
                        html+='<span id="hidden_court_approval_file"></span><input type="hidden" id="approval_select_add_edit" name="approval_select_add_edit" value="add">';
                        jQuery('#court_approval_file').html(html);
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery('#add_edit').val('edit');
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        jQuery('#employee_type').jqxComboBox('val', json.row_info.employee_type);
                        jQuery('#billing_month').jqxComboBox('val', json.row_info.billing_month);
                        jQuery('#legal_region').jqxComboBox('val', json.row_info.legal_region);
                        jQuery('#district').jqxComboBox('val', json.row_info.district);

                        jQuery('#prev_date').val(date_formater(json.row_info.prev_date));
                        
                        var court_approval_file = json.row_info.court_approval_file;
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'court_approval_file\')"/>';
                        html+='<input type="hidden" id="hidden_court_approval_file_select" name="hidden_court_approval_file_select" value="0">';
                        if(court_approval_file!='' && court_approval_file!=null)
                        {
                            html +='<span id="hidden_court_approval_file"><img id="file_preview_court_approval_file" onclick="popup(\'<?=base_url()?>cma_file/court_approval_file/'+court_approval_file+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                            html +='<input type="hidden" id="hidden_court_approval_file_value" name="hidden_court_approval_file_value" value="'+court_approval_file+'">';
                            html +='<img id="file_delete_court_approval_file" onclick="file_delete(\'court_approval_file\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                            html +='<input type="hidden" id="file_delete_value_court_approval_file" name="file_delete_value_court_approval_file" value="0">';
                            html+='<span id="hidden_court_approval_file"></span><input type="hidden" id="approval_select_add_edit" name="approval_select_add_edit" value="edit">';
                        }
                        else
                        {
                            html+='<span id="hidden_court_approval_file"></span><input type="hidden" id="approval_select_add_edit" name="approval_select_add_edit" value="add">';
                        }
                        jQuery('#court_approval_file').html(html);
                        jQuery('#staff_pin').html(json.row_info.staff_pin);
                        jQuery('#staff_name').html(json.row_info.employee_name);
                        jQuery('#job_grade').val(json.row_info.job_grade);
                        jQuery('#functional_desig').val(json.row_info.functional_desig);
                        jQuery('#mobile_no').val(json.row_info.mobile_no);
                        jQuery('#account_number').val(json.row_info.account_number);
                        jQuery('#base_office_name').val(json.row_info.base_office_name);
                        
                        jQuery('#expense_counter').val('0');
                        jQuery('#expense_body').html('');
                        jQuery("#edit_id").val(json.row_info.id);
                        var i=0;
                        //console.log(json['expense'])
                        jQuery.each(json['expense'],function(key,obj){
                            i++;
                            var counter = jQuery('#expense_counter').val();
                            var new_counter = parseInt(counter) + 1;
                            html_string = '';

                                html_string += '<tr id="expense_'+new_counter+'">';
                                html_string += '<td>';
                                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="'+obj.id+'">';
                                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                                html_string += '<input type="hidden" id="hidden_pre_org_ac_'+new_counter+'" value="" name="hidden_pre_org_ac_'+new_counter+'" value="">';
                                html_string += '<input type="hidden" id="hidden_loan_ac_'+new_counter+'" value="" name="hidden_loan_ac_'+new_counter+'" value="">';
                                html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'">';
                                if(i>1)
                                {
                                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                                }
                                html_string += '<td><div id="proposed_type_'+new_counter+'" name="proposed_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%" onchange="clear_ac('+new_counter+')"></div></td>';
                                html_string += '</td>';
                                html_string += '<td><input name="account_no_'+new_counter+'" type="text" class="" maxlength="16" size="16" style="width:98%" id="account_no_'+new_counter+'"  onKeyUp="javascript:return mask(this.value,this,'+new_counter+');" /></td>';
                                html_string += '<td><div id="req_type_'+new_counter+'" name="req_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%"></div></td>';
                                html_string += '<td><input name="ac_name_'+new_counter+'" type="text" class="" style="width:98%" id="ac_name_'+new_counter+'" /></td>';
                                html_string += '<td><input name="case_no_'+new_counter+'" type="text" class="" style="width:98%" id="case_no_'+new_counter+'" /></td>';
                                html_string +='<td><textarea name="particulars_'+new_counter+'" class="text-input-big" id="particulars_'+new_counter+'" style="height:40px !important;width:90%">'+obj.remarks+'</textarea></td>';
                                html_string +='<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%" onchange=""></div></td>';
                                html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" ></td>';
                                html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="'+obj.amount+'" ></td>';
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
                            jQuery('#proposed_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: proposed_type, height: 25});
                            jQuery('#proposed_type_'+new_counter).jqxComboBox('val', obj.proposed_type);
                            jQuery('#account_no_'+new_counter).val(obj.account_number);
                            jQuery('#ac_name_'+new_counter).val(obj.ac_name);
                            jQuery('#case_no_'+new_counter).val(obj.case_number);
                            jQuery('#suit_id_'+new_counter).val(obj.suit_id);
                            jQuery('#hidden_pre_org_ac_'+new_counter).val(obj.org_loan_ac);
                            
                            jQuery('#req_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Case Type", source: req_type, height: 25});
                            jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Expense Activities", source: expense_activities, height: 25});
                            jQuery('#req_type_'+new_counter).focusout(function() {
                                        commbobox_check(jQuery(this).attr('id'));
                            });
                            jQuery('#activities_name_'+new_counter).focusout(function() {
                                        commbobox_check(jQuery(this).attr('id'));
                            });
                            // jQuery('#proposed_type_'+new_counter).jqxComboBox({ disabled: true });
                            // jQuery('#req_type_'+new_counter).jqxComboBox({ disabled: true });
                            datePicker('activities_date_'+new_counter);
                            jQuery('#req_type_'+new_counter).jqxComboBox('val', obj.req_type);
                            jQuery('#activities_name_'+new_counter).jqxComboBox('val', obj.activities_name);
                            jQuery('#req_type_'+new_counter).bind('change', function (event) {
                                get_case_number(new_counter);
                            });
                        });
                        

                    }else{
                        alert("No Data Found");
                        jQuery('#add_edit').val('');
                    }
                }
            });
            
        }
        function clear_form(){
            jQuery("#employee_type").jqxComboBox('clearSelection');
            jQuery("input[name='employee_type']").val('');
            jQuery("#billing_month").jqxComboBox('clearSelection');
            jQuery("input[name='billing_month']").val('');
            jQuery('#staff_pin').html('<?=$this->session->userdata["ast_user"]["pin"]?>');
            jQuery('#staff_name').html('<?=$this->session->userdata["ast_user"]["user_name"]?>');
            jQuery('#mobile_no').val('<?=$this->session->userdata["ast_user"]["mobile_number"]?>');
            jQuery('#account_number').val('<?=$this->session->userdata["ast_user"]["bank_ac"]?>');
            jQuery('#functional_desig').jqxComboBox('val', '<?=$this->session->userdata["ast_user"]["functional_designation_id"]?>');
            jQuery('#functional_desig').jqxComboBox({ disabled: true });
            jQuery("#job_grade").val('');
            jQuery("#base_office_name").val('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_id").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            reset_expense();
        }
        function details (id,editrow,operation) {
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='delete'){
                jQuery('#comments').val('');
                jQuery("#verifyid").val('');
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#delete_row").show();
                jQuery("#type").val('delete');
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val(dataRecord['id']);
            }else if(operation=='sendtochecker'){
                jQuery("#r_heading").html('Send To Checker');
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verify_row").hide();
                jQuery("#verifyid").val(dataRecord['id']);
            }else if(operation=='verify'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#verifyid").val(dataRecord['id']);
            }else{
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
                jQuery("#verify_row").hide();
                jQuery("#r_heading").html('Preview');
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>expenses/get_court_enter_details",
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
        function  get_case_number(counter) 
        {
            var item2 = jQuery("#proposed_type_"+counter).jqxComboBox('getSelectedItem');
            var item = jQuery("#req_type_"+counter).jqxComboBox('getSelectedItem');
            var loan_ac = jQuery('#account_no_'+counter).val();
            var hidden_loan_ac = jQuery('#hidden_loan_ac_'+counter).val();
            if(item2!=null && item!=null && loan_ac!='')
            {
                var proposed_type = item2.value;
                var req_type = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                url: '<?=base_url()?>index.php/expenses/get_case_number',
                async:false,
                type: "post",
                data: { [csrfName]: csrfHash,proposed_type : proposed_type,req_type:req_type,loan_ac:loan_ac,hidden_loan_ac:hidden_loan_ac},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str='';
                    if(json.Message!='ok'){
                        alert(json.Message);
                        jQuery('#case_no_'+counter).val('');
                        jQuery('#suit_id_'+counter).val('');
                        jQuery('#ac_name_'+counter).val('');
                    }else{
                        jQuery('#case_no_'+counter).val(json.suit_row.case_number);
                        jQuery('#suit_id_'+counter).val(json.suit_row.id);
                        jQuery('#ac_name_'+counter).val(json.suit_row.ac_name);
                    }
                    },
                    error:   function(model, xhr, options){
                        alert('failed');
                    },
                    });
            }
            else
            {
                jQuery('#case_no_'+counter).val('');
                jQuery('#suit_id_'+counter).val('');
                jQuery('#ac_name_'+counter).val('');
            }
        }
        function reset_expense()
        {
            jQuery('#expense_body').html('');
            jQuery('#expense_counter').val(0);
            var theme = getDemoTheme();
            var counter = jQuery('#expense_counter').val();
            var new_counter = parseInt(counter) + 1;
            html_string = '';

               html_string += '<tr id="expense_'+new_counter+'">';
                html_string += '<td>';
                html_string += '<input type="hidden" id="hidden_pre_org_ac_'+new_counter+'" value="" name="hidden_pre_org_ac_'+new_counter+'" value="">';
                html_string += '<input type="hidden" id="hidden_loan_ac_'+new_counter+'" value="" name="hidden_loan_ac_'+new_counter+'">';
                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'" value="">';
                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                html_string += '</td>';
                html_string += '<td><div id="proposed_type_'+new_counter+'" name="proposed_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%" onchange="clear_ac('+new_counter+')"></div></td>';
                html_string += '<td><input name="account_no_'+new_counter+'" type="text" class="" maxlength="16" size="16" style="width:98%" id="account_no_'+new_counter+'" onKeyUp="javascript:return mask(this.value,this,'+new_counter+');"/></td>';
                html_string += '<td><div id="req_type_'+new_counter+'" name="req_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%" onchange="get_case_number('+new_counter+')"></div></td>';
                html_string += '<td><input name="ac_name_'+new_counter+'" type="text" class="" style="width:98%" id="ac_name_'+new_counter+'" /></td>';
                html_string += '<td><input name="case_no_'+new_counter+'" type="text" class="" style="width:98%" id="case_no_'+new_counter+'" /></td>';
                html_string +='<td><textarea name="particulars_'+new_counter+'" class="text-input-big" id="particulars_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                html_string +='<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%" onchange=""></div></td>';
                html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
                html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
                html_string += '</tr>';

            jQuery('#expense_body').html(html_string);
            jQuery('#expense_counter').val(new_counter);
            jQuery('#proposed_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: proposed_type, height: 25});
            jQuery('#req_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Case Type", source: req_type, height: 25});
            jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Expense Activities", source: expense_activities, height: 25});
            jQuery('#req_type_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#proposed_type_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#activities_name_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#proposed_type_'+new_counter).jqxComboBox('val','Loan');
            datePicker('activities_date_'+new_counter);
            
        }
        function add_more_expense()
        {
            var theme = getDemoTheme();
            var counter = jQuery('#expense_counter').val();
            var new_counter = parseInt(counter) + 1;
            html_string = '';

                html_string += '<tr id="expense_'+new_counter+'">';
                html_string += '<td>';
                html_string += '<input type="hidden" id="hidden_pre_org_ac_'+new_counter+'" value="" name="hidden_pre_org_ac_'+new_counter+'" value="">';
                html_string += '<input type="hidden" id="hidden_loan_ac_'+new_counter+'" value="" name="hidden_loan_ac_'+new_counter+'">';
                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                html_string += '<input type="hidden" id="suit_id_'+new_counter+'" name="suit_id_'+new_counter+'" value="">';
                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                html_string += '</td>';
                html_string += '<td><div id="proposed_type_'+new_counter+'" name="proposed_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%" onchange="clear_ac('+new_counter+')"></div></td>';
                html_string += '<td><input name="account_no_'+new_counter+'" type="text" class="" maxlength="16" size="16" style="width:98%" id="account_no_'+new_counter+'" onKeyUp="javascript:return mask(this.value,this,'+new_counter+');"/></td>';
                html_string += '<td><div id="req_type_'+new_counter+'" name="req_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%" onchange="get_case_number('+new_counter+')"></div></td>';
                html_string += '<td><input name="ac_name_'+new_counter+'" type="text" class="" style="width:98%" id="ac_name_'+new_counter+'" /></td>';
                html_string += '<td><input name="case_no_'+new_counter+'" type="text" class="" style="width:98%" id="case_no_'+new_counter+'" /></td>';
                html_string +='<td><textarea name="particulars_'+new_counter+'" class="text-input-big" id="particulars_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                html_string +='<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%" onchange=""></div></td>';
                html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
                html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
                html_string += '</tr>';

            jQuery('#expense_' + counter).after(html_string);
            jQuery('#expense_counter').val(new_counter);
            jQuery('#proposed_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: proposed_type, height: 25});
            jQuery('#req_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Case Type", source: req_type, height: 25});
            jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Expense Activities", source: expense_activities, height: 25});
            jQuery('#req_type_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#proposed_type_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#activities_name_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#proposed_type_'+new_counter).jqxComboBox('val','Loan');
            datePicker('activities_date_'+new_counter);
            
        }
        function delete_row_expense (row_id) {
            jQuery('#expense_' + row_id).hide();
            jQuery('#expense_delete_' + row_id).val(1);
        }
        function expense_validation()
        {
            var counter = jQuery('#expense_counter').val();
            for (i=1;i<=counter;i++) 
            {
                if(jQuery('#expense_delete_'+i).val()==0) 
                {
                    var item = jQuery("#req_type_"+i).jqxComboBox('getSelectedItem');
                    var item2 = jQuery("#proposed_type_"+i).jqxComboBox('getSelectedItem');
                    var act = jQuery("#activities_name_"+i).jqxComboBox('getSelectedItem');
                    if (!item2)
                    {
                        alert('Proposed Type Required');
                        jQuery('#proposed_type_'+i+' input').focus();
                        return false;
                    }
                    if(jQuery.trim(jQuery('#account_no_'+i).val())=='')
                    {
                        alert('Account No Required');
                        jQuery('#account_no_'+i).focus();
                        return false;
                    }
                    // if(jQuery.trim(jQuery('#account_no_'+i).val()).length>16 || jQuery.trim(jQuery('#account_no_'+i).val()).length<16)
                    // {
                    //     alert('Account Must Be 16 Digits');
                    //     jQuery('#account_no_'+i).focus();
                    //     return false;
                    // }
                    if (!item)
                    {
                        alert('Case Type Required');
                        jQuery('#req_type_'+i+' input').focus();
                        return false;
                    }
                    if(jQuery.trim(jQuery('#ac_name_'+i).val())=='')
                    {
                        alert('AC Name Required');
                        jQuery('#ac_name_'+i).focus();
                        return false;
                    }
                    if(jQuery.trim(jQuery('#case_no_'+i).val())=='')
                    {
                        alert('Case No Required');
                        jQuery('#case_no_'+i).focus();
                        return false;
                    }
                    if(jQuery.trim(jQuery('#particulars_'+i).val())=='')
                    {
                        alert('particulars Required');
                        jQuery('#particulars_'+i).focus();
                        return false;
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
            if ((jQuery("#hidden_court_approval_file_select").val()=='0' && jQuery('#approval_select_add_edit').val()=='add') || (jQuery("#hidden_court_approval_file_select").val()=='0' && jQuery("#file_delete_value_court_approval_file").val()=='1' && jQuery('#approval_select_add_edit').val()=='edit')) 
            {
                alert('Please Upload Court Approval File');
                return false;
            }
            return true;
        }
    </script>
    <div id="container">
        <div id="body"  >
            <div id="loading-overlay">
                <div class="loading-icon"></div>
            </div>  
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('expenses/pages/left_side_nav',$operation_name); ?>
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
                                    <form class="form" name="court_entertainment" id="court_entertainment" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_id" value="" name="edit_id">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Employee Type<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="employee_type" name="employee_type" tabindex="1" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Staff Pin<span style="color:red">*</span> </td>
                                                                <td width="60%" ><strong><span id="staff_pin"></span></strong><!-- <input type="text" name="staff_pin" placeholder="" tabindex="2" style="width:250px;" id="staff_pin" value="" > --></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Employee Name<span style="color:red">*</span> </td>
                                                                <td width="60%" ><strong><span id="staff_name"></span></strong><!-- <input type="text" name="employee_name" placeholder="" tabindex="3" style="width:250px;" id="employee_name" value="" > --></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Job Grade<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input type="text" name="job_grade" placeholder="" tabindex="4" style="width:250px;" id="job_grade" value="" ></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Functional Designation<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="functional_desig" name="functional_desig" tabindex="5" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Mobile Number<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input type="text" name="mobile_no" placeholder="" tabindex="6" maxlength="11" size="11" style="width:250px;" id="mobile_no" value="" ></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Approval File<span style="color:red">*</span> </td>
                                                                <td width="60%" ><span id="court_approval_file"></span></td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display:contents;">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Billing Month<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="billing_month" name="billing_month" tabindex="7" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Account Number<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="account_number" type="text" class="" tabindex="8" maxlength="16" size="16" style="width:250px" id="account_number" value="" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Legal Region<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="legal_region" name="legal_region" tabindex="9" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">District<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="district" name="district" tabindex="10" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Base Office Name<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="base_office_name" type="text" tabindex="11" class="" style="width:250px" id="base_office_name" value="" /></td>
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
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Type<span style="color:red">*</span></td>
                                                                        <td width="13%" style="font-weight: bold;text-align:center">Account Number<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Type Of Case<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">A/C Name<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Case Number<span style="color:red">*</span></td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center">Particulars<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Activities Name<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Activities Date<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Amount<span style="color:red">*</span></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="expense_body">
                                                                    <tr id="expense_1">
                                                                            <td></td>
                                                                            <td>
                                                                                <div id="proposed_type_1" name="proposed_type_1" style="padding-left: 3px;margin-left:5px;width:90%" onchange="clear_ac(1)"></div>
                                                                            </td>
                                                                            <td>
                                                                                <input type="hidden" id="hidden_pre_org_ac_1" value="" name="hidden_pre_org_ac_1">
                                                                                <input type="hidden" id="hidden_loan_ac_1" value="" name="hidden_loan_ac_1">
                                                                                <input type="hidden" id="suit_id_1" value="" name="suit_id_1">
                                                                                <input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">
                                                                                <input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">
                                                                                <input name="account_no_1" type="text" class="" maxlength="16" size="16" style="width:98%" id="account_no_1" onKeyUp="javascript:return mask(this.value,this,1);"/>
                                                                            </td>
                                                                            <td>
                                                                                <div id="req_type_1" name="req_type_1" style="padding-left: 3px;margin-left:5px;width:90%" onchange="get_case_number(1)"></div>
                                                                            </td>
                                                                            <td>
                                                                                <input name="ac_name_1" type="text" class="" style="width:98%" id="ac_name_1" />
                                                                            </td>
                                                                            <td>
                                                                                <input name="case_no_1" type="text" class="" style="width:98%" id="case_no_1" />
                                                                            </td>
                                                                            <td><textarea name="particulars_1" class="text-input-big" id="particulars_1" style="height:40px !important;width:90%"></textarea></td>
                                                                            <td><div id="activities_name_1" name="activities_name_1" style="padding-left: 3px;margin-left:5px;width:90%" onchange=""></div></td>
                                                                            <td><input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" ><script type="text/javascript" charset="utf-8">datePicker ("activities_date_1");</script></td>
                                                                            <td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>
                                                                            
                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr id="add_guarantor_row">
                                                                        <td colspan="10" style="text-align: right">
                                                                            Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button" >
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
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                            href="<?=base_url()?>index.php/Expenses/bulk_operation/court_enter_apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;
                                    <strong>D = </strong> Delete,&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    <strong>TS = </strong>Top Sheet&nbsp;
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

    <div id="details" style="display:none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
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
            <div id="checker_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <!-- <input type="button" value="Send" id="sendtochecker" class="btn-small btn-small-normal enabledElem buttondelete" /> -->
                <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
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
            <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                <textarea name="comments" id="comments" style="width:370px;"></textarea>
                
                <br><br>
                <input type="button" class="buttondelete" id="delete_button" value="Delete">
                <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
                <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                
            </div>
            </form>
        </div>
    </div>
<?php endif ?>
<!-- For Paper Bill -->
<?php if ($operation=='paper_bill' && VIEWPAPER==1): ?>

    <script type="text/javascript">
            var theme = getDemoTheme();
            var acLength = <?php echo $acLength; ?>;
            var csrf_tokens='';
            var proposed_type = ["Loan", "Card"];
            var vendor_type = ["Vendor", "Staff"];
            var account_type = [
                {value:'1',label:'Before Case'},
                {value:'2',label:'After Case'},
            ];
            var expense_activities = [<? $i=1; foreach($expense_activities as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var paper_vendor = [<? $i=1; foreach($paper_vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var paper = [<? $i=1; foreach($paper as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var under_section = [<? $i=1; foreach($under_section as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var staff = [<? $i=1; foreach($staff as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'('.$row->pin.')'.'"}'; $i++;}?>];
            var case_number = [];
            jQuery(document).ready(function () {
            jQuery("#vendor_type_1").jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: vendor_type, height: 25});
            jQuery("#staff_1").jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Staff", source: staff, height: 25});
            jQuery("#paper_vendor_1").jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Vendor", source: paper_vendor, height: 25});
            jQuery("#paper_name_1").jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Paper", source: paper, height: 25});
            jQuery("#account_type").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Account Type", source: account_type, height: 25});
            jQuery("#case_number").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Case Number", source: case_number, height: 25});
            jQuery("#req_type").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Req Type", source: req_type, height: 25});
            jQuery("#under_section").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Under Section", source: under_section, height: 25});
            jQuery("#proposed_type").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Proposed Type", source: proposed_type, height: 25});
            //jQuery("#activities").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Expense Activities", source: expense_activities, width: 250, height: 25});
            jQuery('#proposed_type,#staff_1,#vendor_type_1,#paper_vendor_1,#paper_name_1,#case_number,#under_section,#account_type,#activities,#req_type').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
            jQuery("#vendor_type_1").jqxComboBox('val','Vendor');
            jQuery("#staff_1").jqxComboBox('val','<?=$this->session->userdata['ast_user']['user_id']?>');
            jQuery("#proposed_type").jqxComboBox('val','Loan');
            jQuery("#account_type").jqxComboBox('val',2);
            change_caption();
            jQuery('#proposed_type').bind('change', function (event) {
                jQuery("#loan_ac").val('');
                jQuery("#hidden_loan_ac").val('');
                change_caption();       
            });
            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'proposed_type', type: 'string'},
                        { name: 'loan_ac', type: 'string'},
                        { name: 'ac_name', type: 'string'},
                        { name: 'district_name', type: 'string'},
                        { name: 'case_number', type: 'string'},
                        { name: 'under_section_name', type: 'string'},
                        { name: 'paper_expense_approval_file', type: 'string'},
                        { name: 'v_sts', type: 'int'},
                        { name: 'verifier_group_id', type: 'int'},
                        { name: 'status', type: 'string'},
                        { name: 'e_by', type: 'string'},
                        { name: 'e_dt', type: 'string'},
                        { name: 'v_by', type: 'string'},
                        { name: 'v_dt', type: 'string'},
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
                    url: '<?=base_url()?>index.php/expenses/paper_grid',
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
                var win_h=jQuery( window ).height()-240;
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
                        <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                        <?php } ?>
                        <?php if(EDIT==1){ ?>
                        { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if( dataRecord.v_sts == 35 || dataRecord.v_sts == 39 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }
                            else if(dataRecord.v_sts == 37){
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
                                if((check_group_javascript(dataRecord.verifier_group_id)==true || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.v_sts == 37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.v_sts == 38){
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
                        { text: 'Proposed Type', datafield: 'proposed_type',editable: false, width: '10%'},
                        { text: 'Loan AC', datafield: 'loan_ac',editable: false, width: '15%'},
                        { text: 'Account Name', datafield: 'ac_name',editable: false, width: '15%'},
                        { text: 'District', datafield: 'district_name',editable: false, width: '15%'},
                        { text: 'Under Section', datafield: 'under_section_name',editable: false, width: '15%'},
                        { text: 'Case Number', datafield: 'case_number',editable: false, width: '15%'},
                        { text: 'Entry By', datafield: 'e_by',editable: false, width: '15%'},
                        { text: 'Entry Date', datafield: 'e_dt',editable: false, width: '15%'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '15%'},
                        { text: 'Verify Date', datafield: 'v_dt',editable: false, width: '15%'},
                        
                    ],
                            
                });
                    
                jQuery("#details").jqxWindow({theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:450, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verify_cancel") });
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
                jQuery('#paper_form').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            rules= [
                { input: '#proposed_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='proposed_type']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#proposed_type input").focus();
                                return false;
                            }
                    }
                },
                { input: '#req_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='req_type']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#req_type input").focus();
                                return false;
                            }
                    }
                },
                { input: '#account_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#account_type").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='account_type']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#account_type input").focus();
                                return false;
                            }
                    }
                },
                { input: '#under_section', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#under_section").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='under_section']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#under_section input").focus();
                                return false;
                            }
                    }
                },
                { input: '#case_number', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                        {
                            var item = jQuery("#case_number").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='case_number']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#case_number input").focus();
                            return false;
                        }
                        
                    }
                }
            ];
            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#paper_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true) {
                        show_confrimation_pop_up('Save');
                    }
                }
                jQuery('#paper_form').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#paper_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true) {
                        show_confrimation_pop_up('Update');
                    }
                }
                jQuery('#paper_form').jqxValidator('validate', validationResult);        
            });
            // Delete Form Validation 
            jQuery('#delete_convence').jqxValidator({
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
            // Delete Ajax call
            jQuery("#delete_button").click(function () {
                
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#delete_button").hide();
                        jQuery("#deletecancel").hide();
                        jQuery("#delete_loading").show();
                        delete_submit();
                    }
                }
                jQuery('#delete_convence').jqxValidator('validate', validationResult);
             });

            // Send to checaker Ajax Call
            jQuery("#sendtochecker").click(function () {
                    if(jQuery("#paper_scan_copy_sts").val()=='0')
                    {
                        alert('Please Upload Appoval Copy for every bill!!');
                        return false;
                    }

                    jQuery("#sendtochecker").hide();
                    jQuery("#SendTocheckercancel").hide();
                    jQuery("#checker_loading").show();
                    delete_submit();
             });
            jQuery("#approve").click( function() {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
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
                    delete_submit();
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
                    delete_submit();
                }
             });

            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_scan_copy_1\')"/>';
            html+='<input type="hidden" id="hidden_paper_scan_copy_1_select" name="hidden_paper_scan_copy_1_select" value="0">';
            html+='<span id="hidden_paper_scan_copy_1"></span><input type="hidden" id="scan_copy_select_add_edit_1" name="scan_copy_select_add_edit_1" value="add">';
            jQuery('#paper_scan_copy_1').html(html);

            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_expense_approval_file_1\')"/>';
            html+='<input type="hidden" id="hidden_paper_expense_approval_file_1_select" name="hidden_paper_expense_approval_file_1_select" value="0">';
            html+='<span id="hidden_paper_expense_approval_file_1"></span><input type="hidden" id="paper_expense_approval_file_select_add_edit_1" name="paper_expense_approval_file_select_add_edit_1" value="add">';
            jQuery('#paper_expense_approval_file_1').html(html);
        });
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
        function expense_validation()
        {
            var counter = jQuery('#expense_counter').val();
            var vendor_array = [];
            for (i=1;i<=counter;i++) 
            {
                if(jQuery('#expense_delete_'+i).val()==0) 
                {
                    var item = jQuery("#paper_vendor_"+i).jqxComboBox('getSelectedItem');
                    var item2 = jQuery("#paper_name_"+i).jqxComboBox('getSelectedItem');
                    var item3 = jQuery("#vendor_type_"+i).jqxComboBox('getSelectedItem');
                    var item4 = jQuery("#staff_"+i).jqxComboBox('getSelectedItem');
                    if(!item3)
                    {
                        alert('Vendor Type Required');
                        jQuery('#vendor_type_'+i+' input').focus();
                        return false;
                    }
                    if (!item && item3.value=='Vendor')
                    {
                        alert('Vendor Required');
                        jQuery('#paper_vendor_'+i+' input').focus();
                        return false;
                    }
                    if (!item4 && item3.value=='Staff')
                    {
                        alert('Staff Required');
                        jQuery('#staff_'+i+' input').focus();
                        return false;
                    }
                    if(jQuery.trim(jQuery('#account_no_'+i).val())=='')
                    {
                        alert('Bank Account No Required');
                        jQuery('#account_no_'+i).focus();
                        return false;
                    }
                    
                    if (!item2)
                    {
                        alert('Paper Required');
                        jQuery('#paper_name_'+i+' input').focus();
                        return false;
                    }
                    if(jQuery.trim(jQuery('#publication_date_'+i).val())=='')
                    {
                        alert('publication date Required');
                        jQuery('#publication_date_'+i).focus();
                        return false;
                    }
                    if ((jQuery('#hidden_paper_scan_copy_'+i+'_select').val()=='0' && jQuery('#scan_copy_select_add_edit_'+i).val()=='add') || (jQuery('#hidden_paper_scan_copy_'+i+'_select').val()=='0' && jQuery('#file_delete_value_paper_scan_copy_'+i).val()=='1' && jQuery('#scan_copy_select_add_edit_'+i).val()=='edit')) 
                    {
                        alert('Please Upload Paper Scan Copy');
                        return false;
                    }
                    // if ((jQuery('#hidden_paper_expense_approval_file_'+i+'_select').val()=='0' && jQuery('#paper_expense_approval_file_select_add_edit_'+i).val()=='add') || (jQuery('#hidden_paper_expense_approval_file_'+i+'_select').val()=='0' && jQuery('#file_delete_value_paper_expense_approval_file_'+i).val()=='1' && jQuery('#paper_expense_approval_file_select_add_edit_'+i).val()=='edit')) 
                    // {
                    //     alert('Please Upload Approval Copy');
                    //     return false;
                    // }
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
                    var data = item2.value+'##'+jQuery('#publication_date_'+i).val();
                    if(vendor_array.includes(data))
                    {
                        alert('Duplicate Paper Bill');
                        jQuery('#paper_name_'+i+' input').focus();
                        return false;
                    }
                    else
                    {
                        vendor_array.push(data);
                    }
                    if(check_duplicate_bill(item2.value,jQuery('#publication_date_'+i).val(),jQuery("#expense_edit_"+i).val())==0)
                    {
                        alert('Duplicate Paper Bill');
                        jQuery('#paper_name_'+i+' input').focus();
                        return false;
                    }
                    
                }
            }
            
            return true;
        }
        function check_duplicate_bill(paper,date,edit_id)
        {
            var check = 1;
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var item = jQuery("#account_type").jqxComboBox('getSelectedItem');
            var add_edit = jQuery('#add_edit').val();
            if(item!=null)
            {
                var account_type = item.value;
            }
            else
            {
                var account_type = 0;
            }
            var item2 = jQuery("#case_number").jqxComboBox('getSelectedItem');
            if(item2!=null)
            {
                var case_number = item2.value;
            }
            else
            {
                var case_number = 0;
            }
            var cma_id = jQuery("#hidden_cma_id").val();
            var suit_id = jQuery("#hidden_suit_id").val();
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>expenses/check_duplication_paper_bill",
                data : {[csrfName]: csrfHash,paper:paper,add_edit:add_edit,edit_id:edit_id,case_number:case_number,date:date,account_type:account_type,cma_id:cma_id,suit_id:suit_id},
                datatype: "json",
                success: function(response){
                //alert(response);
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json['csrf_token']);
                    if(json.success==1)
                    {
                        check = 1;
                    }
                    else
                    {
                        check = 0;
                    }
                }
            });
            return check;
        }
        function call_ajax_submit(){
            $('sendToCheckerMessageDialogConfirm').style.display = 'none';
            $('sendToCheckerMessageDialogCancel').style.display = 'none';
            $('loadingReturn').style.display = 'inline';
            var postdata = jQuery('#paper_form').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_id").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/add_edit_paper/"+add_edit+"/"+edit_row,
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
                        // if(add_edit=='edit'){
                        //     jQuery("#in_up_loading").hide();
                        //     jQuery("#in_up_button").show();
                        //     jQuery('#jqxTabs').jqxTabs('select', 1);
                            
                        // }else{
                        //     jQuery("#in_req_button").show();
                        //     jQuery("#in_req_loading").hide();
                        // }
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
                    $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                    $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                    $('loadingReturn').style.display = 'none';
                    close_window();
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
        function delete_submit(){
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
            //console.log(postData);
            //return false
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/expenses/delete_action_paper/',
                data : postData,
                datatype: "json",
                success: function(response){
                    //console.log(response);
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
                        }
                        var msz='';
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                                
                    }
                }
            });
        }
        function edit(id,editrow){
            
            var val=id;
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/get_edit_info_paper",
                data : {[csrfName]: csrfHash,id:val},
                datatype: "json",
                async:false,
                success: function(response){
                   
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.Message=='ok'){
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_expense_approval_file_1\')"/>';
                        html+='<input type="hidden" id="hidden_paper_expense_approval_file_1_select" name="hidden_paper_expense_approval_file_1_select" value="0">';
                        html+='<span id="hidden_paper_expense_approval_file_1"></span><input type="hidden" id="paper_expense_approval_file_select_add_edit_1" name="paper_expense_approval_file_select_add_edit_1" value="add">';
                        jQuery('#paper_expense_approval_file_1').html(html);

                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_scan_copy_1\')"/>';
                        html+='<input type="hidden" id="hidden_paper_scan_copy_1_select" name="hidden_paper_scan_copy_1_select" value="0">';
                        html+='<span id="hidden_paper_scan_copy_1"></span><input type="hidden" id="scan_copy_select_add_edit_1" name="scan_copy_select_add_edit_1" value="add">';
                        jQuery('#paper_scan_copy_1').html(html);

                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery('#add_edit').val('edit');
                        jQuery("#add_button").hide();
                        jQuery("#up_button").show();
                        jQuery('#req_type').jqxComboBox('val', json.row_info.req_type);
                        jQuery('#proposed_type').jqxComboBox('val', json.row_info.proposed_type);
                        jQuery('#account_type').jqxComboBox('val', json.row_info.account_type);
                        jQuery('#under_section').jqxComboBox('val', json.row_info.under_section);
                        jQuery('#account_type').jqxComboBox({ disabled: true });
                        jQuery('#proposed_type').jqxComboBox({ disabled: true });
                        jQuery('#req_type').jqxComboBox({ disabled: true });
                        if(json.row_info.account_type==2)
                        {
                            var case_number = [
                                {value:json.row_info.suit_id,label:json.row_info.case_number},
                            ];
                            jQuery("#case_number").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Case Number", source: case_number, width: 250, height: 25});
                            jQuery('#case_number').jqxComboBox('val', json.row_info.suit_id);
                        }
                        else
                        {
                            var case_number = [
                                {value:json.row_info.case_number,label:json.row_info.case_number},
                            ];
                            jQuery("#case_number").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Case Number", source: case_number, width: 250, height: 25});
                            jQuery('#case_number').jqxComboBox('val', json.row_info.case_number);
                        }
                        
                        
                        jQuery('#case_number').jqxComboBox({ disabled: true });
                        jQuery("#hidden_cma_id").val(json.row_info.cma_id);
                        jQuery("#show_loan").html(json.row_info.loan_ac);
                        jQuery("#loan_ac").val(json.row_info.loan_ac);
                        jQuery("#remarks").val(json.row_info.remarks);
                        jQuery("#district_show").html(json.row_info.district_name);
                        jQuery("#show_ac_name").html(json.row_info.ac_name);
                        jQuery("#hidden_ac_name").val(json.row_info.ac_name);
                        jQuery("#hidden_district_id").val(json.row_info.district);
                        jQuery("#ac_td").hide();
                        jQuery("#show_td").show();
                        jQuery("#edit_id").val(json.row_info.id);
                        
                        jQuery('#expense_counter').val('0');
                        jQuery('#expense_body').html('');
                        jQuery("#edit_id").val(json.row_info.id);
                        var i=0;
                        jQuery.each(json['expense'],function(key,obj){
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
                                html_string += '<td>';
                                html_string += '<div id="vendor_type_'+new_counter+'" name="vendor_type_'+new_counter+'" onchange="change_vendor_type('+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%"></div>';
                                html_string += '<div id="paper_vendor_'+new_counter+'" name="paper_vendor_'+new_counter+'" onchange="get_vendor_info(\'paper\','+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%"></div>';
                                html_string += '<div id="staff_'+new_counter+'" name="staff_'+new_counter+'" onchange="get_vendor_info(\'staff\','+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%;display:none"></div>';
                                html_string += '</td>';
                                html_string += '<td><input name="account_no_'+new_counter+'" type="text" class="" maxlength="16" size="16" style="width:98%" id="account_no_'+new_counter+'"  value="" /></td>';
                                html_string += '<td><input name="tin_'+new_counter+'" type="text" class="" style="width:98%" id="tin_'+new_counter+'" value=""/></td>';
                                html_string += '<td><input name="bin_'+new_counter+'" type="text" class="" style="width:98%" id="bin_'+new_counter+'" value=""/></td>';
                                html_string += '<td><input name="mousak_'+new_counter+'" type="text" class="" style="width:98%" id="mousak_'+new_counter+'" value=""/></td>';
                                html_string +='<td><div id="paper_name_'+new_counter+'" name="paper_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%"></div></td>';
                                html_string += '<td><input type="text" name="publication_date_'+new_counter+'" placeholder="dd/mm/yyyy" style="width:98%;" id="publication_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" ></td>';
                                html_string += '<td style="text-align:center"><span id="paper_scan_copy_'+new_counter+'"></span></td>';
                                html_string += '<td style="text-align:center"><span id="paper_expense_approval_file_'+new_counter+'"></span></td>';
                                html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="'+obj.amount+'" ></td>';
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
                            jQuery('#paper_vendor_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Vendor", source: paper_vendor, height: 25});
                            jQuery('#paper_name_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Paper", source: paper, height: 25});
                            jQuery('#paper_name_'+new_counter).jqxComboBox('val', obj.paper_name);
                            jQuery('#vendor_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: vendor_type, height: 25});
                            jQuery('#staff_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Staff", source: staff, height: 25});
                            jQuery("#vendor_type_"+new_counter).jqxComboBox('val',obj.vendor_type);
                            if(obj.vendor_type=='Vendor')
                            {
                                jQuery('#paper_vendor_'+new_counter).jqxComboBox('val', obj.vendor_id);
                            }
                            else
                            {
                                jQuery("#staff_"+new_counter).jqxComboBox('val',obj.vendor_id);
                            }
                            jQuery("#account_no_"+new_counter).val(obj.account_no);
                            jQuery("#tin_"+new_counter).val(obj.tin);
                            jQuery("#bin_"+new_counter).val(obj.bin);
                            jQuery("#mousak_"+new_counter).val(obj.mousak);
                            jQuery('#staff_'+new_counter).focusout(function() {
                                        commbobox_check(jQuery(this).attr('id'));
                            });

                            jQuery('#vendor_type_'+new_counter).focusout(function() {
                                        commbobox_check(jQuery(this).attr('id'));
                            });
                            jQuery('#paper_vendor_'+new_counter).focusout(function() {
                                        commbobox_check(jQuery(this).attr('id'));
                            });
                            jQuery('#paper_name_'+new_counter).focusout(function() {
                                        commbobox_check(jQuery(this).attr('id'));
                            });
                            datePicker('publication_date_'+new_counter);
                            var paper_scan_copy = obj.paper_scan_copy;
                            var file_html = '';
                            file_html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_scan_copy_'+new_counter+'\')"/>';
                            file_html+='<input type="hidden" id="hidden_paper_scan_copy_'+new_counter+'_select" name="hidden_paper_scan_copy_'+new_counter+'_select" value="0">';
                            if(paper_scan_copy!='' && paper_scan_copy!=null)
                            {
                                file_html +='<span id="hidden_paper_scan_copy_'+new_counter+'"><img id="file_preview_paper_scan_copy_'+new_counter+'" onclick="popup(\'<?=base_url()?>cma_file/paper_scan_copy/'+paper_scan_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                                file_html +='<input type="hidden" id="hidden_paper_scan_copy_'+new_counter+'_value" name="hidden_paper_scan_copy_'+new_counter+'_value" value="'+paper_scan_copy+'">';
                                file_html +='<img id="file_delete_paper_scan_copy_'+new_counter+'" onclick="file_delete(\'paper_scan_copy_'+new_counter+'\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                                file_html +='<input type="hidden" id="file_delete_value_paper_scan_copy_'+new_counter+'" name="file_delete_value_paper_scan_copy_'+new_counter+'" value="0">';
                                file_html+='<span id="hidden_paper_scan_copy_'+new_counter+'"></span><input type="hidden" id="scan_copy_select_add_edit_'+new_counter+'" name="scan_copy_select_add_edit_'+new_counter+'" value="edit">';
                            }
                            else
                            {
                                file_html+='<span id="hidden_paper_scan_copy_'+new_counter+'"></span><input type="hidden" id="scan_copy_select_add_edit_'+new_counter+'" name="scan_copy_select_add_edit_'+new_counter+'" value="add">';
                            }
                            jQuery('#paper_scan_copy_'+new_counter).html(file_html);

                            var paper_expense_approval_file = obj.paper_expense_approval_file;
                            var file_html = '';
                            file_html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_expense_approval_file_'+new_counter+'\')"/>';
                            file_html+='<input type="hidden" id="hidden_paper_expense_approval_file_'+new_counter+'_select" name="hidden_paper_expense_approval_file_'+new_counter+'_select" value="0">';
                            if(paper_expense_approval_file!='' && paper_expense_approval_file!=null)
                            {
                                file_html +='<span id="hidden_paper_expense_approval_file_'+new_counter+'"><img id="file_preview_paper_expense_approval_file_'+new_counter+'" onclick="popup(\'<?=base_url()?>cma_file/paper_expense_approval_file/'+paper_expense_approval_file+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                                file_html +='<input type="hidden" id="hidden_paper_expense_approval_file_'+new_counter+'_value" name="hidden_paper_expense_approval_file_'+new_counter+'_value" value="'+paper_expense_approval_file+'">';
                                file_html +='<img id="file_delete_paper_expense_approval_file_'+new_counter+'" onclick="file_delete(\'paper_expense_approval_file_'+new_counter+'\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                                file_html +='<input type="hidden" id="file_delete_value_paper_expense_approval_file_'+new_counter+'" name="file_delete_value_paper_expense_approval_file_'+new_counter+'" value="0">';
                                file_html+='<span id="hidden_paper_expense_approval_file_'+new_counter+'"></span><input type="hidden" id="paper_expense_approval_file_select_add_edit_'+new_counter+'" name="paper_expense_approval_file_select_add_edit_'+new_counter+'" value="edit">';
                            }
                            else
                            {
                                file_html+='<span id="hidden_paper_expense_approval_file_'+new_counter+'"></span><input type="hidden" id="paper_expense_approval_file_select_add_edit_'+new_counter+'" name="paper_expense_approval_file_select_add_edit_'+new_counter+'" value="add">';
                            }
                            jQuery('#paper_expense_approval_file_'+new_counter).html(file_html);

                            //Pre publication data
                            if(json.row_info.pre_pub_dt!='' && json.row_info.pre_pub_dt!=null)
                            {
                                jQuery("#hidden_pre_pub_dt").val(json.row_info.pre_pub_dt);
                                jQuery("#pre_paper_date").html(json.row_info.pre_pub_dt_show);
                            }
                            else
                            {
                                jQuery("#hidden_pre_pub_dt").val('');
                                jQuery("#pre_paper_date").html('-----');
                            }
                            if(json.row_info.pre_pub_paper_name!='' && json.row_info.pre_pub_paper_name!=null)
                            {
                                jQuery("#hidden_pre_paper_id").val(json.row_info.pre_pub_paper_name);
                                jQuery("#pre_paper_name").html(json.row_info.paper_name);
                            }
                            else
                            {
                                jQuery("#hidden_pre_paper_id").val('');
                                jQuery("#pre_paper_name").html('-----');
                            }
                            if(json.row_info.pre_pub_copy!='' && json.row_info.pre_pub_copy!=null)
                            {
                                jQuery("#hidden_pre_pub_file").val(json.row_info.pre_pub_copy);
                                var html = '';
                                html +='<img id="" onclick="popup(\'<?=base_url()?>cma_file/paper_scan_copy/'+json.row_info.pre_pub_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                                jQuery('#pre_publication_copy').html(html);
                            }
                            else
                            {
                                jQuery('#pre_publication_copy').html('-----');
                            }
                        });
                        

                    }else{
                        alert("No Data Found");
                        jQuery('#add_edit').val('');
                    }
                }
            });
            
        }
        function clear_form(){
            re_load();
            jQuery("#proposed_type").jqxComboBox('val','Loan');
            jQuery("#account_type").jqxComboBox('val',2);
            jQuery("#hidden_loan_ac").val('');
            jQuery("#req_type").jqxComboBox('clearSelection');
            jQuery("input[name='req_type']").val('');
            jQuery("#loan_ac").val('');
            jQuery("#remarks").val('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show();
            jQuery("#load_row").show();
            jQuery("#loan_row").show();
            jQuery("#req_row").show();
            reset_expense();
            
        }

        function change_caption()
        {   
            if (jQuery("#proposed_type").val()=='') 
            {
                document.getElementById("loan_ac").disabled = true;
                jQuery("#l_or_c_no").html('Loan/Card');
                jQuery("#int_rate_tr").show();
            }
            else
            {
                document.getElementById("loan_ac").disabled = false;
                var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                if (item.value=='Loan') {
                    jQuery("#l_or_c_no").html('Loan A/C ');
                    jQuery("#int_rate_tr").show();
                }
                else if(item.value=='Card'){
                    jQuery("#l_or_c_no").html('Card');
                    jQuery("#int_rate_tr").hide();
                }
            }
            
        }
        function details (id,editrow,operation) {
            jQuery("#return_reason_verify").val('');
            jQuery("#paper_scan_copy_sts").val('1');
            jQuery("#return_row").hide();
            if(operation=='delete'){
                jQuery('#comments').val('');
                jQuery("#verifyid").val('');
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#delete_row").show();
                jQuery("#type").val('delete');
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val(id);
            }else if(operation=='sendtochecker'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verify_row").hide();
                jQuery("#verifyid").val(id);
            }else if(operation=='verify'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#verifyid").val(id);
            }else{
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
            }

            //console.log(dataRecord);
            jQuery("#r_heading").html('Expenses');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>expenses/paper_bill_details",
                data: { [csrfName]: csrfHash,id : id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.str)
                        {
                            document.getElementById("details").style.visibility='visible';
                            jQuery("#details_body").html(json['str']);
                            if(operation=='sendtochecker')
                            {
                                jQuery("#paper_scan_copy_sts").val(json['paper_scan_copy_sts']);
                            }
                            jQuery("#details").jqxWindow('open');
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
            // jQuery("#p_vendor").html(dataRecord['vendor_name']);
            // jQuery("#p_act_name").html(dataRecord['act_name']);
            // jQuery("#p_act_date").html(dataRecord['a_dt']);
            // jQuery("#p_amount").html(dataRecord['amount']);
            // jQuery("#p_remarks").html(dataRecord['remarks']);

            //document.getElementById("details").style.display='block';
            //jQuery("#details").jqxWindow('open');
        }
        function validate_call()
        {
            jQuery('#paper_form').jqxValidator('hide');
            var theme = getDemoTheme();
            var  rules= [];
            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
            if(item==null)
            {
                rules.push(
                    { input: '#account_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#account_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='account_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#account_type input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#proposed_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='proposed_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#proposed_type input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#req_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='req_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#req_type input").focus();
                            return false;
                        }
                    }  
                    }
                );
            }
            else
            {
                if (item.value=='Loan') 
            {
                rules.push(
                    { input: '#account_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#account_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='account_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#account_type input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#proposed_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='proposed_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#proposed_type input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#req_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='req_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#req_type input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#loan_ac', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#loan_ac").val()=='')
                        {
                            jQuery("#loan_ac").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                    },
                    { input: '#loan_ac', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(!checknumber_alphabaticwithstar('loan_ac'))
                            {
                                jQuery("#loan_ac").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
                    {
                        input: '#loan_ac',
                        message: 'must be ' + acLength.join(" or ") + " Digits",
                        action: 'keyup, blur, change',
                        rule: function(input, commit) {
                            if (input.val() != '') {

                                if (jQuery.inArray(String(input.val().length), acLength) != -1) {
                                    return true;
                                } else {
                                    return false;
                                }



                            }
                            return true;

                        }
                    },
                );
            }
            else
            {
                rules.push(
                    { input: '#account_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#account_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='account_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#account_type input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#proposed_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                            if(input.val() != '')
                            {
                                var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='proposed_type']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#proposed_type input").focus();
                                return false;
                            }
                        }  
                        },
                        { input: '#req_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                            if(input.val() != '')
                            {
                                var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='req_type']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#req_type input").focus();
                                return false;
                            }
                        }  
                        },
                        { input: '#loan_ac', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                            if(jQuery("#loan_ac").val()=='')
                            {
                                jQuery("#loan_ac").focus();
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                            
                        }
                        },
                        { input: '#loan_ac', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                         {
                            if(input.val() != '')
                            {
                                if(!checknumber_alphabaticwithstar('loan_ac'))
                                {
                                    jQuery("#loan_ac").focus();
                                    return false;

                                }
                            }
                            return true;

                        } },
                        {
                            input: '#loan_ac',
                            message: 'must be ' + acLength.join(" or ") + " Digits",
                            action: 'keyup, blur, change',
                            rule: function(input, commit) {
                                if (input.val() != '') {

                                    if (jQuery.inArray(String(input.val().length), acLength) != -1) {
                                        return true;
                                    } else {
                                        return false;
                                    }



                                }
                                return true;

                            }
                        },
                 );
                }
            }
            jQuery('#paper_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        load_data();
                    }
                }
                jQuery('#paper_form').jqxValidator('validate', validationResult);
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
        function load_data()
        {
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = $('paper_form').toQueryString();
            var account_type = jQuery("#account_type").jqxComboBox('getSelectedItem');
            jQuery("#show_loan").html('');
            jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/Expenses/get_loan_data_paper',
            async:false,
            type: "post",
            data: postData,
            datatype: "json",
            beforeSend: function(){
                jQuery("#loading-overlay").show();
            },
            success: function(response){
                jQuery("#loading-overlay").hide();
                var json = jQuery.parseJSON(response);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str='';
                        var theme = getDemoTheme();
                        if(json.Message=='ok')
                        {
                            jQuery('#account_type').jqxComboBox({ disabled: true });
                            jQuery('#proposed_type').jqxComboBox({ disabled: true });
                            jQuery('#req_type').jqxComboBox({ disabled: true });
                            if(account_type.value==1)
                            {
                                var case_number = [
                                    {value:'Auction-12(3)',label:'Auction-12(3)'},
                                ];
                                jQuery("#case_number").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Case Number", source: case_number, width: 250, height: 25});
                                jQuery("#hidden_cma_id").val(json['row'][0].id);
                                jQuery("#show_loan").html(json['row'][0].loan_ac);
                                jQuery("#district_show").html(json['row'][0].district_name);
                                jQuery("#show_ac_name").html(json['row'][0].ac_name);
                                jQuery("#hidden_ac_name").val(json['row'][0].ac_name);
                                jQuery("#hidden_district_id").val(json['row'][0].district);
                                jQuery("#ac_td").hide();
                                jQuery("#show_td").show();
                                
                            }
                            else
                            {
                                var case_number = [];
                                jQuery.each(json['row'],function(key,obj){
                                    case_number.push({ value: obj.id, label: obj.case_number });
                                    //alert(obj.name);
                                });
                                jQuery("#case_number").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Case Number", source: case_number, width: 250, height: 25});
                                jQuery("#hidden_suit_id").val(json['row'][0].id);
                                jQuery("#show_loan").html(json['row'][0].loan_ac);
                                jQuery("#district_show").html(json['row'][0].district_name);
                                jQuery("#show_ac_name").html(json['row'][0].ac_name);
                                jQuery("#hidden_ac_name").val(json['row'][0].ac_name);
                                jQuery("#hidden_district_id").val(json['row'][0].district);
                                jQuery("#ac_td").hide();
                                jQuery("#show_td").show();
                            }
                            if(json.pre_pub_dt_org!='')
                            {
                                jQuery("#hidden_pre_pub_dt").val(json.pre_pub_dt_org);
                                jQuery("#pre_paper_date").html(json.pre_pub_date);
                                jQuery("#hidden_pre_pub_id").val(json.pre_pub_id);
                                
                            }
                            else
                            {
                                jQuery("#hidden_pre_pub_dt").val('');
                                jQuery("#pre_paper_date").html('-----');
                                jQuery("#hidden_pre_pub_id").val('');
                            }
                            if(json.paper_name!='')
                            {
                                jQuery("#hidden_pre_paper_id").val(json.paper_id);
                                jQuery("#pre_paper_name").html(json.paper_name);
                            }
                            else
                            {
                                jQuery("#hidden_pre_paper_id").val('');
                                jQuery("#pre_paper_name").html('-----');
                            }
                            if(json.paper_scan_copy!='')
                            {
                                jQuery("#hidden_pre_pub_file").val(json.paper_scan_copy);
                                var html = '';
                                html +='<img id="" onclick="popup(\'<?=base_url()?>cma_file/paper_scan_copy/'+json.paper_scan_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                                jQuery('#pre_publication_copy').html(html);
                            }
                            else
                            {
                                jQuery('#pre_publication_copy').html('-----');
                            }
                        }
                        else
                        {
                            alert(json.Message);
                            jQuery("#hidden_pre_pub_id").val('');
                            jQuery("#loan_ac").val('');
                            jQuery("#hidden_loan_ac").val('');
                            jQuery("#case_no").val('');
                            jQuery("#hidden_cma_id").val('');
                            jQuery("#hidden_suit_id").val('');
                            jQuery("#show_loan").html('');
                            jQuery("#show_ac_name").html('-----');
                            jQuery("#district_show").html('-----');
                            jQuery("#hidden_district_id").val('');
                            jQuery("#hidden_pre_pub_dt").val('');
                            jQuery("#pre_paper_date").html('-----');
                            jQuery("#hidden_pre_paper_id").val('');
                            jQuery("#pre_paper_name").html('-----');
                            jQuery('#pre_publication_copy').html('-----');
                        }

                },
                error:   function(model, xhr, options){
                    alert('failed');
                },
                });
        }
        function get_vendor_info(type,counter)
        {
            if(type=='paper')
            {
                var item = jQuery("#paper_vendor_"+counter).jqxComboBox('getSelectedItem');
                if(item==null)
                {
                    return false;
                }
                else
                {
                    var vendor_id = item.value;
                }
            }
            else
            {
                var item = jQuery("#staff_"+counter).jqxComboBox('getSelectedItem');
                if(item==null)
                {
                    return false;
                }
                else
                {
                    var vendor_id = item.value;
                }
            }
            
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>expenses/get_vendor_info",
                data : {[csrfName]: csrfHash,id: vendor_id,type:type},
                datatype: "json",
                success: function(response){
                //alert(response);
                    var json = jQuery.parseJSON(response);

                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json['row_info'])
                        {
                            if (json['row_info'].length != 0)
                            {
                                jQuery("#account_no_"+counter).val(json['row_info']['ac']);
                                jQuery("#tin_"+counter).val(json['row_info']['tin']);
                                jQuery("#bin_"+counter).val(json['row_info']['bin']);
                            }
                            
                        }
                        else {
                            alert("Something went wrong, please refresh the page.")
                        }

                }
            });
        }
        function re_load()
        {
            jQuery("#hidden_pre_pub_id").val('');
            jQuery("#hidden_pre_pub_dt").val('');
            jQuery("#pre_paper_date").html('-----');
            jQuery("#hidden_pre_paper_id").val('');
            jQuery("#pre_paper_name").html('-----');
            jQuery('#pre_publication_copy').html('-----');
            var case_number = [];
            jQuery("#case_number").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Case Number", source: case_number, width: 250, height: 25});
            jQuery('#account_type').jqxComboBox({ disabled: false });
            jQuery('#proposed_type').jqxComboBox({ disabled: false });
            jQuery('#req_type').jqxComboBox({ disabled: false });
            jQuery('#case_number').jqxComboBox({ disabled: false });
            jQuery("#ac_td").show();
            jQuery("#show_td").hide();
            jQuery("#show_loan").html('');
            jQuery("#show_ac_name").html('-----');
            jQuery("#district_show").html('-----');
            jQuery("#loan_ac").val('');
            jQuery("#hidden_loan_ac").val('');
            jQuery("#hidden_cma_id").val('');
            jQuery("#hidden_suit_id").val('');
            jQuery("#hidden_ac_name").val('');
            jQuery("#hidden_district_id").val('');
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
        function reset_expense()
        {
            jQuery('#expense_body').html('');
            jQuery('#expense_counter').val(0);
            var theme = getDemoTheme();
            var counter = jQuery('#expense_counter').val();
            var new_counter = parseInt(counter) + 1;
            html_string = '';

                html_string += '<tr id="expense_'+new_counter+'">';
                html_string += '<td>';
                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                html_string += '</td>';
                html_string += '<td>';
                html_string += '<div id="vendor_type_'+new_counter+'" name="vendor_type_'+new_counter+'" onchange="change_vendor_type('+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%"></div>';
                html_string += '<div id="paper_vendor_'+new_counter+'" name="paper_vendor_'+new_counter+'" onchange="get_vendor_info(\'paper\','+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%"></div>';
                html_string += '<div id="staff_'+new_counter+'" name="staff_'+new_counter+'" onchange="get_vendor_info(\'staff\','+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%;display:none"></div>';
                html_string += '</td>';
                html_string += '<td><input name="account_no_'+new_counter+'" type="text" class="" maxlength="16" size="16" style="width:98%" id="account_no_'+new_counter+'"/></td>';
                html_string += '<td><input name="tin_'+new_counter+'" type="text" class="" style="width:98%" id="tin_'+new_counter+'"/></td>';
                html_string += '<td><input name="bin_'+new_counter+'" type="text" class="" style="width:98%" id="bin_'+new_counter+'"/></td>';
                html_string += '<td><input name="mousak_'+new_counter+'" type="text" class="" style="width:98%" id="mousak_'+new_counter+'"/></td>';
                html_string +='<td><div id="paper_name_'+new_counter+'" name="paper_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%"></div></td>';
                html_string += '<td><input type="text" name="publication_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="publication_date_'+new_counter+'" value="" ></td>';
                html_string += '<td style="text-align:center"><span id="paper_scan_copy_'+new_counter+'"></span></td>';
                html_string += '<td style="text-align:center"><span id="paper_expense_approval_file_'+new_counter+'"></span></td>';
                html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
                html_string += '</tr>';

            jQuery('#expense_body').html(html_string);
            jQuery('#expense_counter').val(new_counter);
            jQuery('#paper_vendor_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Vendor", source: paper_vendor, height: 25});
            jQuery('#vendor_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: vendor_type, height: 25});
            jQuery('#staff_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Staff", source: staff, height: 25});
            jQuery('#paper_name_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Paper", source: paper, height: 25});
            jQuery('#paper_vendor_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery("#staff_"+new_counter).jqxComboBox('val','<?=$this->session->userdata['ast_user']['user_id']?>');
            jQuery("#vendor_type_"+new_counter).jqxComboBox('val','Vendor');
            jQuery('#staff_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });

            jQuery('#vendor_type_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#paper_name_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            datePicker('publication_date_'+new_counter);
            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_scan_copy_'+new_counter+'\')"/>';
            html+='<input type="hidden" id="hidden_paper_scan_copy_'+new_counter+'_select" name="hidden_paper_scan_copy_'+new_counter+'_select" value="0">';
            html+='<span id="hidden_paper_scan_copy_'+new_counter+'"></span><input type="hidden" id="scan_copy_select_add_edit_'+new_counter+'" name="scan_copy_select_add_edit_'+new_counter+'" value="add">';
            jQuery('#paper_scan_copy_'+new_counter).html(html);

            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_expense_approval_file_'+new_counter+'\')"/>';
            html+='<input type="hidden" id="hidden_paper_expense_approval_file_'+new_counter+'_select" name="hidden_paper_expense_approval_file_'+new_counter+'_select" value="0">';
            html+='<span id="hidden_paper_expense_approval_file_'+new_counter+'"></span><input type="hidden" id="paper_expense_approval_file_select_add_edit_'+new_counter+'" name="paper_expense_approval_file_select_add_edit_'+new_counter+'" value="add">';
            jQuery('#paper_expense_approval_file_'+new_counter).html(html);
            
        }
        function add_more_expense()
        {
            var theme = getDemoTheme();
            var counter = jQuery('#expense_counter').val();
            var new_counter = parseInt(counter) + 1;
            html_string = '';

                html_string += '<tr id="expense_'+new_counter+'">';
                html_string += '<td>';
                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                html_string += '</td>';
                html_string += '<td>';
                html_string += '<div id="vendor_type_'+new_counter+'" name="vendor_type_'+new_counter+'" onchange="change_vendor_type('+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%"></div>';
                html_string += '<div id="paper_vendor_'+new_counter+'" name="paper_vendor_'+new_counter+'" onchange="get_vendor_info(\'paper\','+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%"></div>';
                html_string += '<div id="staff_'+new_counter+'" name="staff_'+new_counter+'" onchange="get_vendor_info(\'staff\','+new_counter+')" style="padding-left: 3px;margin-left:5px;width:90%;display:none"></div>';
                html_string += '</td>';
                html_string += '<td><input name="account_no_'+new_counter+'" type="text" class="" maxlength="16" size="16" style="width:98%" id="account_no_'+new_counter+'"/></td>';
                html_string += '<td><input name="tin_'+new_counter+'" type="text" class="" style="width:98%" id="tin_'+new_counter+'"/></td>';
                html_string += '<td><input name="bin_'+new_counter+'" type="text" class="" style="width:98%" id="bin_'+new_counter+'"/></td>';
                html_string += '<td><input name="mousak_'+new_counter+'" type="text" class="" style="width:98%" id="mousak_'+new_counter+'"/></td>';
                html_string +='<td><div id="paper_name_'+new_counter+'" name="paper_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;width:90%"></div></td>';
                html_string += '<td><input type="text" name="publication_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="publication_date_'+new_counter+'" value="" ></td>';
                html_string += '<td style="text-align:center"><span id="paper_scan_copy_'+new_counter+'"></span></td>';
                html_string += '<td style="text-align:center"><span id="paper_expense_approval_file_'+new_counter+'"></span></td>';
                html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
                html_string += '</tr>';

            jQuery('#expense_' + counter).after(html_string);
            jQuery('#expense_counter').val(new_counter);
            jQuery('#paper_vendor_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Vendor", source: paper_vendor, height: 25});
            jQuery('#vendor_type_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: vendor_type, height: 25});
            jQuery('#staff_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Staff", source: staff, height: 25});
            jQuery('#paper_name_'+new_counter).jqxComboBox({theme: theme, width: '97%', autoOpen: false, autoDropDownHeight: false, promptText: "Paper", source: paper, height: 25});
            jQuery('#paper_vendor_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery("#staff_"+new_counter).jqxComboBox('val','<?=$this->session->userdata['ast_user']['user_id']?>');
            jQuery("#vendor_type_"+new_counter).jqxComboBox('val','Vendor');
            jQuery('#staff_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });

            jQuery('#vendor_type_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#paper_name_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            datePicker('publication_date_'+new_counter);
            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_scan_copy_'+new_counter+'\')"/>';
            html+='<input type="hidden" id="hidden_paper_scan_copy_'+new_counter+'_select" name="hidden_paper_scan_copy_'+new_counter+'_select" value="0">';
            html+='<span id="hidden_paper_scan_copy_'+new_counter+'"></span><input type="hidden" id="scan_copy_select_add_edit_'+new_counter+'" name="scan_copy_select_add_edit_'+new_counter+'" value="add">';
            jQuery('#paper_scan_copy_'+new_counter).html(html);

            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'paper_expense_approval_file_'+new_counter+'\')"/>';
            html+='<input type="hidden" id="hidden_paper_expense_approval_file_'+new_counter+'_select" name="hidden_paper_expense_approval_file_'+new_counter+'_select" value="0">';
            html+='<span id="hidden_paper_expense_approval_file_'+new_counter+'"></span><input type="hidden" id="paper_expense_approval_file_select_add_edit_'+new_counter+'" name="paper_expense_approval_file_select_add_edit_'+new_counter+'" value="add">';
            jQuery('#paper_expense_approval_file_'+new_counter).html(html);
            
        }
        function delete_row_expense (row_id) {
            jQuery('#expense_' + row_id).hide();
            jQuery('#expense_delete_' + row_id).val(1);
        }
        function change_vendor_type(counter)
        {
            var type = jQuery("#vendor_type_"+counter).jqxComboBox('getSelectedItem');
            if(type!=null)
            {
                jQuery("#paper_vendor_"+counter).jqxComboBox('clearSelection');
                jQuery("input[name='paper_vendor_"+counter+"']").val('');
                jQuery("input[name='account_no_"+counter+"']").val('');
                jQuery("input[name='tin_"+counter+"']").val('');
                jQuery("input[name='bin_"+counter+"']").val('');
                jQuery("input[name='mousak_"+counter+"']").val('');
                if(type.value=='Vendor')
                {
                    jQuery("#paper_vendor_"+counter).show();
                    jQuery("#staff_"+counter).hide();
                }
                else
                {
                    jQuery("#paper_vendor_"+counter).hide();
                    jQuery("#staff_"+counter).show();
                }
            }
        }
    </script>
    <div id="container">
        <div id="body"  >
            <div id="loading-overlay">
                <div class="loading-icon"></div>
            </div> 
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('expenses/pages/left_side_nav',$operation_name); ?>
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
                                    <form class="form" name="paper_form" id="paper_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_id" value="" name="edit_id">
                                        <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                        <input type="hidden" id="event_id" value="" name="event_id">
                                        <input type="hidden" id="hidden_pre_pub_id" value="" name="hidden_pre_pub_id">
                                        <input type="hidden" id="hidden_district_id" value="" name="hidden_district_id">
                                        <input type="hidden" id="hidden_cma_id" value="" name="hidden_cma_id">
                                        <input type="hidden" id="hidden_suit_id" value="" name="hidden_suit_id">
                                        <input type="hidden" id="hidden_pre_pub_dt" value="" name="hidden_pre_pub_dt">
                                        <input type="hidden" id="hidden_pre_pub_file" value="" name="hidden_pre_pub_file">
                                        <input type="hidden" id="hidden_pre_paper_id" value="" name="hidden_pre_paper_id">
                                        <input type="hidden" id="hidden_ac_name" value="" name="hidden_ac_name">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr id="loan_row">
                                                                <td width="40%" style="font-weight: bold;">Proposed Type<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="proposed_type" name="proposed_type" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr id="req_row">
                                                                <td width="40%" style="font-weight: bold;">Requisition Type<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="req_type" name="req_type" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Account Type<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="account_type" name="account_type" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr id="load_row">
                                                                <td width="40%" style="font-weight: bold;"><strong><span id="l_or_c_no"></span> No.</strong><span style="color:red">*</span> </td>
                                                                <td width="60%" id="ac_td">
                                                                    <input name="loan_ac" tabindex="3" onKeyUp="javascript:return mask(this.value,this);" type="text" class="" maxlength="16" size="16" style="width:205px" id="loan_ac" value=""/>
                                                                    <input name="generate" id="generate" class="crmbutton small create" onclick="validate_call()" value="Load" type="button">
                                                                </td>
                                                                <td width="60%" id="show_td" style="display:none">
                                                                    <span id="show_loan"></span>
                                                                    <input name="re_generate" id="re_generate" class="crmbutton small create" onclick="re_load()" value="Load Again" type="button" style="margin-left:45px">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Loan Account Name</td>
                                                                <td width="60%" ><span id="show_ac_name">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Previous Publication Date</td>
                                                                <td width="60%" ><span id="pre_paper_date">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Previous Publication Paper Name</td>
                                                                <td width="60%" ><span id="pre_paper_name">-----</span></td>
                                                            </tr>
                                                            
                                                            
                                                        </table>
                                                    </td>
                                                    <td width="50%" style="display:contents;">
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">District</td>
                                                                <td width="60%" ><span id="district_show">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Under Section<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="under_section" name="under_section" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Previous Publication Copy Attached</td>
                                                                <td width="60%"><span id="pre_publication_copy">-----</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Case Number<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="case_number" name="case_number" style="padding-left: 3px" ></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Remarks</td>
                                                                <td width="60%"><textarea type="text" name="remarks" id="remarks" rows="3" cols="30"></textarea></td>
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
                                                                        <td width="25%" style="font-weight: bold;text-align:center">Vendor<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Bank Account No.<span style="color:red">*</span></td>
                                                                        <td width="5%" style="font-weight: bold;text-align:center">Tin Number</td>
                                                                        <td width="5%" style="font-weight: bold;text-align:center">Bin Number</td>
                                                                        <td width="5%" style="font-weight: bold;text-align:center">Musok(6.3) Number</td>
                                                                        <td width="15%" style="font-weight: bold;text-align:center">Paper Name<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Publication Date<span style="color:red">*</span></td>
                                                                        <td width="5%" style="font-weight: bold;text-align:center">Publication Copy<span style="color:red">*</span></td>
                                                                        <td width="5%" style="font-weight: bold;text-align:center">Approval Attachment<span style="color:red">*</span></td>
                                                                        <td width="10%" style="font-weight: bold;text-align:center">Amount<span style="color:red">*</span></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="expense_body">
                                                                    <tr id="expense_1">
                                                                            <td></td>
                                                                            <td>
                                                                                <div id="vendor_type_1" name="vendor_type_1" onchange="change_vendor_type(1)" style="padding-left: 3px;margin-left:5px;width:90%"></div>
                                                                                <div id="staff_1" name="staff_1" onchange="get_vendor_info('satff',1)" style="padding-left: 3px;margin-left:5px;width:90%;display: none;"></div>
                                                                                <div id="paper_vendor_1" name="paper_vendor_1" onchange="get_vendor_info('paper',1)" style="padding-left: 3px;margin-left:5px;width:90%"></div>
                                                                            </td>
                                                                            <td>
                                                                                <input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">
                                                                                <input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">
                                                                                <input name="account_no_1" type="text" class="" maxlength="16" size="16" style="width:98%" id="account_no_1"/>
                                                                            </td>
                                                                            <td>
                                                                                <input name="tin_1" type="text" class=""  style="width:98%" id="tin_1"/>
                                                                            </td>
                                                                            <td>
                                                                                <input name="bin_1" type="text" class=""  style="width:98%" id="bin_1"/>
                                                                            </td>
                                                                            <td>
                                                                                <input name="mousak_1" type="text" class="" style="width:98%" id="mousak_1"/>
                                                                            </td>
                                                                            <td>
                                                                                <div id="paper_name_1" name="paper_name_1" style="padding-left: 3px;margin-left:5px;width:90%"></div>
                                                                            </td>
                                                                            <td><input type="text" name="publication_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="publication_date_1" value="" ><script type="text/javascript" charset="utf-8">datePicker ("publication_date_1");</script></td>
                                                                            <td style="text-align: center;"><span id="paper_scan_copy_1"></span></td>
                                                                            <td style="text-align: center;"><span id="paper_expense_approval_file_1"></span></td>
                                                                            <td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>
                                                                            
                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr id="add_guarantor_row">
                                                                        <td colspan="11" style="text-align: right">
                                                                            Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button" >
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
                                    <? if(VERIFY==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                            href="<?=base_url()?>index.php/Expenses/bulk_operation/paper_apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                    <? }?>&nbsp;&nbsp;&nbsp;
                                    <strong>D = </strong> Delete,&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify&nbsp;
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

    <div id="details" style="display:none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="paper_scan_copy_sts" id="paper_scan_copy_sts" value="1" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <span id="details_body"></span>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <!-- <input type="button" value="Send" id="sendtochecker" class="btn-small btn-small-normal enabledElem buttondelete" /> -->
                <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            </div>
            <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                <textarea name="comments" id="comments" style="width:370px;"></textarea>
                
                <br><br>
                <input type="button" class="buttondelete" id="delete_button" value="Delete">
                <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
                <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                
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
            </form>
        </div>
    </div>
<?php endif ?>
<!-- For Others Bill -->
<?php if ($operation=='other' && VIEWOTHERS==1): ?>
    <script type="text/javascript">
            var theme = getDemoTheme();
            var csrf_tokens='';
            var expense_activities = [<? $i=1; foreach($expense_activities as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#activities").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Expense Activities", source: expense_activities, width: 250, height: 25});
            jQuery('#activities').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

            // Jqx tab second tab function start    Grid Show
            var initGrid2 = function () {
                var source ={
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'int'},
                        { name: 'activities_name', type: 'int'},
                        { name: 'v_sts', type: 'int'},
                        { name: 'expense_type', type: 'int'},
                        { name: 'verifier_group_id', type: 'int'},
                        { name: 'expenses_name', type: 'string'},
                        { name: 'act_name', type: 'string'},
                        { name: 'vendor_name', type: 'string'},
                        { name: 'district_name', type: 'string'},
                        { name: 'a_dt', type: 'string'},
                        { name: 'amount', type: 'string'},
                        { name: 'remarks', type: 'string'},
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
                    url: '<?=base_url()?>index.php/expenses/other_grid',
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
                var win_h=jQuery( window ).height()-240;
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
                        { text: 'activities_name', datafield: 'activities_name',hidden:true },
                        { text: 'expense_type', datafield: 'expense_type',hidden:true },
                        <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                        <?php } ?>
                        <?php if(EDIT==1){ ?>
                        { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
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
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if( dataRecord.v_sts == 35 || dataRecord.v_sts == 39  || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }
                            else if(dataRecord.v_sts == 37){
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
                                if((check_group_javascript(dataRecord.verifier_group_id)==true || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.v_sts == 37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else if(dataRecord.v_sts == 38){
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
                        { text: 'Expenses Name', datafield: 'expenses_name',editable: false, width: '10%'},
                        { text: 'Vendor Name', datafield: 'vendor_name',editable: false, width: '15%'},
                        { text: 'Activities Name', datafield: 'act_name',editable: false, width: '20%'},
                        { text: 'Activities Date', datafield: 'a_dt',editable: false, width: '12%'},
                        { text: 'Amount', datafield: 'amount',editable: false, width: '15%'},
                        { text: 'Remarks', datafield: 'remarks',editable: false, width: '13%'},
                        
                    ],
                            
                });
                    
                jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 700, height:450, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verify_cancel") });
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
                jQuery('#others_form').jqxValidator('hide');
                clear_form();
            });
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            rules= [
                { input: '#vendor_name', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#vendor_name").val()=='')
                        {
                            jQuery("#vendor_name").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                },
                { input: '#activities', message: 'required!', action: 'blur,change', rule: function(input,commit){
                        if(input.val() != '')
                            {
                                var item = jQuery("#activities").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='activities']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#activities input").focus();
                                return false;
                            }
                    }
                },
                { input: '#amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#amount").val()=='' || jQuery("#amount").val()<=0)
                        {
                            jQuery("#amount").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                },
                { input: '#amount', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                        if(input.val() != '')
                        {
                            if(!checknumber_alphabaticDot('amount'))
                            {
                                jQuery("#amount").focus();
                                return false;

                            }
                        }
                        return true;
                    }
                },
                { input: '#activities_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                } 
                },
                { input: '#activities_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
            ];
            // Add Form Submit
            jQuery("#in_req_button").click( function() {
                jQuery('#others_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        show_confrimation_pop_up('Save');
                    }
                }
                jQuery('#others_form').jqxValidator('validate', validationResult);        
            });
            // Update Edit Form Submit
            jQuery("#in_up_button").click( function() {
                jQuery('#others_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        show_confrimation_pop_up('Update');
                    }
                }
                jQuery('#others_form').jqxValidator('validate', validationResult);        
            });
            // Delete Form Validation 
            jQuery('#delete_convence').jqxValidator({
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
            // Delete Ajax call
            jQuery("#delete_button").click(function () {
                
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#delete_button").hide();
                        jQuery("#deletecancel").hide();
                        jQuery("#delete_loading").show();
                        delete_submit();
                    }
                }
                jQuery('#delete_convence').jqxValidator('validate', validationResult);
             });

            // Send to checaker Ajax Call
            jQuery("#sendtochecker").click(function () {
                    jQuery("#sendtochecker").hide();
                    jQuery("#SendTocheckercancel").hide();
                    jQuery("#checker_loading").show();
                    delete_submit();
             });

            jQuery("#approve").click( function() {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#approve").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
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
                    delete_submit();
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
                    delete_submit();
                }
             });
        });
        function call_ajax_submit(){
            $('sendToCheckerMessageDialogConfirm').style.display = 'none';
            $('sendToCheckerMessageDialogCancel').style.display = 'none';
            $('loadingReturn').style.display = 'inline';
            var postdata = jQuery('#others_form').serialize();
            var add_edit = jQuery("#add_edit").val();
            var edit_row = jQuery("#edit_row").val();
            
            //console.log(postdata);
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url()?>expenses/add_edit_others/"+add_edit+"/"+edit_row,
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
                        // if(add_edit=='edit'){
                        //     jQuery("#in_up_loading").hide();
                        //     jQuery("#in_up_button").show();
                        //     jQuery('#jqxTabs').jqxTabs('select', 1);
                            
                        // }else{
                        //     jQuery("#in_req_button").show();
                        //     jQuery("#in_req_loading").hide();
                        // }
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
                    $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                    $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                    $('loadingReturn').style.display = 'none';
                    close_window();
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
        function delete_submit(){
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
            //console.log(postData);
            //return false
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/expenses/delete_action/',
                data : postData,
                datatype: "json",
                success: function(response){
                    //console.log(response);
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
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
                            jQuery("#verify_return").show();
                            jQuery("#approve").show();
                            jQuery("#verify_reject").show();
                            jQuery("#verify_cancel").show();
                            jQuery("#verify_loading").hide();
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#checker_loading").hide();
                        }
                        var msz='';
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                                
                    }
                }
            });
        }
        function edit(id,editrow){
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            jQuery('#jqxTabs').jqxTabs('select', 0);
            jQuery("#add_button").hide();
            jQuery("#up_button").show();
            jQuery("#activities").jqxComboBox('val',dataRecord['activities_name']);
            jQuery("#amount").val(dataRecord['amount']);
            jQuery("#vendor_name").val(dataRecord['vendor_name']);
            jQuery("#activities_date").val(dataRecord['a_dt'].replace(/-/g, "/"));
            jQuery("#remarks").val(dataRecord['remarks']);
            jQuery("#add_edit").val('edit');
            jQuery("#edit_row").val(id);
        }
        function clear_form(){
            jQuery("#activities").jqxComboBox('clearSelection');
            jQuery("input[name='activities']").val('');
            jQuery("#vendor_name").val('');
            jQuery("#amount").val('');
            jQuery("#activities_date").val('');
            jQuery("#remarks").val('');
            jQuery("#add_edit").val('add');
            jQuery("#edit_row").val('');
            jQuery("#up_button").hide();
            jQuery("#add_button").show
            
        }
        function details (id,editrow,operation) {
            jQuery("#return_reason_verify").val('');
            jQuery("#return_row").hide();
            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
            if(operation=='delete'){
                jQuery('#comments').val('');
                jQuery("#verifyid").val('');
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#delete_row").show();
                jQuery("#type").val('delete');
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val(dataRecord['id']);
            }else if(operation=='sendtochecker'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").show();
                jQuery("#type").val('sendtochecker');
                jQuery("#sendtochecker").val('Send');
                jQuery("#verify_row").hide();
                jQuery("#verifyid").val(dataRecord['id']);
            }else if(operation=='verify'){
                jQuery("#deleteEventId").val('');
                jQuery("#delete_row").hide();
                jQuery("#preview").hide();
                jQuery("#checker_row").hide();
                jQuery("#verify_row").show();
                jQuery("#type").val('verify');
                jQuery("#sendtochecker").val('Verify');
                jQuery("#verifyid").val(dataRecord['id']);
            }else{
                jQuery("#verify_row").hide();
                jQuery("#deleteEventId").val('');
                jQuery("#verifyid").val('');
                jQuery("#delete_row").hide();
                jQuery("#delete_row").hide();
                jQuery("#checker_row").hide();
                jQuery("#preview").show();
            }

            //console.log(dataRecord);
            jQuery("#r_heading").html('Expenses');

            jQuery("#p_vendor").html(dataRecord['vendor_name']);
            jQuery("#p_act_name").html(dataRecord['act_name']);
            jQuery("#p_act_date").html(dataRecord['a_dt']);
            jQuery("#p_amount").html(dataRecord['amount']);
            jQuery("#p_remarks").html(dataRecord['remarks']);

            document.getElementById("details").style.visibility='visible';
            jQuery("#details").jqxWindow('open');
        }
    </script>
    <div id="container">
        <div id="body"  >
            <div id="loading-overlay">
                <div class="loading-icon"></div>
            </div> 
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('expenses/pages/left_side_nav',$operation_name); ?>
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
                                    <div style="padding: 10px;">
                                    <form class="form" name="others_form" id="others_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" id="add_edit" value="add" name="add_edit">
                                        <input type="hidden" id="edit_row" value="" name="edit_row">
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            <tr id="load_row">
                                                                <td width="40%" style="font-weight: bold;"><strong>Vendor Name.</strong><span style="color:red">*</span> </td>
                                                                <td width="60%">
                                                                    <input name="vendor_name" tabindex="3" type="text" class="" style="width:250px" id="vendor_name" value=""/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Activities Name<span style="color:red">*</span> </td>
                                                                <td width="60%" ><div id="activities" name="activities" style="padding-left: 3px"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Activities Date<span style="color:red">*</span></td>
                                                                <td width="60%"><input type="text" name="activities_date" placeholder="dd/mm/yyyy" style="width:250px;" id="activities_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("activities_date");</script></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Amount<span style="color:red">*</span> </td>
                                                                <td width="60%" ><input name="amount" type="text" class="" style="width:250px" id="amount" value="<?=isset($result->cif)?$result->cif:''?>" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%" style="font-weight: bold;">Remarks</td>
                                                                <td width="60%"><textarea type="text" name="remarks" id="remarks" rows="3" cols="30"></textarea></td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </td>
                                                    <td width="50%">
                                                        <table style="width: 100%;">
                                                            
                                                        </table>
                                                    </td>
                                                </tr>
                                                <? if(ADD==1){?>
                                                <tr id="add_button" >
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
                                    <strong>D = </strong> Delete,&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify&nbsp;
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

    <div id="details" style="display:none;">
        <div style=""><strong><span id="r_heading"></span></strong></div>
        <div style="" id="details_table">
            <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyid" id="verifyid" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <table style="width: 100%;" class="preview_table2">
                <tr>
                    <th width="40%" align="left"><strong>Expense Type</strong></th>
                    <td width="60%" align="left">Others/Miscilinious</td>
                </tr>
                <tr>
                    <th width="40%" align="left"><strong>Vendor Name</strong></th>
                    <td width="60%" align="left" ><span id="p_vendor"></span></td>
                </tr>
                <tr>
                    <th width="40%" align="left"><strong>Activities Name</strong></th>
                    <td width="60%" align="left" ><span id="p_act_name"></span></td>
                </tr>
                <tr>
                    <th width="40%" align="left"><strong>Activities Date</strong></th>
                    <td width="60%" align="left" ><span id="p_act_date"></span></td>
                </tr>
                <tr>
                    <th width="40%" align="left"><strong>Amount</strong></th>
                    <td width="60%" align="left" ><span id="p_amount"></span></td>
                </tr>
                <tr>
                    <th width="40%" align="left"><strong>Remarks</strong></th>
                    <td width="60%" align="left" ><span id="p_remarks"></span></td>
                </tr>
            </table>
            <div id="preview" class="wrapper">
                </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
            </div>
            <div id="checker_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <!-- <input type="button" value="Send" id="sendtochecker" class="btn-small btn-small-normal enabledElem buttondelete" /> -->
                <input type="button" class="buttonSend" id="sendtochecker" value="Send">
                <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
                <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
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
            <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
                <br><br>
                <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                <textarea name="comments" id="comments" style="width:370px;"></textarea>
                
                <br><br>
                <input type="button" class="buttondelete" id="delete_button" value="Delete">
                <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
                <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
                
            </div>
            </form>
        </div>
    </div>
<?php endif ?>



<div id="sendToCheckerMessageDialogContent"  style="display:none;">
     <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin-top:0px;">
        <input type="hidden" name="operation" id="operation" value="">
        <div class="hd"><h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2></div>
           <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a> 
            <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
            <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
    </form>
    </div>

<div id="sendToCheckerMessageDialogContent2"  style="display:none;">
 <form method="POST" name="sendToCheckerMessageform2" id="sendToCheckerMessageform2"  style="margin-top:0px;">
    <input type="hidden" name="field_name" id="field_name" value="">
    <div class="hd"><h2 class="conf" style="margin-top:0px">No Bill Selected.Want to delete Request?</h2></div>
       <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
        <textarea name="comments_2" id="comments_2" style="width:370px;"></textarea>
        </br></br>
       <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm2" onclick="delete_action2()">Delete</a> 
        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel2" onclick="close_window2()"><span>Cancel</span></a> 
        <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
</form>
</div>