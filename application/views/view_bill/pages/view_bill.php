<style type="text/css">
    #details {
     font-family: Arial, Helvetica, sans-serif;
     border-collapse: collapse;
     width: 100%;
   }




</style>
<style id="print_style" type="text/css">
</style>

<?php   
    $region = $this->User_model->get_parameter_data('ref_region','name','data_status = 1  AND id in(1,2,3,4)');
 ?>
<script type="text/javascript">
    var start=1990;
    let date =  new Date().getFullYear();
    var year = [];
    for (var i = date; i >=start; i--) {
        year.push({ value: i, label: i });
    }
    var staff = [<? $i=1; foreach($staff as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->pin.')"}'; $i++;}?>];
    var bill_type = [<? $i=1; foreach($bill_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var vendor = [<? $i=1; foreach($vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
     var region = [<? $i=1; foreach($region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
     var month = [
        {value:'1',label:'January'},
        {value:'2',label:'February'},
        {value:'3',label:'March'},
        {value:'4',label:'April'},
        {value:'5',label:'May'},
        {value:'6',label:'June'},
        {value:'7',label:'July'},
        {value:'8',label:'August'},
        {value:'9',label:'September'},
        {value:'10',label:'October'},
        {value:'11',label:'November'},
        {value:'12',label:'December'},
    ];
    var district = [];
    var territory = [];
    jQuery().ready(function() {
    var theme = getDemoTheme();
    jQuery("#year").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Year", source: year, width: 100, height: 25});
    jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select District", source: district, width: 100, height: 25});
    jQuery("#territory").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Territory", source: territory, width: 100, height: 25});
    jQuery("#region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Region", source: region, width: 100, height: 25});
    jQuery("#bill_month").jqxDropDownList({theme: theme,checkboxes: true, autoDropDownHeight: false, promptText: "Bill Month",filterable: true,searchMode: 'containsignorecase', source: month, width: 110, height: 25});
      var vendor = [];
     jQuery("#vendor").jqxComboBox({theme: theme, autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 100, height: 25,disabled:false});
    jQuery("#bill_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Bill Type", source: bill_type, width: 100, height: 25});
        jQuery('#bill_type,#region,#territory,#district,#year').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
     });

        jQuery('#region').bind('change', function (event) {
                change_dropdown('region');      
            });
            jQuery('#territory').bind('change', function (event) {
                    change_dropdown('territory');       
            });
    });
    function change_vendor(id)
    {
        var theme = getDemoTheme();
        jQuery('#bill_view_form').jqxValidator('hide');
        var item = jQuery("#"+id).jqxComboBox('getSelectedItem');
        var width_val = 195;
        if (item!=null)
        {
            if (item.value==1 || item.value==4)
            {
                jQuery("#vendor").show();
                jQuery("#vendor").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: width_val, height: 25});
                jQuery("#vendor_name").hide();
                jQuery("#vendor_name").val('');
                jQuery('#vendor').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
            }else if(item.value==2)
            {
                jQuery("#vendor").show();
                jQuery("#vendor").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: width_val, height: 25});
                jQuery("#vendor_name").hide();
                jQuery("#vendor_name").val('');
                jQuery('#vendor').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
            }
            else if(item.value==3 || item.value==5)
            {
                jQuery("#vendor").show();
                jQuery("#vendor").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: width_val, height: 25});
                jQuery("#vendor_name").hide();
                jQuery("#vendor_name").val('');
                jQuery('#vendor').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
            }
            else{
                jQuery("#vendor").hide();
                jQuery("#vendor").jqxComboBox('clearSelection');
                jQuery("#vendor").val('');
                jQuery("#vendor_name").show();
            }
        }else{
            jQuery("#vendor").hide();
            jQuery("#vendor").jqxComboBox('clearSelection');
            jQuery("#vendor").val('');
            jQuery("#vendor_name").show();
        }
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
                { input: '#bill_type', message: 'required!', action: 'blur,change,keyup', rule: function (input) {                  
                    if(input.val() != '')
                    {
                        var item = jQuery("#bill_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='bill_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#bill_type input").focus();
                        return false;
                    }
                }  
                }
        );
        // var item = jQuery("#bill_type").jqxComboBox('getSelectedItem');
        // if (item!=null)
        // {
        //     if (item.value==1 || item.value==2 || item.value==3 || item.value==4 || item.value==5) 
        //     {
        //         rules.push(
        //             { input: '#vendor', message: 'required!', action: 'blur,change,keyup', rule: function (input) {                 
        //                 if(input.val() != '')
        //                 {
        //                     var item2 = jQuery("#vendor").jqxComboBox('getSelectedItem');
        //                     if(item2 != null){jQuery("input[name='vendor']").val(item2.value);}
        //                     return true;                
        //                 }
        //                 else
        //                 {
        //                     jQuery("#vendor input").focus();
        //                     return false;
        //                 }
        //             }  
        //             }
        //         );
        //     }
        //     else
        //     {
        //         rules.push(
        //             { input: '#vendor_name', message: 'required!', action: 'blur,change,keyup', rule: function (input) {                    
        //                 if(input.val() != '')
        //                 {
        //                     return true;                
        //                 }
        //                 else
        //                 {
        //                     jQuery("#vendor_name").focus();
        //                     return false;
        //                 }
        //             }  
        //             }
        //         );
        //     }
        // }
        jQuery('#bill_view_form').jqxValidator({
              rules: rules, theme: theme
        });
        var validationResult = function (isValid) {
            if (isValid) {
                call_service();
            }
        }
        jQuery('#bill_view_form').jqxValidator('validate', validationResult);
    }
    function call_service()
    {
        jQuery("#bill_data").html('');
        var postData = jQuery('#bill_view_form').serialize();
        var vendor_name = jQuery("#vendor_name").val();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?php echo base_url(); ?>index.php/view_bill/get_expense_data',
        async:false,
        type: "post",
        data: postData,
        datatype: "json",
        success: function(response){
            var json = jQuery.parseJSON(response);
                    var  csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    jQuery("#bill_data").append(json.str);
                    jQuery("#xl_search").show();
          },
            error:   function(model, xhr, options){
                alert('failed');
            },
        });
    }
    function change_dropdown(operation,edit=null)
    {
        var id='';
        //check for add Region action
        if (edit==null) 
        {
            id = jQuery("#"+operation).val();
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
        data: {[csrfName]: csrfHash,id : id,operation:operation},
        datatype: "json",
        success: function(response){
            var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str='';
                    var theme = getDemoTheme();
                    if (operation=='region') 
                    {
                        //alert('str');
                        var territory = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            territory.push({ value: obj.id, label: obj.name });
                            //alert(obj.name);
                        });
                        jQuery("#territory").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select territory", source: territory, width: 100, height: 25});
                        //For edit action
                    }
                    if (operation=='territory') 
                    {
                        var district = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            district.push({ value: obj.id, label: obj.name });
                        });
                        jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: 100, height: 25});
                    
                    }

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
            });

            return false;
    }
    function PrintTable() {
        var printWindow = window.open('', '', 'height=700,width=1000');
        printWindow.document.write('<html><head> <meta charset="utf-8"/><title>Table Contents</title>');
 
        //Print the Table CSS.
        var table_style = document.getElementById("print_style").innerHTML;
        printWindow.document.write('<style type = "text/css" media="print">');
        printWindow.document.write(table_style);
        printWindow.document.write('table tr td,table tr th{-moz-border:1px solid #000!important;border:1px solid #000!important;}');
        printWindow.document.write('</style>');
        printWindow.document.write('</head>');
 
        //Print the DIV contents i.e. the HTML Table.
        printWindow.document.write('<body>');
        var divContents = document.getElementById("grid_table_div").innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
<style type="text/css">
	th{border-color: #ccc;}
</style>

<div id="container" style="">
    <div id="body"  >
        <div  style="display:block; height:auto">
            <form method="POST" name="bill_view_form" id="bill_view_form"  style="margin:0px;" action="<?php echo base_url('View_bill/download_xl'); ?>">
            <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
               <div style="padding: 0.5%;width:98%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                    <table id="deal_body" style="display:block;width:100%">
                        <tr>
                            <td style="text-align:right;width:6%"><strong>Year&nbsp;&nbsp;</strong> </td>
                            <td style="width:6%"><div id="year" name="year" style="padding-left: 3px"></div></td>
                            <td style="text-align:right;width:6%"><strong>Month&nbsp;&nbsp;</strong> </td>
                            <td style="width:6%"><div id="bill_month" name="bill_month" style="padding-left: 3px"></div></td>
                            <td style="text-align:right;width:5%"><strong>Type&nbsp;&nbsp;</strong> </td>
                            <td style="width:6%"><div id="bill_type" name="bill_type" style="padding-left: 3px" onchange="change_vendor('bill_type')"></div></td>
                            <td style="text-align:right;width:6%"><strong>Vendor</strong> </td>
                            <td style="width:6%"><div id="vendor" name="vendor" tabindex="8" style="padding-left: 3px;display:none;float:left"></div>
                            <input name="vendor_name" tabindex="9" type="text" class="" style="width:195px;float:left" id="vendor_name" /></td>
                            <td style="text-align:right;width:5%"><strong>Region&nbsp;&nbsp;</strong> </td>
                            <td style="width:6%"><div id="region" name="region" style="padding-left: 3px"></div></td>
                            <td style="text-align:right;width:5%"><strong>Territory&nbsp;&nbsp;</strong> </td>
                            <td style="width:6%"><div id="territory" name="territory" style="padding-left: 3px"></div></td>
                            <td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
                            <td style="width:6%"><div id="district" name="district" style="padding-left: 3px"></div></td>
                            <td  style="text-align:right;width:4%">
                                <input name="generate" id="generate" class="crmbutton small create" style="width:50px;margin-left:5px"  value="View" type="button" onclick="load_expense()">
                                <div style="text-align:center"><span id="grid_loading" style="display:none"><img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                            </td>
                            <td style="text-align:left;width:13%">
                                <button type='submit' formtarget="_blank" name='xl_search' id="xl_search" value='Search' style="width:58px;border: none;background: transparent;display: none;"><img src="<?=base_url()?>images/icon_xls.gif" width="20px" height="20px"></button>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:right;width:6%"><strong>From&nbsp;&nbsp;</strong> </td>
                            <td style="width:6%"><input type="text" name="dt_from" placeholder="dd/mm/yyyy" style="width:100px;" id="dt_from" value="" ><script type="text/javascript" charset="utf-8">datePicker ("dt_from");</script></td>
                            <td style="text-align:right;width:6%"><strong>To&nbsp;&nbsp;</strong> </td>
                            <td style="width:6%"><input type="text" name="dt_to" placeholder="dd/mm/yyyy" style="width:100px;" id="dt_to" value="" ><script type="text/javascript" charset="utf-8">datePicker ("dt_to");</script></td>
                            <td style="text-align:right;width:5%"><button type="button" onclick="PrintTable()">Print</button></td>
                            <td style="width:6%"></td>
                            <td style="text-align:right;width:6%"></td>
                            <td style="width:6%">
                            </td>
                            <td style="text-align:right;width:5%"></td>
                            <td style="width:6%"></td>
                            <td style="text-align:right;width:5%"></td>
                            <td style="width:6%"></td>
                            <td style="text-align:right;width:5%"></td>
                            <td style="width:6%"></td>
                            <td  style="text-align:right;width:4%">
                                
                            </td>
                            <td style="text-align:left;width:13%">
                                
                            </td>
                        </tr>

                    </table>
              </div>
            </form>
        </div>
    </div>
</div>

<span id="bill_data"></span>



<script type="text/javascript">
    
</script>
