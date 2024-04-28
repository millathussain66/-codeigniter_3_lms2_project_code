<style type="text/css">
    #details {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }



    .result_table th {
        background: rgb(176, 182, 187);

    }

    #result_table {
        font-size: 13px !important;
    }
    @media print {
    @page {
        size: A4 portrait;
        margin: 2 0 0 0;
    }}
</style>




<script type="text/javascript">
    var dropdown_list = [<? $i = 1;
                            foreach ($dropdown_list as $row => $value) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row . '", label:"' . $value . '"}';
                                $i++;
                            } ?>];
    //console.log(dropdown_list)
    jQuery().ready(function() {
        var theme = getDemoTheme();
        jQuery("#dropdown_list").jqxDropDownList({
            theme: theme,
            autoDropDownHeight: false,
            dropDownHeight: 100,
            source: dropdown_list,
            width: 158,
            height: 25
        });
        jQuery("#dropdown_list").jqxDropDownList('val', '<?= $dropdown_select; ?>');
        jQuery('#dropdown_list').bind('change', function() {
            var val = jQuery('#dropdown_list').val();
            if (val == '0') {
                return false;
            }
            var url = "<?= base_url() ?>index.php/" + val + "/<?= $menu_group ?>/<?= $menu_cat ?>";
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });
    });

    function popup(url) {

        var heightReduc = 100;
        var widthReduce = 140;

        var pwidth = screen.width - 140;
        var pheight = screen.height - 100;
        var wint = 140 / 2;
        var winl = 100 / 2;

        newwindow = window.open(url, 'name', "height=" + pheight + ", width=" + pwidth + ",top=" + wint + ", toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left=" + winl);
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }
</script>
<?php if ($option == 'generate_statement') { ?><!-- Statement Generate View -->

    <script language="javascript" type="text/javascript">
        var proposed_type = ["Loan", "Card"];
        var req_type = [<? $i = 1;
                        foreach ($req_type as $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                            $i++;
                        } ?>];
        jQuery().ready(function() {
            jQuery("#loan_ac").val('');
            jQuery("#hidden_loan_ac").val('');
            var theme = getDemoTheme();
            jQuery("#int_rate_chq").jqxCheckBox({
                width: 22,
                theme: theme,
                checked: false
            });
            jQuery("#int_rate_available").val(0);
            jQuery("#int_rate").val('');
            jQuery("#proposed_type").jqxComboBox({
                theme: theme,
                width: 150,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Proposed Type",
                source: proposed_type,
                height: 25
            });
            jQuery("#req_type").jqxComboBox({
                theme: theme,
                width: 150,
                autoDropDownHeight: false,
                promptText: "Select Requisition Type",
                source: req_type,
                height: 25
            });
            jQuery('#proposed_type,#req_type').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
            jQuery("#proposed_type").jqxComboBox('val', 'Loan');
            change_caption();
            jQuery('#proposed_type').bind('change', function(event) {
                jQuery("#loan_ac").val('');
                jQuery("#hidden_loan_ac").val('');
                change_caption();
            });
            jQuery("#int_rate_chq").bind('change', function(event) {
                var checked = event.args.checked;
                if (checked == true) {
                    jQuery("#int_rate_available").val('1');
                    document.getElementById("int_rate").disabled = false;
                } else {
                    document.getElementById("int_rate").disabled = true;
                    jQuery("#int_rate_available").val('0');
                    jQuery("#int_rate").val('');
                }
            });
            jQuery("#generate").click(function() {
                jQuery("#statement_data").html('');
                document.getElementById('statement_xl').innerHTML = '';
                jQuery("#loader_td").hide();
                jQuery("#xl_td").hide();
                jQuery("#st_loaded").hide();
                jQuery("#stg_loaded").hide();
                var validationResult = function(isValid) {
                    if (isValid) {
                        jQuery("#generate").hide();
                        jQuery("#grid_loading").show();
                        load_statement();
                    }
                }
                jQuery('#form').jqxValidator('validate', validationResult);
            });
            jQuery('#form').jqxValidator({
                rules: [{
                        input: '#proposed_type',
                        message: 'required!',
                        action: 'blur,change',
                        rule: function(input) {
                            if (input.val() != '') {
                                var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                                if (item != null) {
                                    jQuery("input[name='proposed_type']").val(item.value);
                                }
                                return true;
                            } else {
                                jQuery("#proposed_type input").focus();
                                return false;
                            }
                        }
                    },
                    {
                        input: '#loan_ac',
                        message: 'required!',
                        action: 'keyup, blur',
                        rule: function(input, commit) {
                            if (jQuery("#loan_ac").val() == '') {
                                jQuery("#loan_ac").focus();
                                return false;
                            } else {
                                return true;
                            }

                        }
                    },
                    {
                        input: '#loan_ac',
                        message: 'only numeric',
                        action: 'keyup, blur, change',
                        rule: function(input, commit) {
                            if (input.val() != '') {
                                if (!checknumber_alphabaticwithstar('loan_ac')) {
                                    jQuery("#loan_ac").focus();
                                    return false;

                                }
                            }
                            return true;

                        }
                    },
                    {
                        input: '#loan_ac',
                        message: 'must be 16 digits',
                        action: 'keyup, blur, change',
                        rule: function(input, commit) {
                            if (input.val() != '') {
                                if (input.val().length < 16 || input.val().length > 16) {
                                    jQuery("#loan_ac").focus();
                                    return false;

                                }
                            }
                            return true;

                        }
                    },
                    {
                        input: '#req_type',
                        message: 'required!',
                        action: 'blur,change',
                        rule: function(input) {
                            if (input.val() != '') {
                                var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
                                if (item != null) {
                                    jQuery("input[name='req_type']").val(item.value);
                                }
                                return true;
                            } else {
                                jQuery("#req_type input").focus();
                                return false;
                            }
                        }
                    },
                    {
                        input: '#dt_from',
                        message: 'required!',
                        action: 'keyup, blur, change',
                        rule: function(input, commit) {
                            if (jQuery("#dt_from").val() == '') {
                                jQuery("#dt_from").focus();
                                return false;
                            } else {
                                return true;
                            }
                        }
                    },
                    {
                        input: '#dt_from',
                        message: 'Invalid',
                        action: 'keyup, blur, change',
                        rule: function(input, commit) {
                            if (!input.val()) {
                                return true;
                            }
                            if (validate_date(input.val())) {
                                return true;
                            } else {
                                jQuery("#dt_from").focus();
                                return false;
                            }
                        }
                    },
                    {
                        input: '#int_rate',
                        message: 'required!',
                        action: 'keyup, blur',
                        rule: function(input, commit) {
                            if (jQuery("#int_rate").val() == '' && jQuery("#int_rate_available").val() == '1') {
                                jQuery("#int_rate").focus();
                                return false;
                            } else {
                                return true;
                            }

                        }
                    },
                    // {input: '#dt_from', message: 'Advance date not allow!', action: 'change', rule: function(input) {
                    //         if(input.val()!=""){return validateDate(input.val(),'advance');}else{return true;}
                    //     }
                    // },
                    {
                        input: '#dt_to',
                        message: 'required!',
                        action: 'keyup, blur, change',
                        rule: function(input, commit) {
                            if (jQuery("#dt_to").val() == '') {
                                jQuery("#dt_to").focus();
                                return false;
                            } else {
                                return true;
                            }
                        }
                    },
                    {
                        input: '#dt_to',
                        message: 'Invalid',
                        action: 'keyup, blur, change',
                        rule: function(input, commit) {
                            if (!input.val()) {
                                return true;
                            }
                            if (validate_date(input.val())) {
                                return true;
                            } else {
                                jQuery("#dt_to").focus();
                                return false;
                            }
                        }
                    },
                    // {input: '#dt_to', message: 'Advance date not allow!', action: 'change', rule: function(input) {
                    //         if(input.val()!=""){return validateDate(input.val(),'advance');}else{return true;}
                    //     }
                    // },
                    {
                        input: '#dt_to',
                        message: 'Old Date Not allowed !',
                        action: 'change',
                        rule: function(input, commit) {
                            if (input.val() != "") {
                                return expiry_dt_validation();
                            } else {
                                return true;
                            }
                        }
                    }

                ]
            });
        });

        function expiry_dt_validation() {
            date1 = jQuery("#dt_from").val();

            var str_subsdt = date1.split("/")
            var subsdt = str_subsdt[1] + "/" + str_subsdt[0] + "/" + str_subsdt[2];
            var subdt = new Date(subsdt);

            date2 = jQuery("#dt_to").val();

            var str_subsdt2 = date2.split("/")
            var subsdt2 = str_subsdt2[1] + "/" + str_subsdt2[0] + "/" + str_subsdt2[2];
            var subdt2 = new Date(subsdt2);

            if (Date.parse(subdt) > Date.parse(subdt2)) {
                return false;
            }

            return true;
        }

        function change_caption() {
            if (jQuery("#proposed_type").val() == '') {
                document.getElementById("loan_ac").disabled = true;
                jQuery("#l_or_c_no").html('Loan/Card');
                jQuery("#int_rate_tr").show();
            } else {
                document.getElementById("loan_ac").disabled = false;
                var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                if (item.value == 'Loan') {
                    jQuery("#l_or_c_no").html('Loan A/C ');
                    jQuery("#int_rate_tr").show();
                } else if (item.value == 'Card') {
                    jQuery("#l_or_c_no").html('Card');
                    jQuery("#int_rate_tr").hide();
                }
            }

        }

        function mask(str, textbox) {
            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
            if (item != null) {
                if (item.value == 'Card') {
                    if (!str.includes("*") && str.length == 16) //For one time value paste
                    {
                        var length = str.length;
                        var first_6 = str.slice(0, 6);
                        var mid = '******';
                        var last_6 = str.slice(12, 16);
                        var final_str = first_6 + mid + last_6;
                        textbox.value = final_str
                        jQuery("#hidden_loan_ac").val(str);
                    } else //For single value enter
                    {
                        //For New value
                        var orginal_loan_ac = jQuery("#hidden_loan_ac").val();
                        if (orginal_loan_ac.length < str.length) {
                            var index = str.length - 1;
                            var new_val = str.slice(index);
                            orginal_loan_ac += new_val;
                            //alert(orginal_loan_ac);
                            jQuery("#hidden_loan_ac").val(orginal_loan_ac);
                        }
                        //For delete key
                        else {
                            var len = str.length;
                            var new_val = orginal_loan_ac.slice(0, len);
                            jQuery("#hidden_loan_ac").val(new_val);
                        }
                        //For First 6 key
                        if (str.length <= 6) {
                            textbox.value = str
                        }
                        //for the last 4 key
                        else if (str.length >= 13) {
                            textbox.value = str
                        }
                        //For the middle 4 key
                        else {
                            var length = str.length;
                            var first_6 = str.slice(0, 6);
                            var mid = (str.length - 6);
                            var final_str = first_6;
                            for (var i = 1; i <= mid; i++) {
                                final_str += '*';
                            }
                            textbox.value = final_str
                        }

                        if (str.length == 16) //wrong input check
                        {
                            var letter_Count = 0;
                            var letter = '*';
                            for (var position = 0; position < str.length; position++) {
                                if (str.charAt(position) == letter) {
                                    letter_Count += 1;
                                }
                            }
                            if (letter_Count < 6 || jQuery("#hidden_loan_ac").val().length != 16) {
                                textbox.value = '';
                                jQuery("#hidden_loan_ac").val('');
                                alert('Wrong way to input Card No please try again');
                            }
                        }
                    }
                }
            }

        }

        function load_statement() {
            jQuery("#statement_data").html('');
            document.getElementById('statement_xl').innerHTML = '';
            jQuery("#save").hide();
            jQuery("#deleteEventId").val('');
            jQuery("#prev_statement").val('');
            var postData = jQuery('#form').serialize();
            jQuery("#st_loading").show();
            jQuery("#loader_td").show();
            var dt_from = jQuery("#dt_from").val();
            var dt_to = jQuery("#dt_to").val();
            var bb_rate = jQuery("#bb_rate").val();
            var req_type = jQuery("#req_type").val();
            jQuery("#final_dt").val('');
            jQuery("#final_belance").val('');
            var loan_ac = jQuery("#loan_ac").val();
            var proposed_type = jQuery("#proposed_type").val();
            jQuery.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: '<?= base_url() ?>index.php/hoops/load_statement/',
                data: postData,
                datatype: "json",
                success: function(response) {
                    ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    if (json.str == 'ok') {
                        if (json.cma_id != '') {
                            jQuery("#deleteEventId").val(json.cma_id);
                        } else {
                            jQuery("#deleteEventId").val('');
                        }
                        jQuery("#st_loading").hide();
                        jQuery("#st_loaded").show();
                        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                        //Calling Another Ajax to load html and xl
                        jQuery("#stg_loading").show();
                        jQuery.ajax({
                            type: "POST",
                            cache: false,
                            async: false,
                            url: '<?= base_url() ?>index.php/hoops/generate_xl_html/',
                            data: {
                                [csrfName]: csrfHash,
                                proposed_type: proposed_type,
                                id: json.cma_id,
                                dt_from: dt_from,
                                dt_to: dt_to,
                                req_type: req_type,
                                glob_sts: json.glob_sts,
                                glob_ac: json.glob_ac,
                                bb_rate: bb_rate,
                                int_rate: json.int_rate,
                                loan_ac: loan_ac
                            },
                            datatype: "json",
                            success: function(response) {
                                ///console.log(response);
                                var json2 = jQuery.parseJSON(response);
                                jQuery('.txt_csrfname').val(json2.csrf_token);
                                jQuery("#generate").show();
                                jQuery("#grid_loading").hide();
                                var str = '';
                                if (json2.str) {
                                    jQuery("#generate").show();
                                    jQuery("#grid_loading").hide();
                                    jQuery("#stg_loading").hide();
                                    jQuery("#stg_loaded").show();
                                    jQuery("#statement_data").html(json2.str);
                                    jQuery("#xl_td").show();
                                    jQuery("#final_dt").val(json2.final_dt);
                                    jQuery("#final_belance").val(json2.final_belance);
                                    if (json2.prev_file_path != '') {
                                        jQuery("#statement_body").show();
                                        jQuery("#prev_statement").val('json2.prev_file_path');
                                        jQuery("#prev_lib_statement").val('json2.prev_libality_statement');
                                        str += '<strong>Pre. AC Statement&nbsp;&nbsp;</strong><img id="prev_statement_img" onclick="popup(\'<?= base_url() ?>cma_file/generated_statement/' + json2.prev_file_path + '\')" style="cursor:pointer;text-align:center" height="18" src="<?= base_url() ?>images/icon_xls.gif">&nbsp;&nbsp;&nbsp;<strong>Pre. LIB Statement&nbsp;&nbsp;</strong><img id="prev_statement_img" onclick="popup(\'<?= base_url() ?>cma_file/generated_statement/' + json2.prev_libality_statement + '\')" style="cursor:pointer;text-align:center" height="18" src="<?= base_url() ?>images/icon_xls.gif">';

                                    }
                                    if (json2.new_file_path != '') {
                                        jQuery("#statement_body").show();
                                        if (json2.glob_sts == 0) {
                                            jQuery("#save").show();
                                        }
                                        str += '&nbsp;&nbsp;&nbsp;<strong>New AC Statement &nbsp;&nbsp;</strong><img id="new_statement_img" onclick="popup(\'<?= base_url() ?>temp_upload_file/' + json2.new_file_path + '\')" style="cursor:pointer;text-align:center" height="18" src="<?= base_url() ?>images/icon_xls.gif">&nbsp;&nbsp;&nbsp;<strong>New LIB Statement&nbsp;&nbsp;</strong><img id="new_statement_img" onclick="popup(\'<?= base_url() ?>temp_upload_file/' + json2.libality_statement + '\')" style="cursor:pointer;text-align:center" height="18" src="<?= base_url() ?>images/icon_xls.gif">';
                                    }
                                    <? if (DOWNLOAD == 1) { ?>
                                        document.getElementById('statement_xl').innerHTML = str;
                                    <? } ?>

                                }
                            }
                        });
                    } else {

                        alert(json.str);
                        jQuery("#loader_td").hide();
                        jQuery("#st_loading").hide();
                        jQuery("#st_loaded").show();
                        jQuery("#generate").show();
                        jQuery("#grid_loading").hide();
                    }
                }
            });

        }

        function call_ajax_submit() {
            if (jQuery('#deleteEventId').val() == '') {
                alert('Sorry There is no statement!');
                return false;
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = $('sendToCheckerMessageform').toQueryString() + "&" + csrfName + "=" + csrfHash;
            $('sendToCheckerMessageDialogConfirm').style.display = 'none';
            $('sendToCheckerMessageDialogCancel').style.display = 'none';
            $('loadingReturn').style.display = 'inline';
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?= base_url() ?>index.php/hoops/delete_action/',
                data: postData,
                datatype: "json",
                success: function(response) {
                    ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if (json.Message != 'OK') {
                        alert(json.Message);
                    } else {
                        sendToCheckerMessageDialog.hide();
                        $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                        $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                        $('loadingReturn').style.display = 'none';
                        jQuery("#save").hide();
                        jQuery("#error").show();
                        jQuery("#error").fadeOut(11500);
                        jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + jQuery("#success_message").val());
                    }
                }
            });

        }

        function delete_action(type) {
            var message = '';
            if (type == 'save_statement') {
                jQuery("#type").val(type);
                jQuery("#message").html('Save');
                jQuery("#button_tag").html('Save');
                jQuery("#success_message").val('Saved');
            }

            $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
            $('sendToCheckerMessageDialogCancel').style.display = 'inline';
            $('loadingReturn').style.display = 'none';
            sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {
                position: 'fixed',
                modal: true,
                width: 470,
                close: true,
                id: 'sendToCheckerMessageDialog'
            });
            sendToCheckerMessageDialog.show();
        }

        function close_window() {
            sendToCheckerMessageDialog.hide();
        }
    </script>
    <style type="text/css">
        th {
            border-color: #ccc;
        }
    </style>

    <div id="container" style="">
        <div id="body">
            <div style="display:block; height:auto">
                <form method="POST" name="form" id="form" style="margin:0px;" action="">
                    <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <input name="int_rate_available" type="hidden" id="int_rate_available" value="0" class="text-input" />
                    <div style="padding: 0.5%;width:98%;height:90px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                        <table id="deal_body" style="display:block;width:100%">
                            <tr>
                                <td style="text-align:right;width:3%"><strong>Menu&nbsp;&nbsp;</strong> </td>
                                <td style="width:14%">
                                    <div style="padding-left:1.8%" id="dropdown_list" name="dropdown_list"></div>
                                </td>
                                <td style="text-align:left;width:8%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:12%">
                                    <div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div>
                                </td>
                                <td style="text-align:left;width:9%"><strong>Requisition Type&nbsp;&nbsp;</strong> </td>
                                <td style="width:12%">
                                    <div style="padding-left:1.8%" id="req_type" name="req_type"></div>
                                </td>
                                <td style="text-align:right;width:8%"><strong><span id="l_or_c_no"></span> No.</strong> </td>
                                <td style="width:10%"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);" /></td>
                                <td style="text-align:left;width:6%"><strong>Date From&nbsp;&nbsp;</strong> </td>
                                <td style="width:8%"><input id="dt_from" name="dt_from" style="width:80%" />
                                    <script type="text/javascript">
                                        datePicker_without_advance("dt_from");
                                    </script>
                                </td>
                                <td style="text-align:left;width:1%"><strong>To </td>
                                <td style="width:8%"><input id="dt_to" name="dt_to" style="width:80%" />
                                    <script type="text/javascript">
                                        datePicker_without_advance("dt_to");
                                    </script>
                                </td>
                                <td style="text-align:right;width:5%">
                                    <input name="generate" id="generate" class="crmbutton small create" value="Generate" type="button">
                                    <div style="text-align:center"><span id="grid_loading" style="display:none"><img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>
                                </td>
                            </tr>
                            <tr id="int_rate_tr">
                                <td style="text-align:right;width:3%"><strong>Int.rate&nbsp;&nbsp;</strong></td>
                                <td style="width:14%">
                                    <div name="int_rate_chq" tabindex="40" id="int_rate_chq" style="float:left; margin: 3px 0px 0 0;"></div><input name="int_rate" tabindex="" type="text" class="" disabled style="width:120px" id="int_rate" value="" />
                                </td>
                                <td style="text-align:left;width:8%"><strong>Int.Rate(After 2020-Apr)</strong></td>
                                <td style="width:12%"><input name="bb_rate" tabindex="" type="text" class="" style="width:120px" id="bb_rate" value="9" /></td>
                                <td style="text-align:left;width:9%"></td>
                                <td style="width:12%"></td>
                                <td style="text-align:right;width:8%"></td>
                                <td style="width:10%"></td>
                                <td style="text-align:left;width:6%"></td>
                                <td style="width:8%"></td>
                                <td style="text-align:left;width:1%"></td>
                                <td style="width:8%"></td>
                                <td style="text-align:right;width:5%">

                                </td>
                            </tr>
                        </table>
                        <table id="statement_body" style="width:100%">
                            <tr>
                                <td id="loader_td" style="text-align:left;width:25%;display:none">
                                    <span id="st_loading" style="display:none">Loading Statement&nbsp;&nbsp;&nbsp;<img src="<?= base_url() ?>images/progress.gif" align="bottom" style="width:auto;height:15px"></span>
                                    <span id="st_loaded" style="display:none">Statement Loaded&nbsp;&nbsp;&nbsp;<img src="<?= base_url() ?>images/publish_g.png" align="bottom"></span>
                                    <span id="stg_loading" style="display:none">Generating Statement&nbsp;&nbsp;&nbsp;<img src="<?= base_url() ?>images/progress.gif" align="bottom" style="width:auto;height:15px"></span>
                                    <span id="stg_loaded" style="display:none">Statement Generated&nbsp;&nbsp;&nbsp;<img src="<?= base_url() ?>images/publish_g.png" align="bottom"></span>
                                </td>
                                <td id="xl_td" style="width:35%;display:none;">
                                    <span id="statement_xl"></span>&nbsp;&nbsp;&nbsp;
                                    <? if (PRINTSTATEMENT == 1) { ?>
                                        <input name="print" id="print" onclick="printDiv('grid_table_div')" class="crmbutton small create" value="Print" type="button" style="">
                                    <? } ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <? if (SAVE == 1) { ?>
                                        <input name="save" id="save" onclick="delete_action('save_statement')" class="crmbutton small create" value="Save Statement" type="button" style="display:none">
                                    <? } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <span id="statement_data"></span>

    <div id="sendToCheckerMessageDialogContent" style="display:none;">
        <div class="hd">
            <h2 class="conf" style="margin-top:0px">Previous Data will be replace Do you want to <span id="message"></span>?</h2>
        </div>
        <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform" style="margin-top:0px;">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="type" id="type" value="" type="hidden">
            <input name="prev_statement" id="prev_statement" value="" type="hidden">
            <input name="prev_lib_statement" id="prev_lib_statement" value="" type="hidden">
            <input name="success_message" id="success_message" value="" type="hidden">
            <input type="hidden" id="deleteEventId" name="deleteEventId" value="" />
            <input name="final_dt" id="final_dt" value="" type="hidden">
            <input name="final_belance" id="final_belance" value="" type="hidden">
            <div class="bd">
                <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
                <div class="instrText" style="margin-bottom: 20px"></div>
            </div>
            <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a>
            <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a>
            <span id="loadingReturn" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
        </form>
    </div>
    <script type="text/javascript">
        function printpage(print_area) {
            var pp = window.open();
            pp.document.writeln('<table style="width:100%; text-align:center; font-weight:bold;font-size: 3px !important;"><tr><td><img ID="PRINT" alt="Print" src="<?= base_url() ?>old_assets/images/Print.png" onclick="javascript:location.reload(true);window.print();">&nbsp;<img ID="CLOSE" alt="CLOSE" src="<?= base_url() ?>old_assets/images/close.png" onclick="window.close();"><br /><span style="font-weight:normal; color:green; font-size:8pt;" ID="mssgg" >Print in Portrait Page</span></td></tr><tr><td>');
            pp.document.writeln(document.getElementById(print_area).innerHTML);
        }


        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }







    </script>
<? } else if ($option == 'upload_recovery') { ?>
    <?php if (UPLOADRECOVERY == 1) : ?>
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                //jQuery('#sendButton').jqxButton({template:"success", width: 130, height: 40, theme: theme });
            });

            function fileValidation(name) {
                //alert(name);
                var fileInput = document.getElementById(name);
                var filePath = fileInput.value;
                var allowedExtensions = /(\.xlsx)$/i;
                var fileSize = document.getElementById(name).files[0].size;
                if (!allowedExtensions.exec(filePath)) {
                    alert('Only xls file is allowed');
                    fileInput.value = '';
                    return false;
                }
                return true;
            }

            function delete_action(type) {
                var message = '';
                if (type == 'save_recovery') {
                    jQuery("#type").val(type);
                    jQuery("#message").html('Save');
                    jQuery("#button_tag").html('Save');
                    jQuery("#success_message").val('Saved');
                }

                $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                $('loadingReturn').style.display = 'none';
                sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {
                    position: 'fixed',
                    modal: true,
                    width: 470,
                    close: true,
                    id: 'sendToCheckerMessageDialog'
                });
                sendToCheckerMessageDialog.show();
            }

            function close_window() {
                sendToCheckerMessageDialog.hide();
            }

            function call_ajax_submit() {
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                var postData = $('result_form').toQueryString() + "&" + csrfName + "=" + csrfHash;
                $('sendToCheckerMessageDialogConfirm').style.display = 'none';
                $('sendToCheckerMessageDialogCancel').style.display = 'none';
                $('loadingReturn').style.display = 'inline';
                jQuery.ajax({
                    type: "POST",
                    cache: false,
                    url: '<?= base_url() ?>index.php/hoops/delete_action/',
                    data: postData,
                    datatype: "json",
                    success: function(response) {
                        ///console.log(response);
                        var json = jQuery.parseJSON(response);
                        window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        if (json.Message != 'OK') {
                            alert(json.Message);
                        } else {
                            jQuery('#result_table').html('');
                            jQuery("#select_tag").show();
                            jQuery("#recovery_file").show();
                            jQuery("#save_button").hide();
                            jQuery("#load_button").show();
                            sendToCheckerMessageDialog.hide();
                            $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                            $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                            $('loadingReturn').style.display = 'none';
                            jQuery("#save").hide();
                            jQuery("#error").show();
                            jQuery("#error").fadeOut(11500);
                            jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + jQuery("#success_message").val());
                        }
                    }
                });

            }
        </script>
        <div id="container" style="">
            <div id="body">
                <div style="display:block; height:auto">
                    <form method="POST" name="form" id="form" style="margin:0px;" action="<?= base_url() ?>hoops/recovery_upload" enctype="multipart/form-data">
                        <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        <div style="padding: 0.5%;width:98%;height:55px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                            <table id="deal_body" style="display:block;width:100%">
                                <tr>
                                    <td style="text-align:right;width:1%"><strong>Menu&nbsp;&nbsp;</strong> </td>
                                    <td style="text-align:left;width:5%">
                                        <div style="padding-left:1.8%" id="dropdown_list" name="dropdown_list"></div>
                                    </td>
                                    <td style="text-align:left;width:15%">
                                        <strong id="select_tag">Select File : </strong><input type="file" name="recovery_file" id="recovery_file" onchange="fileValidation('recovery_file')">
                                        <input type="button" value="Load" id="load_button" class="buttonclose" style="width:70px !important;height:40px" />
                                        <input type="button" value="Save" id="save_button" onclick="delete_action('save_recovery')" class="buttonclose" style="width:70px !important;height:40px;display:none" />
                                        <span id="recovery_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                    </td>
                                    <td style="text-align:left;width:10%">
                                        <strong>Download Templete File : </strong> <a id="inXLadfc" style="margin-left:10px;text-align:center;cursor:pointer;" href="<?= base_url() ?>cma_file/statement_template/Templete.xlsx" target="_blank"><img align="center" src="<?= base_url() ?>images/download_002.png"></a>
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
        <form class="form" id="result_form" name="result_form" method="post" action="" enctype="">
            <input name="type" id="type" value="" type="hidden">
            <span id="result_table"></span>
        </form>
        <div id="sendToCheckerMessageDialogContent" style="display:none;">
            <div class="hd">
                <h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2>
            </div>
            <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform" style="margin-top:0px;">
                <input name="success_message" id="success_message" value="" type="hidden">
                <div class="bd">
                    <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
                    <div class="instrText" style="margin-bottom: 20px"></div>
                </div>
                <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a>
                <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a>
                <span id="loadingReturn" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </form>
        </div>
        <script type="text/javascript">
            var options = {
                complete: function(response) {
                    jQuery("#recovery_file").val('');
                    var json = jQuery.parseJSON(response.responseText);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if (json.Message != 'OK') {
                        jQuery("#load_button").show();
                        jQuery("#recovery_loading").hide();
                        alert('Something Went Wrong Please Try Again');
                        return false;
                    } else {
                        jQuery("#recovery_loading").hide();
                        jQuery('#result_table').html(json.str);
                        if (jQuery("#total_row").val() > 0) {
                            jQuery("#save_button").show();
                            jQuery("#load_button").hide();
                            jQuery("#select_tag").hide();
                            jQuery("#recovery_file").hide();
                        } else {
                            jQuery("#save_button").hide();
                            jQuery("#load_button").show();
                        }
                    }

                }
            };
            jQuery("#form").ajaxForm(options);
            jQuery("#load_button").click(function() {
                if (jQuery("#recovery_file").val() == '') {
                    alert('Please Select A file');
                    return false;
                } else {
                    jQuery("#load_button").hide();
                    jQuery("#recovery_loading").show();
                    jQuery("#form").submit();
                }
            });
        </script>
    <?php else : ?>
        <p align="center">Sorry No Access Given. Please Concatch with administrator!!</p>
    <?php endif ?>

<?php } else if ($option == 'update_recovery') { ?>
    <?php if (UPDATERECOVERY == 1) : ?>
        <script type="text/javascript">
            jQuery().ready(function() {
                var theme = getDemoTheme();
                jQuery("#r_history").jqxWindow({
                    theme: theme,
                    width: '100%',
                    height: '90%',
                    resizable: false,
                    isModal: true,
                    autoOpen: false,
                    cancelButton: jQuery("#r_ok")
                });
                jQuery("#search").click(function() {
                    var validationResult = function(isValid) {
                        if (isValid) {
                            jQuery("#search").hide();
                            jQuery("#search_loading").show();
                            load_recovery();
                        }
                    }
                    jQuery('#recovery_form').jqxValidator('validate', validationResult);
                });
                jQuery('#recovery_form').jqxValidator({
                    rules: [{
                            input: '#r_dt_from',
                            message: 'Invalid',
                            action: 'keyup, blur, change',
                            rule: function(input, commit) {
                                if (!input.val()) {
                                    return true;
                                }
                                if (validate_date(input.val())) {
                                    return true;
                                } else {
                                    jQuery("#r_dt_from").focus();
                                    return false;
                                }
                            }
                        },
                        {
                            input: '#r_dt_to',
                            message: 'Invalid',
                            action: 'keyup, blur, change',
                            rule: function(input, commit) {
                                if (!input.val()) {
                                    return true;
                                }
                                if (validate_date(input.val())) {
                                    return true;
                                } else {
                                    jQuery("#r_dt_to").focus();
                                    return false;
                                }
                            }
                        }

                    ]
                });
            });

            function load_recovery() {
                jQuery("#recovery_data").html('');
                var postData = jQuery('#recovery_form').serialize();
                jQuery.ajax({
                    type: "POST",
                    cache: false,
                    url: '<?= base_url() ?>index.php/hoops/load_recovery/',
                    data: postData,
                    datatype: "json",
                    success: function(response) {
                        ///console.log(response);
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery("#search").show();
                        jQuery("#search_loading").hide();
                        var str = '';
                        if (json.str) {
                            jQuery("#recovery_data").html(json.str);
                        }
                    }
                });

            }

            function call_ajax_submit() {
                if (jQuery('#deleteEventId').val() == '') {
                    alert('Sorry There is no Recovery Data!');
                    return false;
                }
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                var postData = $('sendToCheckerMessageform').toQueryString() + "&" + csrfName + "=" + csrfHash;
                $('sendToCheckerMessageDialogConfirm').style.display = 'none';
                $('sendToCheckerMessageDialogCancel').style.display = 'none';
                $('loadingReturn').style.display = 'inline';
                jQuery.ajax({
                    type: "POST",
                    cache: false,
                    url: '<?= base_url() ?>index.php/hoops/delete_action/',
                    data: postData,
                    datatype: "json",
                    success: function(response) {
                        ///console.log(response);
                        var json = jQuery.parseJSON(response);
                        window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        if (json.Message != 'OK') {
                            alert(json.Message);
                        } else {

                            sendToCheckerMessageDialog.hide();
                            $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                            $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                            $('loadingReturn').style.display = 'none';
                            jQuery("#save").hide();
                            jQuery("#error").show();
                            jQuery("#error").fadeOut(11500);
                            jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully ' + jQuery("#success_message").val());
                            load_recovery();
                        }
                    }
                });

            }

            function delete_action(batch) {
                var message = '';
                jQuery("#type").val('recovery_delete');
                jQuery("#deleteEventId").val(batch);
                jQuery("#message").html('Delete');
                jQuery("#button_tag").html('Delete');
                jQuery("#success_message").val('Deleted');

                $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                $('loadingReturn').style.display = 'none';
                sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {
                    position: 'fixed',
                    modal: true,
                    width: 470,
                    close: true,
                    id: 'sendToCheckerMessageDialog'
                });
                sendToCheckerMessageDialog.show();
            }

            function close_window() {
                sendToCheckerMessageDialog.hide();
            }

            function preview_recovery(batch) {
                jQuery("#r_heading").html('Recovery Details');
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    type: "POST",
                    cache: false,
                    url: "<?= base_url() ?>hoops/recovery_details",
                    data: {
                        [csrfName]: csrfHash,
                        batch: batch
                    },
                    datatype: "json",
                    success: function(response) {
                        //alert(response);
                        var json = jQuery.parseJSON(response);

                        jQuery('.txt_csrfname').val(json.csrf_token);
                        if (json['row_info']) {
                            document.getElementById("r_history").style.visibility = 'visible';
                            var html = '';
                            jQuery.each(json['row_info'], function(key, obj) {
                                html += '<tr>';
                                html += '<td align="left">' + obj.ac_type + '</td>';
                                html += '<td align="left">' + obj.loan_ac + '</td>';
                                html += '<td align="left">' + obj.narration + '</td>';
                                html += '<td align="left">' + obj.amount + '</td>';
                                html += '<td align="left">' + obj.trans_date + '</td>';
                                html += '<td align="left">' + obj.e_by + '</td>';
                                html += '<td align="left">' + obj.e_dt + '</td>';
                                html += '</tr>';
                            });
                            jQuery("#r_history_details").html(html);
                            jQuery("#r_history").jqxWindow('open');
                        } else {
                            alert("Something went wrong, please refresh the page.")
                        }

                    }
                });
            }
        </script>
        <div id="container" style="">
            <div id="body">
                <div style="display:block; height:auto">
                    <form method="POST" name="recovery_form" id="recovery_form" style="margin:0px;" action="">
                        <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                        <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        <div style="padding: 0.5%;width:98%;height:55px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                            <table id="deal_body" style="display:block;width:100%">
                                <tr>
                                    <td style="text-align:right;width:5%"><strong>Menu&nbsp;&nbsp;</strong> </td>
                                    <td style="width:5%">
                                        <div style="padding-left:1.8%" id="dropdown_list" name="dropdown_list"></div>
                                    </td>
                                    <td style="text-align:left;width:8%"><strong>Recovery upload Date From&nbsp;&nbsp;</strong> </td>
                                    <td style="width:8%"><input id="r_dt_from" name="r_dt_from" style="width:80%" />
                                        <script type="text/javascript">
                                            datePicker("r_dt_from");
                                        </script>
                                    </td>
                                    <td style="text-align:left;width:1%"><strong>To </td>
                                    <td style="width:8%"><input id="r_dt_to" name="r_dt_to" style="width:80%" />
                                        <script type="text/javascript">
                                            datePicker("r_dt_to");
                                        </script>
                                    </td>
                                    <td style="text-align:left;width:10%">
                                        <input name="search" id="search" class="crmbutton small create" value="Search" type="button">
                                        <div style="text-align:center"><span id="search_loading" style="display:none"><img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <span id="recovery_data"></span>


        <div id="sendToCheckerMessageDialogContent" style="display:none;">
            <div class="hd">
                <h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2>
            </div>
            <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform" style="margin-top:0px;">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                <input name="success_message" id="success_message" value="" type="hidden">
                <input name="type" id="type" value="" type="hidden">
                <input type="hidden" id="deleteEventId" name="deleteEventId" value="" />
                <div class="bd">
                    <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
                    <div class="instrText" style="margin-bottom: 20px"></div>
                </div>
                <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a>
                <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a>
                <span id="loadingReturn" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </form>
        </div>
        <div id="r_history" style="visibility:hidden;">
            <div><strong><span id="r_heading"></span></strong></div>
            <div style="" id="details_table">
                <table style="width: 100%;" class="preview_table2">
                    <thead>
                        <th width="5%" align="left"><strong>AC Type</strong></th>
                        <th width="10%" align="left"><strong>AC No.</strong></th>
                        <td width="25%" align="left"><strong>Narration</strong></td>
                        <td width="15%" align="left"><strong>Amount</strong></td>
                        <td width="15%" align="left"><strong>Trans. Date</strong></td>
                        <td width="15%" align="left"><strong>Entry By</strong></td>
                        <td width="15%" align="left"><strong>Entry Date</strong></td>
                    </thead>
                    <tbody id="r_history_details">

                    </tbody>
                </table>
                <div class="wrapper" style="text-align:center">
                    </br></br><input type="button" align="center" class="button1" id="r_ok" value="Close" />
                </div>

            </div>
        </div>
    <?php else : ?>
        <p align="center">Sorry No Access Given. Please Concatch with administrator!!</p>
    <?php endif ?>
<?php } else {
} ?>