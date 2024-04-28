<?php $this->load->view('hc_matter/pages/css'); ?>


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
                    url: '<?=base_url()?>index.php/hc_matter/lawyer_grid',
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
                url: "<?=base_url()?>hc_matter/add_edit_lawyer_bill/"+add_edit+"/"+edit_row,
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
            url: '<?php echo base_url(); ?>index.php/hc_matter/get_lawyer_edit_data',
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
                url: "<?=base_url()?>hc_matter/lawyer_bill_details",
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
            url: '<?php echo base_url(); ?>index.php/hc_matter/get_expense_data_lawyer',
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
                        <?php $this->load->view('hc_matter/pages/left_side_nav'); ?>
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
                                    &nbsp;&nbsp;&nbsp;
                                    <strong>E = </strong> Edit,&nbsp;
                                    <strong>STC = </strong> Send To Checker,&nbsp;
                                    <strong>V = </strong> Verify,&nbsp;
                                    
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


