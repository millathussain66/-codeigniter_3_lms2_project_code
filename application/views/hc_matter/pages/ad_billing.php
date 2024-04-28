<?php $this->load->view('hc_matter/pages/css'); ?>


    <script type="text/javascript">
        var theme = 'classic';
        var csrf_tokens='';
        
      // var type= [{value:"2", label:"Recovery"},{value:"1", label:"Legal"}];
        var arrested = [{value:"Yes", label:"Yes"},{value:"No", label:"No"},];
        
       var valid_rule =[];
       var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
       var vendor = [<? $i=1; foreach($paper_vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var hc_activites = [<? $i=1; foreach($hc_activites as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var expense_activities = [];
        var expense_type = [<? $i=1; foreach($request_from as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var staff = [];

        var proposed_type =['Loan','Card'];
        var limit =['5','100','All'];

    jQuery(document).ready(function () {

        jQuery("#s_proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 150, height: 25});
        jQuery("#limit").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Limit", source: limit, width: 80, height: 25});

        jQuery("#expense_type_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: expense_type, width: 180, height: 25});
        jQuery("#district_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 200, height: 25});
        jQuery("#activities_name_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight:150, promptText: "Select Activities", source: hc_activites, width: 200, height: 25});
        //jQuery("#group_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: user_group, width: 250, height: 25});
       
        jQuery('#expense_type_1,district_1,#activities_name_1,#s_proposed_type,#limit').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

        //jQuery('#sendtochecker').jqxButton({template:"success", width: 120, height: 40, theme: theme });

        jQuery("#limit").jqxComboBox('val','5');
        jQuery("#s_proposed_type").jqxComboBox('val','Loan');
        s_change_caption();
        jQuery('#s_proposed_type').bind('change', function (event) {
            jQuery("#s_account").val('');
            jQuery("#s_hidden_loan_ac").val('');
            s_change_caption();       
        });
        
        jQuery("#addel").click( function() {
            //console.log(valid_rule)
            jQuery('#table').jqxValidator({
                rules:valid_rule
            });
        });
        // Add edit form validation
        jQuery('#action_form').jqxValidator({
            rules: [
        
            /*{ input: '#arrested', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#arrested").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='arrested']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#arrested input").focus();
                            return false;
                        }
                }
            },
            
             { input: '#deposite_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                } 
                },
                { input: '#deposite_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
            
            { input: '#deposited_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#deposited_amount").val()=='')
                    {
                        jQuery("#deposited_amount").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },

            
            { input: '#deposited_amount', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabaticDot('deposited_amount'))
                        {
                            jQuery("#deposited_amount").focus();
                            return false;

                        }
                    }
                    return true;
                }
            },*/
            
            ]
        });
       
        // Jqx tab second tab function start    Grid Show
        var initGrid2 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'hc_id', type: 'int'},
                    { name: 'ex_id', type: 'int'},
                    { name: 'event_id', type: 'int'},
                    { name: 'hc_matter_type', type: 'string'},
                    { name: 'batch_no', type: 'string'},
                    { name: 'ac_number', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'proposed_type', type: 'string'},
                    { name: 'case_no', type: 'string'},
                    { name: 'case_sts_name', type: 'string'},
                    { name: 'hc_bench_name', type: 'string'},
                    { name: 'hc_type_name', type: 'string'},
                    { name: 'status_name', type: 'string'},
                    { name: 'sts', type: 'string'},        
                    { name: 'v_sts', type: 'string'},        
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
                url: '<?=base_url()?>index.php/hc_matter/ad_expencese_grid',
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
                    
                    var s_case_number = jQuery.trim(jQuery('#s_case_number').val());
                    var s_name = jQuery.trim(jQuery('#s_name').val());
                    var s_account = jQuery.trim(jQuery('#s_account').val());
                    jQuery.extend(data, {
                            case_number : s_case_number,
                            ac_name : s_name,
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
            var win_h=jQuery( window ).height()-280;
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

                    { text: 'hc_id', datafield: 'hc_id', hidden:true,  editable: false,  width: '4%' },
                    { text: 'ex_id', datafield: 'ex_id',hidden:true },
                    { text: 'v_sts', datafield: 'v_sts',hidden:true },
                    { text: 'sts', datafield: 'sts',hidden:true },
                    <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.batch_no+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
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
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.batch_no+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                        }
                        else
                        {
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }
                        }
                    },
                    <?php } ?>
                    <? if(SENDTOCHECKER==1){?>
                        { text: 'STC', menu: false, datafield: 'sendtochecker', align:'center', editable: false, sortable: false, width: '4%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.batch_no+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                            }else if(dataRecord.v_sts == 37){
                                return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">S</div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                    <?php } ?>
                    <? if(VERIFY==1){?>
                        { text: 'V', menu: false, datafield: 'Verify', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 37 ){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.batch_no+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
                            }else if(dataRecord.v_sts == 38){
                                return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">V</div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                    <?php } ?>
                   
                    { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.batch_no+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                          }
                    },
                    { text: 'Status', datafield: 'status_name',editable: false, width: '13%'},
                    { text: 'Proposed Type', datafield: 'proposed_type',editable: false, width: '13%'},
                    { text: 'Account Name', datafield: 'ac_name',editable: false, width: '13%'},
                    { text: 'Account', datafield: 'ac_number',editable: false, width: '13%'},
                    { text: 'Case Number', datafield: 'case_no',editable: false, width: '13%'},
                    { text: 'Case Status name', datafield: 'case_sts_name',editable: false, width: '13%'},
                    { text: 'HC Bench', datafield: 'hc_bench_name',editable: false, width: '13%'},
                    { text: 'HC Type', datafield: 'hc_type_name',editable: false, width: '13%'},
                    
                ],
                        
            });
                
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#sendtocheckercancel,#verifycancel,#verify_cancel") });
            jQuery('#details').on('close', function (event) {
                jQuery('#delete_convence').jqxValidator('hide');
                
            });
            //End check box start 
            //End check box start 
            /*jQuery("#jqxGrid2").on('cellbeginedit', function (event) {
                var column = event.args.datafield;
                var row = event.args.rowindex;
                var value = event.args.value;
                var rowindexes = jQuery('#jqxGrid2').jqxGrid('getselectedrowindexes');
            });*/
            // select or unselect rows when the checkbox is checked or unchecked.
            /*jQuery("#jqxGrid2").on('cellendedit', function (event) {
                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', event.args.rowindex);
                if(dataRecord.stc_sts!=6){                 
                    alertMSG('applicationverifydelete');
                    jQuery("#jqxGrid2").jqxGrid('setcellvalue', event.args.rowindex, 'available', false);
                    jQuery("#jqxGrid2").jqxGrid('unselectrow', event.args.rowindex)
                }else{
                    if (event.args.value) {
                        jQuery("#jqxGrid2").jqxGrid('selectrow', event.args.rowindex);
                    }
                    else {
                        jQuery("#jqxGrid2").jqxGrid('unselectrow', event.args.rowindex);
                    }
                }
            });*/
            //End check box update 
            //jQuery("#stf").jqxButton({ theme: theme });
        }
        // jQuery("#jqxNavigationBar").css('visibility', 'visible');
        //jQuery("#jqxNavigationBar").jqxNavigationBar({ width: 300, expandMode: 'multiple', expandedIndexes: [2, 3], theme: 'arctic' });
        
        // jqx tab init
        var initWidgets = function (tab) {
            switch (tab) {
                case 0:
                    break;
                case 1:
                    initGrid2();
                    break;
            }
        }
        //document.getElementById("jqxTabs").style.minHeight = "280px";
        jQuery('#jqxTabs').jqxTabs({ width: '99%', initTabContent: initWidgets });
        
        jQuery('#jqxTabs').bind('selected', function (event) {

            if(event.args.item==0){
                clear_form();
                //jQuery('#jqxTabs').jqxTabs('disableAt', 1);
            }
            jQuery('#action_form').jqxValidator('hide');
            //clear_form();
        });
        //jQuery('#jqxTabs').jqxTabs('disableAt', 1);

        // Add Form Submit
        jQuery("#in_req_button").click( function() {
            //var validationResult = function (isValid) {
                if (expense_validation()==true) {
                    jQuery("#in_req_button").hide();
                    jQuery("#in_req_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
                }
            //}
           // jQuery('#action_form').jqxValidator('validate', validationResult);        
        });
        // Update Edit Form Submit
        jQuery("#in_up_button").click( function() {
           
            //var validationResult = function (isValid) {
                if (expense_validation()==true) {
                    jQuery("#in_up_button").hide();
                    jQuery("#in_up_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
                }
            //}
            //jQuery('#action_form').jqxValidator('validate', validationResult);        
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

        /*jQuery("#verify_button").click(function () {
            
                jQuery("#sendtochecker").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            
         });*/

        jQuery("#sendtochecker_button").click(function () {
            
                jQuery("#sendtochecker_button").hide();
                jQuery("#sendtocheckercancel").hide();
                jQuery("#sendtochecker_loading").show();
                delete_submit();
            
         });

        jQuery("#verify_button").click( function() {
            jQuery('#type').val('verify');
            jQuery("#verify_return_row").hide();
            jQuery("#verify_return").hide();
            jQuery("#verify_reject").hide();
            jQuery("#verify_cancel").hide();
            jQuery("#verify_loading").show();
            delete_submit();
            //return false; 
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
                jQuery("#verify_reject").hide();
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            }
        });
       
    });



function s_mask(str,textbox){
    var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
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
                jQuery("#s_hidden_loan_ac").val(str);
            }
            else//For single value enter
            {
                //For New value
                var orginal_loan_ac=jQuery("#s_hidden_loan_ac").val();
                if (orginal_loan_ac.length<str.length) 
                {
                    var index = str.length-1;
                    var new_val=str.slice(index);
                    orginal_loan_ac+=new_val;
                    //alert(orginal_loan_ac);
                    jQuery("#s_hidden_loan_ac").val(orginal_loan_ac);
                }
                //For delete key
                else{
                    var len=str.length;
                    var new_val=orginal_loan_ac.slice(0,len);
                    jQuery("#s_hidden_loan_ac").val(new_val);
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
                      if (letter_Count<6 || jQuery("#s_hidden_loan_ac").val().length!=16) 
                      {
                        textbox.value = '';
                        jQuery("#s_hidden_loan_ac").val('');
                        alert('Wrong way to input Card No please try again');
                      }
                }
            }
        }
    }
    
}
function s_change_caption(){   
    if (jQuery("#s_proposed_type").val()=='') 
    {
        document.getElementById("loan_ac").disabled = true;
        jQuery("#s_l_or_c_no").html('Loan A/C or Card');
    }
    else
    {
        document.getElementById("s_account").disabled = false;
        var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
        if (item.value=='Loan') {
            jQuery("#s_l_or_c_no").html('Loan A/C ');
        }
        else if(item.value=='Card'){
            jQuery("#s_l_or_c_no").html('Card');
        }
    }
    
}
function call_ajax_submit(){
    
    var postdata = jQuery('#action_form').serialize();
    var add_edit=jQuery('#add_edit').val();
    //console.log(postdata);
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/expencese_action",
        data : postdata,
        datatype: "json",
        async:false,
        success: function(response){
            //console.log(response);
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
                jQuery('#add_form').hide();
                jQuery('#search_area').show();
                return false;
            }
            var msg='';
            if(add_edit=='edit'){
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
            jQuery('#add_form').hide();
            jQuery('#search_area').show();
            jQuery('#s_account').val('');
            jQuery('#s_case_number').val('');
            jQuery('#searchTable').html('');
            
            
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
        url: '<?=base_url()?>index.php/hc_matter/get_expence_delete/',
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
                }else if ($('type').value=='verify') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if ($('type').value=='verify_reject') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify_return') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
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

                if ($('type').value=='delete') 
                {
                    jQuery("#delete_button").show();
                    jQuery("#deletecancel").show();
                    jQuery("#delete_loading").hide();
                }else if ($('type').value=='sendtochecker') 
                {
                    jQuery("#sendtochecker_button").show();
                    jQuery("#sendtocheckercancel").show();
                    jQuery("#sendtochecker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify_reject') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify_return') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
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
function edit(id,editrow){
    clear_form();
    //jQuery('#add_guarantor_row').hide();
    jQuery('#jqxTabs').jqxTabs('select', 0);
    jQuery("#add_button").hide();
    jQuery("#up_button").show();
    jQuery("#in_up_button").show();
    jQuery('#search_area').hide();
    jQuery('#add_form').show();
    jQuery('#add_edit').val('edit');
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
   // console.log(dataRecord);
    var suit_id = dataRecord['suit_id'];
    //var id = dataRecord['ex_id'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/get_expence_edit_info_ad",
        data : {[csrfName]: csrfHash,batch_no:id,module_name:'AD Matter'},
        datatype: "json",
        async:false,
        success: function(response){
            //console.log(response);
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            console.log(rows);
            jQuery("#executed_counter").val(rows.length);
            
            rows.forEach(function(row,index) {
                //console.log(row);
                var theme = getDemoTheme();
                if(index>0){
                var counter = jQuery('#expense_counter').val();
                var new_counter = parseInt(counter) + 1;
                html_string = '';

                    html_string += '<tr id="expense_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="">';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                    html_string += '</td>';
                    html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="change_vendor(\'expense_type_'+new_counter+'\','+new_counter+')"></div></td>';
                    html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data('+new_counter+')"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%" id="vendor_name_'+new_counter+'" /></td>';
                    html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" _onchange="get_expense_amount(\'activities_name_'+new_counter+'\','+new_counter+')"></div></td>';
                    html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:90%;" id="activities_date_'+new_counter+'" value="" ></td>';
                    html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                jQuery('#expense_' + counter).after(html_string);
                jQuery('#expense_counter').val(new_counter);
                
                jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, height: 25});
                jQuery('#expense_type_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false,dropDownHeight:150, promptText: "Select Activity", source: hc_activites, height: 25});
                jQuery('#activities_name_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
                jQuery('#district_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                datePicker('activities_date_'+new_counter);
                }
                var num = index+1;
                //get_expense_activities(type,counter,req_type)
                
                
                jQuery('#expense_type_'+num).jqxComboBox('clearSelection');
                jQuery('#district_'+num).jqxComboBox('clearSelection');
                jQuery('#vendor_id_'+num).jqxComboBox('clearSelection');
                jQuery('#activities_name_'+num).jqxComboBox('clearSelection');
                
                jQuery("#expense_type_"+num).jqxComboBox('val',row.expense_type);
                //change_vendor('expense_type_'+num,num);
                //get_dropdown_data(num); 
                if(row.expense_type==6){
                    vendor_name_3
                    jQuery('#vendor_name_'+num).val(row.vendor_name);
                }else{     
                    jQuery("#district_"+num).jqxComboBox('val',row.district);
                    jQuery("#vendor_id_"+num).jqxComboBox('val',row.vendor_id);
                }
                jQuery("#activities_name_"+num).jqxComboBox('val',row.activities_name);
                jQuery('#activities_date_'+num).val(row.activities_date);
                jQuery('#amount_'+num).val(row.amount);
                jQuery('#remarks_'+num).val(row.remarks);
                jQuery('#expense_edit_'+num).val(row.id);
                
            });
            jQuery('#hc_id').val(rows[0].hc_id);
            jQuery('#batch_no').val(rows[0].batch_no);

            /*jQuery('#expense_type_1').jqxComboBox('clearSelection');
            jQuery('#district_1').jqxComboBox('clearSelection');
            jQuery('#vendor_id_1').jqxComboBox('clearSelection');
            jQuery('#activities_name_1').jqxComboBox('clearSelection');
            
            jQuery("#expense_type_1").jqxComboBox('val',rows.expense_type);           
            jQuery("#district_1").jqxComboBox('val',rows.district);
            jQuery("#vendor_id_1").jqxComboBox('val',rows.vendor_id);
            jQuery("#activities_name_1").jqxComboBox('val',rows.activities_name);
            jQuery('#activities_date_1').val(rows.activities_date);
            jQuery('#amount_1').val(rows.amount);
            jQuery('#remarks_1').val(rows.remarks);
            jQuery('#expense_edit_1').val(rows.id);
            jQuery("#vendor_name_1").val(rows.vendor_name);*/

            jQuery('#loan_ac_ds').html(rows[0].ac_number);
            jQuery('#loan_ac_na').html(rows[0].ac_name);
            jQuery('#case_num').html(rows[0].case_no);
            jQuery('#hc_matter_type').html(rows[0].hc_matter_type);
            //jQuery('#cma_id').val(rows.cma_id);
            //jQuery('#edit_row').val(rows.id);
            
           // jQuery("#expense_type_1").jqxComboBox('val',1);
            //jQuery("#vendor_id_1").jqxComboBox('val',rows.prest_lawyer_name);
            
        }
    });
    //jQuery('#jqxTabs').jqxTabs('enableAt', 1);
    
    
}
function clear_form(){
    jQuery("#executed_counter").val(1);
    jQuery('#expense_type_1').jqxComboBox('clearSelection');
    jQuery('#expense_type_1').jqxComboBox('val','');
    jQuery('#district_1').jqxComboBox('clearSelection');
    jQuery('#district_1').jqxComboBox('val','');
    jQuery('#vendor_id_1').jqxComboBox('clearSelection');
    jQuery('#vendor_id_1').jqxComboBox('val','');
    jQuery('#activities_name_1').jqxComboBox('clearSelection');
    jQuery('#activities_name_1').jqxComboBox('val','');
    jQuery('#activities_date_1').val('');
    jQuery('#amount_1').val('');
    jQuery('#remarks_1').val('');
    jQuery('#expense_edit_1').val('');
    jQuery("#vendor_name_1").val('');

    jQuery('#loan_ac_ds').html('');
    jQuery('#loan_ac_na').html('');
    jQuery('#case_num').html('');
    jQuery('#hc_matter_type').html('');

    jQuery("#edit_row").val('');
    jQuery("#add_edit").val('add');
    jQuery('#hc_id').val('');
    jQuery('#case_number').val('');
    jQuery('#expense_counter').val(1);
    jQuery('#deposite_date').val('');
    jQuery("#add_button").show();
    jQuery("#up_button").hide();
    jQuery('#expense_body').children().slice(1).remove();
    jQuery('#search_area').show();
    jQuery('#add_form').hide();
}


function details (id,editrow,operation) {
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
    //console.log(dataRecord);
    jQuery("#module_name").val('AD Matter');
    if(operation=='delete'){
        jQuery("#deleteEventId").val(id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtochecker").hide();
        jQuery("#delete_row").show();
    }else if(operation=='sendtochecker'){

        jQuery("#deleteEventId").val(id);
        jQuery("#verifyid").val(id);
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtochecker").show();
    }
    else if(operation=='verify'){

        jQuery("#deleteEventId").val(id);
        jQuery("#verifyid").val(id);
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#delete_row").hide();
        jQuery("#sendtochecker").hide();
        jQuery("#verify_row").show();
    }
    else{
        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val('');
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtochecker").hide();
        jQuery("#preview").show();
    }
    
    //console.log(dataRecord);
    jQuery("#r_heading").html('Appeal Division Matter Expenses');

    var cma_id = dataRecord['cma_id'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/get_expence_details",
        data : {[csrfName]: csrfHash,module_name:'AD Matter',id:id},
        datatype: "json",
        async:false,
        success: function(response){
            var ds=response.split('####');
            jQuery('.txt_csrfname').val(ds[1]);
            /*var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;*/
           // console.log(ds[0]);
            jQuery('#previewtable').html(ds[0]);
        }
    });
    


    /*jQuery("#d_suit_id").val(dataRecord['suit_id']);
    jQuery("#p_account_name").html(dataRecord['ac_name']);
    jQuery("#p_account").html(dataRecord['loan_ac']);
    jQuery("#p_case_number").html(dataRecord['case_number']);
    jQuery("#p_amount").html(dataRecord['deposit_amt']);
    jQuery("#p_date").html(dataRecord['deposit_dt']);
    jQuery("#p_arrested").html(dataRecord['arrested']);*/

    document.getElementById("details").style.display='block';
    jQuery("#details").jqxWindow('open');
}

// 
function search_data(){
    var loan_ac = jQuery('#s_account').val();
    var case_number = jQuery('#s_case_number').val();
    var s_proposed_type = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
    
    if(s_proposed_type==null && loan_ac=='' && case_number=='')
    {
        alert('Please provide at least one search parameter!!!');
    }
    else
    {
        jQuery("#grid_loading").show();
        //jQuery("#load").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postdata = jQuery('#form').serialize();
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>index.php/hc_matter/hc_search_case_ad/",
            data : postdata,
            datatype: "html",
            success: function(response){
                jQuery("#grid_loading").hide();
                var data = response.split("####");
                jQuery('.txt_csrfname').val(data[1]);
                jQuery("#load_suit_loading").hide();
                jQuery("#load").show();
                jQuery('#searchTable').html(data[0]);

            }
        });
    }

}

// Only One Checkbox Select At a time
function onlyOne(checkbox) {
    //var id = document.getElementsByName('suit_id').value;
    //console.log(checkbox.value)
    var checkboxes = document.getElementsByName('case_id')
    checkboxes.forEach((item) => {
        //console.log(item)
        if (item !== checkbox) item.checked = false
    })
}

function loadsuit(){
    //alert('ddd')
    var checkboxes = document.getElementsByName('case_id');
    var val;var required = false;
    checkboxes.forEach((item) => {
        if(item.checked==true){
            val=item.value;
            required = true;
           //console.log(item.value) 
        }
        
    });
    if(required==false){
        alert('Please Select a Case Number!');
        return false;
    }

    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/get_case_edit_info_ad",
        data : {[csrfName]: csrfHash,id:val},
        datatype: "json",
        async:false,
        success: function(response){
           
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
           // var arr=Object.entries(json.row_info);
            //console.log(response);
            //val,0,
            
            //var case_number = jQuery('#case_number').val();
            jQuery('#search_area').hide();
            jQuery('#add_form').show();
            var rows = json.row_info;
            console.log(rows);
            if(rows!=null){
                //alert(rows.loan_ac)

                jQuery('#hc_matter_type').html(rows.hc_matter_type);
                jQuery('#loan_ac_ds').html(rows.ac_number);
                jQuery('#loan_ac_na').html(rows.ac_name);
                jQuery('#case_num').html(rows.case_no);
                //jQuery('#cma_id').val(rows.cma_id);
                //jQuery('#req_type').val(rows.req_type);
                //jQuery('#cma_district').val(rows.district);
                jQuery('#hc_id').val(rows.id);
                //jQuery("#expense_type_1").jqxComboBox('val',1);
                //jQuery("#vendor_id_1").jqxComboBox('val',rows.prest_lawyer_name);
            }else{
                alert("No Data Found");
            }
        }
    });

}


function load_case(row_info){
    jQuery("#expense_type_1").jqxComboBox('val',1);
    //var case_number = jQuery('#case_number').val();
    jQuery('#search_area').hide();
    jQuery('#add_form').show();
    var case_number = row_info.case_number;
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery('#action_form').jqxValidator('hide');
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/get_case_info",
        data : {[csrfName]: csrfHash,case_number:case_number},
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            //console.log(rows);
            if(rows!=null){
                //alert(rows.loan_ac)

                jQuery('#loan_ac_ds').html(rows.loan_ac);
                jQuery('#loan_ac_na').html(rows.ac_name);
                jQuery('#case_num').html(case_num);
                jQuery('#cma_id').val(rows.cma_id);
                jQuery('#suit_id').val(rows.id);
            }
        }
    });
}


// Billing Information 
    function get_expense_activities(type,counter,req_type)
    {
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?=base_url()?>index.php/authorization_request/get_activities',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,type : type,req_type:req_type},
        datatype: "json",
        success: function(response){
            var json = jQuery.parseJSON(response);
            //console.log(json)
            jQuery('.txt_csrfname').val(json.csrf_token);
            var str='';
            var theme = getDemoTheme();
                var expense_activities = [];
                if(json.status=='success')
                {
                    jQuery.each(json['row_info'],function(key,obj){
                        expense_activities.push({ value: obj.id, label: obj.name });
                    });
                }
                jQuery("#activities_name_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight:150, promptText: "Select Activity", source: hc_activites, width: 200, height: 25});
                    jQuery('#activities_name_'+counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        });
    }
    function change_vendor(id,counter)
    {
        var theme = getDemoTheme();
        var item = jQuery("#"+id).jqxComboBox('getSelectedItem');
        jQuery("#district_"+counter).jqxComboBox('clearSelection');
        jQuery("#district_"+counter).val('');
        jQuery("#district_"+counter).hide();

        var req_type = jQuery("#req_type").val();
        if (item!=null)
        {
            if (item.value==1)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                select_lawyer(counter);
            }else if(item.value==4)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                select_lawyer(counter);
            }else if(item.value==2)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }else if(item.value==3)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#district_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }
            else if(item.value==5)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#district_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }
            else{
                jQuery("#vendor_id_"+counter).hide();
                jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
                jQuery("#vendor_id_"+counter).val('');
                document.getElementById('vendor_name_'+counter).style.display = 'block';
                //get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }
            
        }else{
            jQuery("#vendor_id_"+counter).hide();
            jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
            jQuery("#vendor_id_"+counter).val('');
            document.getElementById('vendor_name_'+counter).style.display = 'block'
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
                        jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 200, height: 25});
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
    function add_more_expense()
    {
        var theme = getDemoTheme();
        var counter = jQuery('#expense_counter').val();
        var cma_district = jQuery('#cma_district').val();
        var req_type = jQuery('#req_type').val();
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
            html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" _onchange="get_expense_amount(\'activities_name_'+new_counter+'\','+new_counter+')"></div></td>';
            html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:90%;" id="activities_date_'+new_counter+'" value="" ></td>';
            html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
            html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
            html_string += '</tr>';

        jQuery('#expense_' + counter).after(html_string);
        jQuery('#expense_counter').val(new_counter);
        
        jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, height: 25});
        jQuery('#expense_type_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false,dropDownHeight:150, promptText: "Select Activity", source: hc_activites, height: 25});
        jQuery('#activities_name_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
        jQuery('#district_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        datePicker('activities_date_'+new_counter);
        
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
    function delete_row_expense (row_id) {
        jQuery('#expense_' + row_id).hide();
        jQuery('#expense_delete_' + row_id).val(1);
    }
    function get_expense_amount(act_id,counter) 
    {
        var theme = getDemoTheme();
        var cma_district = jQuery('#cma_district').val();
        var req_type = jQuery('#req_type').val();
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
</script>
<script type="text/javascript">
 
    </script>
<div id="container">
    <div id="body">
        <table class="">
            <tr id="widgetsNavigationTree">
                <td valign="top" align="left" class='navigation'>
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('hc_matter/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->
                </td>
                <td valign="top" id="demos" class='rc-all content'>
                    <div id="preloader">
                      <div id="camera"></div>
                    </div>
                    <div id="">
                    <div id='jqxTabs'>
                        <ul>
                            <li style="margin-left: 30px;">Form</li>
                            <li>Data Grid</li>
                        </ul>
                        <!---==== First Tab Start ==========----->
                        <div style="overflow: hidden;">
                            <div id="search_area">
                            <form method="POST" name="form" id="form"  style="margin:0px;">
                                 <input type="hidden" id="s_hidden_loan_ac" value="" name="s_hidden_loan_ac">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                               <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;_width:70%">
                                        <tr>
                                            <td><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                            <td><div id="s_proposed_type" name="s_proposed_type"></div></td>
                                            <td style="width: 100px;"><strong><span id="s_l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
                                            <td><input name="s_account" tabindex="" type="text" class="" maxlength="16" size="16" style="width:200px" id="s_account" value="" onKeyUp="javascript:return s_mask(this.value,this);"/>
                                            <td><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                            <td><input type="text" id="s_case_number" name="s_case_number" style="width:100%" /></td>
                                            <td><strong>limit&nbsp;&nbsp;</strong> </td>
                                            <td><div id="limit" name="limit"></div></td>
                                            <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                            </td>
                                        </tr>
                                    </table>
                              </div>
                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                              <div id="searchTable"></div>
                            </form>
                            </div>
                           <div id="add_form" style="padding: 10px;display: none;">
                            <form class="form" name="action_form" id="action_form" method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" id="add_edit" value="add" name="add_edit">
                                <input type="hidden" id="edit_row" value="" name="edit_row">
                                <input type="hidden" id="hc_id" value="" name="hc_id">
                                <input type="hidden" id="module" value="AD Matter" name="module">
                                <table style="width: 100%;">
                                    
                                    <tr>
                                        
                                        <td width="100%" colspan="4">
                                            <table border="1" cellpadding="5">
                                                <tr>
                                                    <td><b>High Court Matter Type</b></td>
                                                    <td><b>Loan Account</b></td>
                                                    <td><b>Account Name</b></td>
                                                    <td><b>Case Number</b></td>
                                                </tr>
                                                <tr>
                                                    <td id="hc_matter_type"></td>
                                                    <td id="loan_ac_ds"></td>
                                                    <td id="loan_ac_na"></td>
                                                    <td id="case_num"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                                   <!---- Billing Section  ---->
                                   <tr>
                                        <td colspan="4" width="100%">
                                            <table style="width: 100%;" border="1" id="table">
                                                
                                                <thead>
                                                <tr style="background-color: #d9f0ff;">
                                                    <td colspan="7"><b>Billing Info</b></td>
                                                </tr>
                                                <input type="hidden" name="expense_counter" id="expense_counter" value="1">
                                                <input type="hidden" name="req_type" id="req_type" value="">
                                                <input type="hidden" name="cma_district" id="cma_district" value="">
                                                <input type="hidden" name="batch_no" id="batch_no" value="">
                                                <tr>
                                                    <td width="4%" style="font-weight: bold;text-align:center">D</td>
                                                    <td width="18%" style="font-weight: bold;text-align:center">Expense Type<span style="color:red">*</span></td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Vendor Name<span style="color:red">*</span></td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Activities Name<span style="color:red">*</span></td>
                                                    <td width="10%" style="font-weight: bold;text-align:center">Activities Date<span style="color:red">*</span></td>
                                                    <td width="10%" style="font-weight: bold;text-align:center">Total Amount<span style="color:red">*</span></td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
                                                </tr>
                                                </thead>
                                                <tbody id="expense_body">
                                                    <tr id="expense_1">
                                                            <td></td>
                                                            <td>
                                                                <input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">
                                                                <input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">
                                                                <div id="expense_type_1" name="expense_type_1" style="padding-left: 3px;margin-left:5px" onchange="change_vendor('expense_type_1',1)"></div>
                                                            </td>
                                                            <td width="200">
                                                                <div id="district_1" name="district_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data(1)"></div>
                                                                <div id="vendor_id_1" name="vendor_id_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%"></div>
                                                                <input name="vendor_name_1" type="text" class="" style="width:202px" id="vendor_name_1" />
                                                            </td>
                                                            <td><div id="activities_name_1" name="activities_name_1" style="padding-left: 3px;margin-left:5px;width:90%" _onchange="get_expense_amount('activities_name_1',1)"></div></td>
                                                            <td><input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:90%;" id="activities_date_1" value="" ><script type="text/javascript" charset="utf-8">datePicker ("activities_date_1");</script></td>
                                                            <td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>
                                                            <td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr id="add_guarantor_row">
                                                        <td colspan="9" style="text-align: right">
                                                            Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
                                </table>
                            </form>
                            </div>
                        </div>
                        <!---==== Second Tab Start ==========----->
                        <div style="overflow: hidden;_overflow-y: scroll;">
                             <!-- <form method="POST" name="form" id="form"  style="margin:0px;">
                               <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;width:100%">
                                        <tr>
                                            <td style="text-align:right;width:5%"><strong>Case Number&nbsp;&nbsp;</strong> </td>
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
                            <br> -->
                            <div style="border:none;" id="jqxGrid2"></div>
                            <div style="float:left;padding-top: 5px;margin-left: 5px;margin-bottom: 20px;">
                            <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                            
                                <strong>E = </strong> Edit,&nbsp;
                                <strong>D = </strong> Delete,&nbsp;
                                <strong>STC = </strong> Send to Checker,&nbsp;
                                <strong>V = </strong> Verify,&nbsp;
                                <strong>P = </strong> Preview&nbsp;
                               
                            </div>
                            </div>
                            
                        </div>
                    </div>
                    <div>
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
        <input name="module_name" id="module_name" value="" type="hidden">
        <div id="previewtable"></div>
        <div id="preview" class="wrapper">
            </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
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
        <div id="sendtochecker" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <input type="button" class="buttonSend" id="sendtochecker_button" value="Send to Checker">
            <input type="button" class="buttonclose" id="sendtocheckercancel" onclick="close()" value="Cancel">
            <span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div>
        <!-- <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <input type="button" class="buttonSend" id="verify_button" value="Verify">
            <input type="button" class="buttonclose" id="verifycancel" onclick="close()" value="Cancel">
            <span id="verify_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div> -->

         <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
            <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                <table style="margin-left: 300px;margin-top: 0px;">
                    <tr id="verify_return_row" style="display:none">
                        <td>Reason<span style="color: red;">*</span></td>
                        <td>
                            <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="buttonSend" id="verify_button" value="Approve">
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
<script>

jQuery('#jqxGrid2').ready(function() {

    jQuery('#camera').fadeOut(); // will first fade out the loading animation 
    jQuery('#preloader').delay( 300 ).fadeOut( 'slow'); // will fade out the white DIV that covers the website. 
    jQuery('#dddd').css( { 'display': 'block' } );
    
});
</script>