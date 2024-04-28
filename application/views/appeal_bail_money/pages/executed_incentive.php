<style>
   

table, td {
    padding: 5px;
    margin: 0px;
    border-spacing: 0px;
    border-collapse: collapse;
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
  border: 2px solid #207900;
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
  background-color: #207900;
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
    display: block;
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



</style>

<script type="text/javascript">
        
    </script>
    <script type="text/javascript">
        var theme = 'classic';
        var csrf_tokens='';
        var arrested_by = [<? $i=1; foreach($arrested_by as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var nature_warrent = [<? $i=1; foreach($nature_warrent as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var wa_status = [<? $i=1; foreach($disposal_sts as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var type = [<? $i=1; foreach($executor_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->group_name.'"}'; $i++;}?>];
      // var type= [{value:"2", label:"Recovery"},{value:"1", label:"Legal"}];

       var valid_rule =[];

    jQuery(document).ready(function () {

        /*jQuery("#arrested_by").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Nature of Warrant Arrest", source: arrested_by, width: 250, height: 25});
        jQuery("#nature_wa").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Arrested By", source: nature_warrent, width: 250, height: 25});
        jQuery("#wa_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Arrested By", source: wa_status, width: 250, height: 25});
        jQuery("#executor_type_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: type, width: 250, height: 25});
       
        jQuery('#nature_wa,#arrested_by,#wa_status,#executor_type_1').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });*/

        //jQuery('#sendtochecker').jqxButton({template:"success", width: 120, height: 40, theme: theme });

        
        
       
        // Jqx tab second tab function start    Grid Show
        var initGrid2 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'user_name', type: 'string'},
                    { name: 'pin', type: 'string'},
                    { name: 'group_name', type: 'string'},
                    { name: 'loan_ac', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'case_number', type: 'string'},
                    { name: 'executed_criterea', type: 'string'},
                    { name: 'amount', type: 'string'},
                    { name: 'pariculars', type: 'string'},
                    { name: 'paid_sts', type: 'string'},
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
                url: '<?=base_url()?>index.php/warrant_arrest/executed_incentive_grid',
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
                },
                formatData: function (data) {

                    //var territory = jQuery.trim(jQuery('input[name=territory]').val());
                    var s_serial_no = jQuery.trim(jQuery('#s_serial_no').val());
                    var s_case_number = jQuery.trim(jQuery('#s_case_number').val());
                    var s_name = jQuery.trim(jQuery('#s_name').val());
                    var s_account = jQuery.trim(jQuery('#s_account').val());
                    jQuery.extend(data, {
                            case_number : s_case_number,
                            u_name : s_name,
                            account : s_account,
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
            jQuery("#jqxGrid2").jqxGrid({
                width:'99%',
                height:350,
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
                    { text: 'sts', datafield: 'sts',hidden:true },
                    
                    /*<?php if(EDIT==1){ ?>
                    { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        //if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                        //}
                        //else
                        //{
                          //  return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        //}
                        }
                    },
                    <?php } ?>*/
                    /*<?php if(EDIT==1){ ?>
                    { text: 'Paid', menu: false, datafield: 'sett', align:'center', editable: false, sortable: false, width: '4%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        //if(dataRecord.paid_sts == '39' || dataRecord.v_sts == 35){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'paid\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                        //}
                        //else
                        //{
                          //  return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        //}
                        }
                    },
                    <?php } ?>*/
                    
                    { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                          }
                    },
                    { text: 'Name', datafield: 'user_name',editable: false, width: '13%'},
                    { text: 'Pin', datafield: 'pin',editable: false, width: '8%'},
                    { text: 'Type', datafield: 'group_name',editable: false, width: '13%'},
                    { text: 'Account Name', datafield: 'ac_name',editable: false, width: '13%'},
                    { text: 'Account', datafield: 'loan_ac',editable: false, width: '13%'},
                    { text: 'Case Number', datafield: 'case_number',editable: false, width: '10%'},
                    { text: 'Amount', datafield: 'amount',editable: false, width: '8%'},
                    { text: 'Particulars', datafield: 'pariculars',editable: false, width: '10%'},
                    { text: 'Payment', datafield: 'paid_sts',editable: false, width: '10%'},
                    
                    
                ],
                        
            });
              
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 700, height:500, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#paid_cancel,#r_ok") });
            jQuery('#details').on('close', function (event) {
                //jQuery('#delete_convence').jqxValidator('hide');
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
        //document.getElementById("jqxTabs").style.minHeight = "280px";
        jQuery('#jqxTabs').jqxTabs({ width: '99%', initTabContent: initWidgets });
        /*jQuery('#jqxTabs').bind('selected', function (event) {
            if(event.args.item==0){
                clear_form();
                jQuery('#jqxTabs').jqxTabs('disableAt', 1);
            }
            //clear_form();
        });*/
        //jQuery('#jqxTabs').jqxTabs('disableAt', 1);

       
        // Send to checaker Ajax Call
        jQuery("#paid_button").click(function () {
            jQuery("#paid_button").hide();
            jQuery("#paid_cancel").hide();
            jQuery("#paid_loading").show();
            delete_submit();
            
         });


    });
var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
function clearCount() { count=0; maxrow = 0;displayrow= 0;}
function search_data(){
    jQuery("#jqxGrid2").jqxGrid('updatebounddata');
    return;

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
        url: '<?=base_url()?>index.php/warrant_arrest/delete_action/',
        data : postData,
        datatype: "json",
        success: function(response){
            //console.log(response);
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            if(json.Message!='OK')
            {       

                if ($('type').value=='paid') 
                {
                    jQuery("#paid_button").show();
                    jQuery("#paid_cancel").show();
                    jQuery("#paid_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }
                else
                {
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }
                return false;
            }else{

                if ($('type').value=='paid') 
                {
                    jQuery("#paid_button").show();
                    jQuery("#paid_cancel").show();
                    jQuery("#paid_loading").hide();
                }
                else
                {
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



function details (id,editrow,operation) {
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

    if(operation=='paid'){
        jQuery("#deleteEventId").val(id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#paid_row").show();
    }else{
        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val('');
        jQuery("#paid_row").hide();
        jQuery("#preview").show();
    }
    
    //console.log(dataRecord);
    jQuery("#r_heading").html('Executor Details');

    jQuery("#p_name").html(dataRecord['user_name']);
    jQuery("#p_pin").html(dataRecord['pin']);
    jQuery("#p_type").html(dataRecord['group_name']);
    jQuery("#p_account_name").html(dataRecord['ac_name']);
    jQuery("#p_account").html(dataRecord['loan_ac']);
    jQuery("#p_case_number").html(dataRecord['case_number']);
    jQuery("#p_amount").html(dataRecord['amount']);
    jQuery("#p_particulars").html(dataRecord['pariculars']);
    jQuery("#p_payment").html(dataRecord['paid_sts']);

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
                    <?php $this->load->view('warrant_arrest/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->
                </td>
                <td valign="top" id="demos" class='rc-all content'>
                    <div id='jqxTabs'>
                        <ul>
                            <li style="margin-left: 30px;">Data Grid</li>
                            <!-- <li>Form</li> -->
                        </ul>
                        <!---==== First Tab Start ==========----->
                        <div style="overflow: hidden;">
                            <form method="POST" name="form" id="form"  style="margin:0px;">
                               <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;width:100%">
                                        <tr>
                                            <td style="text-align:right;width:10%"><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><input type="text" id="s_case_number" name="s_case_number" style="width:100%" /></td>
                                            
                                            <td style="text-align:right;width:5%"><strong>Account&nbsp;&nbsp;</strong> </td>
                                            <td style="width:15%"><input type="text" id="s_account" name="s_account" style="width:100%" /></td>
                                            <td style="text-align:right;width:5%"><strong>Name&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><input type="text" id="s_name" name="s_name" style="width:100%" /></td>
                                            <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
                                            </td>
                                        </tr>
                                    </table>
                              </div>
                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                            </form>
                            <br>
                            <div style="border:none;" id="jqxGrid2"></div>
                            <div style="float:left;padding-top: 5px;margin-left: 5px;margin-bottom: 20px;">
                            
                            </div>
                        </div>
                        
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="details" style="visibility:hidden;">
    <div style=""><strong><span id="r_heading"></span></strong></div>
    <div style="" id="details_table">
        <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
        <input name="verifyid" id="verifyid" value="" type="hidden">
        <input name="type" id="type" value="" type="hidden">
        <table style="width: 100%;" class="preview_table2">
            <tr>
                <th width="40%" align="left"><strong>Name</strong></th>
                <td width="60%" align="left"><span id="p_name"></span></td>
            </tr>
            <tr>
                <th width="40%" align="left"><strong>Pin</strong></th>
                <td width="60%" align="left" ><span id="p_pin"></span></td>
            </tr>
            <tr>
                <th width="40%" align="left"><strong>Type</strong></th>
                <td width="60%" align="left" ><span id="p_type"></span></td>
            </tr>
            <tr>
                <th width="40%" align="left"><strong>Account Name</strong></th>
                <td width="60%" align="left" ><span id="p_account_name"></span></td>
            </tr>
            <tr>
                <th width="40%" align="left"><strong>Account</strong></th>
                <td width="60%" align="left" ><span id="p_account"></span></td>
            </tr>
            <tr>
                <th width="40%" align="left"><strong>Case Number</strong></th>
                <td width="60%" align="left" ><span id="p_case_number"></span></td>
            </tr>
            <tr>
                <th width="40%" align="left"><strong>Amount</strong></th>
                <td width="60%" align="left" ><span id="p_amount"></span></td>
            </tr>
            <tr>
                <th width="40%" align="left"><strong>Particulars</strong></th>
                <td width="60%" align="left" ><span id="p_particulars"></span></td>
            </tr>
            <tr>
                <th width="40%" align="left"><strong>Payment</strong></th>
                <td width="60%" align="left" ><span id="p_payment"></span></td>
            </tr>
        </table>
        <div id="preview" class="wrapper">
            </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
        </div>
        <div id="paid_row" style="text-align:center;margin-bottom:30px;width:100%;">
           
            <br><br>
            <input type="button" class="buttonSend" id="paid_button" value="Paid">
            <input type="button" class="buttonclose" id="paid_cancel" onclick="close()" value="Cancel">
            <span id="paid_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div>
        
        </form>
    </div>
</div>