<style>
    .slider_heading {
        padding: 3px !important;
        background: rgb(10, 5, 96);
        background: linear-gradient(90deg, rgba(10, 5, 96, 1) 0%, rgba(9, 9, 121, 0.8659663694579394) 32%, rgba(5, 4, 117, 1) 71%, rgba(11, 6, 96, 1) 100%);
    }




    .savebtn {
        background-color: #0095ff;
        border: 1px solid transparent;
        border-radius: 3px;
        box-shadow: rgba(255, 255, 255, .4) 0 1px 0 0 inset;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-family: -apple-system, system-ui, "Segoe UI", "Liberation Sans", sans-serif;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.15385;
        margin: 0;
        outline: none;
        padding: 8px .8em;
        position: relative;
        text-align: center;
        text-decoration: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: baseline;
        white-space: nowrap;
    }

    .savebtn:hover,
    .savebtn:focus {
        background-color: #07c;
    }

    .savebtn:focus {
        box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
    }

    .savebtn:active {
        background-color: #0064bd;
        box-shadow: none;
    }
</style>
<?php if ($option == "lawyer_bill") { ?>


    <script>
        var theme = getDemoTheme();
        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        // var legal_district = [];

        var legal_district = [<? $i = 1;
                    foreach ($district as $row) {
                        if ($i != 1) {
                            echo ',';
                        }
                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                        $i++;
                    } ?>];

        var lawyer = [<? $i = 1;
                    foreach ($lawyer as $row) {
                        if ($i != 1) {
                            echo ',';
                        }
                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                        $i++;
                    } ?>];





        jQuery(document).ready(function() {

            jQuery("#legal_region").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Region",
                source: legal_region,
                width: 250,
                height: 25
            });

            jQuery("#lawyer").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Lawyer",
                source: lawyer,
                width: 250,
                height: 25
            });

            jQuery("#legal_district").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select District",
                source: legal_district,
                width: 250,
                height: 25
            });




            // jQuery('#legal_region').click(function() {

            
            //     jQuery('#legal_region').bind('change', function(event) {
            //         change_dropdown('legal_region');
            //     });
            // });

 
            
            jQuery("#case_number").val('<?= isset($result->case_number) ? $result->case_number : '' ?>');
            jQuery("#legal_region").jqxComboBox('val', '<?= isset($result->region) ? $result->region : '' ?>');
            jQuery("#lawyer").jqxComboBox('val', '<?= isset($result->vendor_id) ? $result->vendor_id : '' ?>');
            jQuery("#legal_district").jqxComboBox('val', '<?= isset($result->district) ? $result->district : '' ?>');
            jQuery("#amount").val('<?= isset($result->amount) ? $result->amount : '' ?>');
            jQuery("#txrn_dt").val('<?= isset($result->txrn_dt) ? $result->txrn_dt : '' ?>');

            // Ajax Submit 

            var rules = [

                // {
                //     input: '#case_number',
                //     message: 'required!',
                //     action: 'keyup, blur',
                //     rule: function(input, commit) {
                //         if (jQuery("#case_number").val() == '') {
                //             jQuery("#case_number").focus();
                //             return false;
                //         } else {
                //             return true;
                //         }
                //     }
                // },

                {
                    input: '#legal_region',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='legal_region']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#legal_region input").focus();
                            return false;
                        }
                    }
                },

                {
                    input: '#lawyer',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='lawyer']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#lawyer input").focus();
                            return false;
                        }
                    }
                },

                {
                    input: '#legal_district',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#legal_district").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='legal_district']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#legal_district input").focus();
                            return false;
                        }
                    }
                },


                {
                    input: '#amount',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() == '') {
                            jQuery("#amount").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#amount',
                    message: 'Only Numeric',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() != '') {
                            if (!checkNANwDOT('amount')) {
                                jQuery("#amount").focus();
                                return false;
                            }
                        }
                        return true;

                    }
                },

                {
                    input: '#txrn_dt',
                    message: 'required',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (input.val() != '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                },

            ];

            jQuery("#update_btn").click(function() {
                jQuery('#lawyer_bill_form').jqxValidator({
                    rules: rules,
                    theme: theme
                });
                var validationResult = function(isValid) {
                    if (isValid) {
                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();
                        call_ajax_submit();
                    } else {
                        return;
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);
            });
        });

        function call_ajax_submit() {

            var edit_row = jQuery("#edit_row").val();
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            var postData = jQuery('#lawyer_bill_form').serialize() + "&" + csrfName + "=" + csrfHash;
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/edit_action_lawyer_bill",
                data: postData,
                datatype: "json",
                async: false,
                success: function(response) {

                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    csrf_tokens = json.csrf_token;

                    if (json.Message != 'OK') {
                        jQuery("#update_btn").show();
                        jQuery("#send_loading").hide();
                        alert("something went wrong");

                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                        return false
                    } else {

                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();

                        window.parent.jQuery("#error").show();
                        window.parent.jQuery("#error").fadeOut(11500);
                        window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Update');
                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                    }

                }
            });

        }


        function validate(val) {
            //console.log(val.length)
            jQuery('#idbody').jqxValidator({
                rules: val
            });
            var d = true;
            if (val.length > 0) {
                d = false;
            }
            var validationResult = function(isValid) {
                if (isValid) {
                    d = true;
                }
            }
            jQuery('#idbody').jqxValidator('validate', validationResult);

            return d;
        }

        // function change_dropdown(operation, edit = null, module_name = null, multiselectbox = null) {
        //     var id = '';
        //     //check for add action
        //     if ((edit == null || edit == '') && operation != 'legal_district_lawyer' && operation != 'legal_district_lawyer_grid') {
        //         id = jQuery("#" + operation).val();
        //     } else if (operation == 'legal_district_lawyer') {
        //         id = jQuery("#legal_district").val();
        //     } else if (operation == 'legal_district_lawyer_grid') {
        //         id = jQuery("#legal_district_grid").val();
        //     } else {
        //         id = edit;
        //     }
        //     var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        //     var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        //     jQuery.ajax({
        //         url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
        //         async: false,
        //         type: "post",
        //         data: {
        //             [csrfName]: csrfHash,
        //             id: id,
        //             operation: operation
        //         },
        //         datatype: "json",
        //         success: function(response) {
        //             var json = jQuery.parseJSON(response);
        //             //console.log(json['row_info']);
        //             var csrf_tokena = json.csrf_token;
        //             jQuery('.txt_csrfname').val(json.csrf_token);
        //             var str = '';
        //             var theme = getDemoTheme();
        //             if (operation == 'legal_region') {
        //                 var legal_district = [];
        //                 jQuery.each(json['row_info'], function(key, obj) {
        //                     legal_district.push({
        //                         value: obj.id,
        //                         label: obj.name
        //                     });
        //                 });
        //                 if (multiselectbox == null) {
        //                     jQuery("#legal_district").jqxComboBox({
        //                         theme: theme,
        //                         autoDropDownHeight: false,
        //                         promptText: "Legal District",
        //                         source: legal_district,
        //                         width: 250,
        //                         height: 25
        //                     });
        //                 } else {
        //                     jQuery("#legal_district").jqxDropDownList({
        //                         theme: theme,
        //                         checkboxes: true,
        //                         autoDropDownHeight: false,
        //                         promptText: "Legal District",
        //                         filterable: true,
        //                         searchMode: 'containsignorecase',
        //                         source: legal_district,
        //                         width: 250,
        //                         height: 25
        //                     });
        //                 }
        //             }
        //             if (operation == 'legal_region_grid') {
        //                 var legal_district = [];
        //                 jQuery.each(json['row_info'], function(key, obj) {
        //                     legal_district.push({
        //                         value: obj.id,
        //                         label: obj.name
        //                     });
        //                     //alert(obj.name);
        //                 });
        //                 jQuery("#legal_district_grid").jqxComboBox({
        //                     theme: theme,
        //                     autoDropDownHeight: false,
        //                     promptText: "Legal District",
        //                     source: legal_district,
        //                     width: '98%',
        //                     height: 25
        //                 });
        //             }
        //             if (operation == 'legal_district_lawyer') {
        //                 var lawyer = [];
        //                 jQuery.each(json['row_info'], function(key, obj) {
        //                     lawyer.push({
        //                         value: obj.id,
        //                         label: obj.name
        //                     });
        //                     //alert(obj.name);
        //                 });
        //                 if (module_name == 'court_return') {
        //                     jQuery("#lawyer").jqxComboBox({
        //                         theme: theme,
        //                         autoDropDownHeight: false,
        //                         promptText: "Select Lawyer",
        //                         source: lawyer,
        //                         width: 180,
        //                         height: 25
        //                     });
        //                 } else {
        //                     jQuery("#lawyer").jqxComboBox({
        //                         theme: theme,
        //                         autoDropDownHeight: false,
        //                         promptText: "Select Lawyer",
        //                         source: lawyer,
        //                         width: 250,
        //                         height: 25
        //                     });
        //                 }

        //             }
        //             if (operation == 'legal_district_lawyer_grid') {
        //                 var lawyer = [];
        //                 jQuery.each(json['row_info'], function(key, obj) {
        //                     lawyer.push({
        //                         value: obj.id,
        //                         label: obj.name
        //                     });
        //                     //alert(obj.name);
        //                 });
        //                 jQuery("#lawyer_grid").jqxComboBox({
        //                     theme: theme,
        //                     autoDropDownHeight: false,
        //                     promptText: "Select Lawyer",
        //                     source: lawyer,
        //                     width: '98%',
        //                     height: 25
        //                 });

        //             }

        //         },
        //         error: function(model, xhr, options) {
        //             alert('failed');
        //         },
        //     });

        //     return false;
        // }

        function datePicker(id) {
            jQuery(document).ready(function() {
                jQuery("*").dblclick(function(e) {
                    e.preventDefault();
                });
                jQuery('#' + id).datepicker({
                    inline: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    showButtonPanel: true,

                });
            });
        }
    </script>

    <body>
        <div class="slider_heading" style="height:30px;font-size:22px;padding:5px 0 0 10px;color:white"> Edit </div>
    </body>

    <div id="lawer_bill">

        <form method="POST" name="lawyer_bill_form" id="lawyer_bill_form" style="margin:0px;">

            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <input type="hidden" name="edit_row" id="edit_row" value="<?php echo $id ?>">

            <table style="width:100%;margin-top:20px" id="tab1Table">
                <tbody>
                    <tr>
                        <td width="50%" style="display:contents;">
                            <table style="width: 50%;">

                                <tr>
                                    <td width="40%" style="font-weight: bold;">Case No <strong style="color: green;">*</strong></td>
                                    <td width="60%"><input name="case_number" type="text" tabindex="1" style="width:250px" id="case_number" /></td>
                                </tr>
                                <tr>
                                    <td width="40%" style="font-weight: bold;">Lawyer<strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="lawyer" tabindex="3" name="lawyer" style="padding-left: 3px"></div>
                                    </td>

                                </tr>

                                <tr id="lawyer_region_row">
                                    <td width="40%" style="font-weight: bold;">Legal Region <strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="legal_region" tabindex="3" name="legal_region" style="padding-left: 3px"></div>
                                    </td>

                                </tr>
                                <tr id="lawyer_district_row">
                                    <td width="40%" style="font-weight: bold;">Legal District <strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="legal_district" tabindex="3" name="legal_district" style="padding-left: 3px"></div>
                                    </td>

                                </tr>

                                <tr>
                                    <td width="40%" style="font-weight: bold;"> Bill Amount <strong style="color: red;">*</strong></td>
                                    <td width="60%"><input name="amount" type="text" tabindex="1" style="width:250px" id="amount" /></td>
                                </tr>

                                <!-- PO Date -->
                                <tr>
                                    <td><strong style="vertical-align:top">Transition Date<span style="color: red;">*</span></strong></td>
                                    <td width="60%">
                                        <input style="width:250px" name="txrn_dt" id="txrn_dt" type="text" class="text-input" placeholder="dd/mm/yyyy">
                                        <script type="text/javascript">
                                            datePicker("txrn_dt");
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>

                                        <input type="button" value="Update" class="savebtn" id="update_btn" />
                                        <span id="send_loading" style="display: none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom" /></span>
                                    </td>
                                </tr>



                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>




            </tbody>
            </table>
        </form>
    </div>

<?php } else if ($option == "court_fee") { ?>

    <script>
        var theme = getDemoTheme();
        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];

        var lawyer = [<? $i = 1;
                            foreach ($lawyer as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
       

        var legal_district = [<? $i = 1;
                    foreach ($district as $row) {
                        if ($i != 1) {
                            echo ',';
                        }
                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                        $i++;
                    } ?>];



        jQuery(document).ready(function() {

            jQuery("#legal_region").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Region",
                source: legal_region,
                width: 250,
                height: 25
            });

            jQuery("#lawyer").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Lawyer",
                source: lawyer,
                width: 250,
                height: 25
            });

            jQuery("#legal_district").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select District",
                source: legal_district,
                width: 250,
                height: 25
            });


            // jQuery('#legal_region').bind('change', function(event) {
            //     change_dropdown('legal_region');
            // });
            jQuery("#case_number").val('<?= isset($result->case_number) ? $result->case_number : '' ?>');
            jQuery("#legal_region").jqxComboBox('val', '<?= isset($result->region) ? $result->region : '' ?>');
            jQuery("#lawyer").jqxComboBox('val', '<?= isset($result->vendor_id) ? $result->vendor_id : '' ?>');
            jQuery("#legal_district").jqxComboBox('val', '<?= isset($result->district) ? $result->district : '' ?>');
            jQuery("#amount").val('<?= isset($result->amount) ? $result->amount : '' ?>');
            jQuery("#txrn_dt").val('<?= isset($result->txrn_dt) ? $result->txrn_dt : '' ?>');

            // Ajax Submit 

            var rules = [

                {
                    input: '#case_number',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#case_number").val() == '') {
                            jQuery("#case_number").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#legal_region',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='legal_region']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#legal_region input").focus();
                            return false;
                        }
                    }
                },

                {
                    input: '#lawyer',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='lawyer']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#lawyer input").focus();
                            return false;
                        }
                    }
                },

                {
                    input: '#legal_district',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#legal_district").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='legal_district']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#legal_district input").focus();
                            return false;
                        }
                    }
                },


                {
                    input: '#amount',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() == '') {
                            jQuery("#amount").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#amount',
                    message: 'Only Numeric',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() != '') {
                            if (!checkNANwDOT('amount')) {
                                jQuery("#amount").focus();
                                return false;
                            }
                        }
                        return true;

                    }
                },

                {
                    input: '#txrn_dt',
                    message: 'required',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (input.val() != '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                },

            ];

            jQuery("#update_btn").click(function() {
                jQuery('#lawyer_bill_form').jqxValidator({
                    rules: rules,
                    theme: theme
                });
                var validationResult = function(isValid) {
                    if (isValid) {
                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();
                        call_ajax_submit();
                    } else {
                        return;
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);
            });
        });

        function call_ajax_submit() {

            var edit_row = jQuery("#edit_row").val();
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            var postData = jQuery('#lawyer_bill_form').serialize() + "&" + csrfName + "=" + csrfHash;
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/edit_action_curt",
                data: postData,
                datatype: "json",
                async: false,
                success: function(response) {

                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    csrf_tokens = json.csrf_token;

                    if (json.Message != 'OK') {
                        jQuery("#update_btn").show();
                        jQuery("#send_loading").hide();
                        alert("something went wrong");

                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                        return false
                    } else {

                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();

                        window.parent.jQuery("#error").show();
                        window.parent.jQuery("#error").fadeOut(11500);
                        window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Update');
                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                    }

                }
            });

        }


        function validate(val) {
            //console.log(val.length)
            jQuery('#idbody').jqxValidator({
                rules: val
            });
            var d = true;
            if (val.length > 0) {
                d = false;
            }
            var validationResult = function(isValid) {
                if (isValid) {
                    d = true;
                }
            }
            jQuery('#idbody').jqxValidator('validate', validationResult);

            return d;
        }

        function change_dropdown(operation, edit = null, module_name = null, multiselectbox = null) {
            var id = '';
            //check for add action
            if ((edit == null || edit == '') && operation != 'legal_district_lawyer' && operation != 'legal_district_lawyer_grid') {
                id = jQuery("#" + operation).val();
            } else if (operation == 'legal_district_lawyer') {
                id = jQuery("#legal_district").val();
            } else if (operation == 'legal_district_lawyer_grid') {
                id = jQuery("#legal_district_grid").val();
            } else {
                id = edit;
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
                async: false,
                type: "post",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                    operation: operation
                },
                datatype: "json",
                success: function(response) {
                    var json = jQuery.parseJSON(response);
                    //console.log(json['row_info']);
                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();
                    if (operation == 'legal_region') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                        });
                        if (multiselectbox == null) {
                            jQuery("#legal_district").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Legal District",
                                source: legal_district,
                                width: 250,
                                height: 25
                            });
                        } else {
                            jQuery("#legal_district").jqxDropDownList({
                                theme: theme,
                                checkboxes: true,
                                autoDropDownHeight: false,
                                promptText: "Legal District",
                                filterable: true,
                                searchMode: 'containsignorecase',
                                source: legal_district,
                                width: 250,
                                height: 25
                            });
                        }
                    }
                    if (operation == 'legal_region_grid') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_district_grid").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Legal District",
                            source: legal_district,
                            width: '98%',
                            height: 25
                        });
                    }
                    if (operation == 'legal_district_lawyer') {
                        var lawyer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            lawyer.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        if (module_name == 'court_return') {
                            jQuery("#lawyer").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Select Lawyer",
                                source: lawyer,
                                width: 180,
                                height: 25
                            });
                        } else {
                            jQuery("#lawyer").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Select Lawyer",
                                source: lawyer,
                                width: 250,
                                height: 25
                            });
                        }

                    }
                    if (operation == 'legal_district_lawyer_grid') {
                        var lawyer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            lawyer.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#lawyer_grid").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Select Lawyer",
                            source: lawyer,
                            width: '98%',
                            height: 25
                        });

                    }

                },
                error: function(model, xhr, options) {
                    alert('failed');
                },
            });

            return false;
        }

        function datePicker(id) {
            jQuery(document).ready(function() {
                jQuery("*").dblclick(function(e) {
                    e.preventDefault();
                });
                jQuery('#' + id).datepicker({
                    inline: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    showButtonPanel: true,

                });
            });
        }
    </script>

    <body>
        <div class="slider_heading" style="height:30px;font-size:22px;padding:5px 0 0 10px;color:white">Edit</div>
    </body>

    <div id="lawer_bill">

        <form method="POST" name="lawyer_bill_form" id="lawyer_bill_form" style="margin:0px;">

            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <input type="hidden" name="edit_row" id="edit_row" value="<?php echo $id ?>">

            <table style="width:100%;margin-top:20px" id="tab1Table">
                <tbody>
                    <tr>
                        <td width="50%" style="display:contents;">
                            <table style="width: 50%;">

                                <tr>
                                    <td width="40%" style="font-weight: bold;">Case No <strong style="color: red;">*</strong></td>
                                    <td width="60%"><input name="case_number" type="text" tabindex="1" style="width:250px" id="case_number" /></td>
                                </tr>

                                <tr>
                                    <td width="40%" style="font-weight: bold;">Lawyer<strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="lawyer" tabindex="3" name="lawyer" style="padding-left: 3px"></div>
                                    </td>

                                </tr>
                                <tr id="lawyer_region_row">
                                    <td width="40%" style="font-weight: bold;">Legal Region <strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="legal_region" tabindex="3" name="legal_region" style="padding-left: 3px"></div>
                                    </td>

                                </tr>
                                <tr id="lawyer_district_row">
                                    <td width="40%" style="font-weight: bold;">Legal District <strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="legal_district" tabindex="3" name="legal_district" style="padding-left: 3px"></div>
                                    </td>

                                </tr>

                                <tr>
                                    <td width="40%" style="font-weight: bold;"> Bill Amount <strong style="color: red;">*</strong></td>
                                    <td width="60%"><input name="amount" type="text" tabindex="1" style="width:250px" id="amount" /></td>
                                </tr>

                                <!-- PO Date -->
                                <tr>
                                    <td><strong style="vertical-align:top">Transition Date<span style="color: red;">*</span></strong></td>
                                    <td width="60%">
                                        <input style="width:250px" name="txrn_dt" id="txrn_dt" type="text" class="text-input" placeholder="dd/mm/yyyy">
                                        <script type="text/javascript">
                                            datePicker("txrn_dt");
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>

                                        <input type="button" value="Update" class="savebtn" id="update_btn" />
                                        <span id="send_loading" style="display: none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom" /></span>
                                    </td>
                                </tr>



                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </tbody>
            </table>
        </form>
    </div>
<?php } else if ($option == "paper_bill") { ?>

    <script>
        var theme = getDemoTheme();
        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];

        <?php if ($result->paper_bill_vendor_type=='Vendor'): ?>
            var vendor = [<? $i = 1;
                            foreach ($vendor as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        <?php else: ?>
            var vendor = [<? $i = 1;
                            foreach ($staff as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '('.$row->pin.')"}';
                                $i++;
                            } ?>];
        <?php endif ?>
       

        var legal_district = [<? $i = 1;
                    foreach ($district as $row) {
                        if ($i != 1) {
                            echo ',';
                        }
                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                        $i++;
                    } ?>];



        jQuery(document).ready(function() {

            jQuery("#legal_region").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Region",
                source: legal_region,
                width: 250,
                height: 25
            });

            jQuery("#lawyer").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Vendor",
                source: vendor,
                width: 250,
                height: 25
            });

            jQuery("#legal_district").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select District",
                source: legal_district,
                width: 250,
                height: 25
            });


            // jQuery('#legal_region').bind('change', function(event) {
            //     change_dropdown('legal_region');
            // });
            jQuery("#case_number").val('<?= isset($result->case_number) ? $result->case_number : '' ?>');
            jQuery("#legal_region").jqxComboBox('val', '<?= isset($result->region) ? $result->region : '' ?>');
            jQuery("#lawyer").jqxComboBox('val', '<?= isset($result->vendor_id) ? $result->vendor_id : '' ?>');
            jQuery("#legal_district").jqxComboBox('val', '<?= isset($result->district) ? $result->district : '' ?>');
            jQuery("#amount").val('<?= isset($result->amount) ? $result->amount : '' ?>');
            jQuery("#txrn_dt").val('<?= isset($result->txrn_dt) ? $result->txrn_dt : '' ?>');

            // Ajax Submit 

            var rules = [

                {
                    input: '#case_number',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#case_number").val() == '') {
                            jQuery("#case_number").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#legal_region',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='legal_region']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#legal_region input").focus();
                            return false;
                        }
                    }
                },

                {
                    input: '#lawyer',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='lawyer']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#lawyer input").focus();
                            return false;
                        }
                    }
                },

                {
                    input: '#legal_district',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#legal_district").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='legal_district']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#legal_district input").focus();
                            return false;
                        }
                    }
                },


                {
                    input: '#amount',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() == '') {
                            jQuery("#amount").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#amount',
                    message: 'Only Numeric',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() != '') {
                            if (!checkNANwDOT('amount')) {
                                jQuery("#amount").focus();
                                return false;
                            }
                        }
                        return true;

                    }
                },

                {
                    input: '#txrn_dt',
                    message: 'required',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (input.val() != '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                },

            ];

            jQuery("#update_btn").click(function() {
                jQuery('#lawyer_bill_form').jqxValidator({
                    rules: rules,
                    theme: theme
                });
                var validationResult = function(isValid) {
                    if (isValid) {
                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();
                        call_ajax_submit();
                    } else {
                        return;
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);
            });
        });

        function call_ajax_submit() {

            var edit_row = jQuery("#edit_row").val();
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            var postData = jQuery('#lawyer_bill_form').serialize() + "&" + csrfName + "=" + csrfHash;
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/edit_action_paper",
                data: postData,
                datatype: "json",
                async: false,
                success: function(response) {

                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    csrf_tokens = json.csrf_token;

                    if (json.Message != 'OK') {
                        jQuery("#update_btn").show();
                        jQuery("#send_loading").hide();
                        alert("something went wrong");

                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                        return false
                    } else {

                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();

                        window.parent.jQuery("#error").show();
                        window.parent.jQuery("#error").fadeOut(11500);
                        window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Update');
                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                    }

                }
            });

        }


        function validate(val) {
            //console.log(val.length)
            jQuery('#idbody').jqxValidator({
                rules: val
            });
            var d = true;
            if (val.length > 0) {
                d = false;
            }
            var validationResult = function(isValid) {
                if (isValid) {
                    d = true;
                }
            }
            jQuery('#idbody').jqxValidator('validate', validationResult);

            return d;
        }

        function change_dropdown(operation, edit = null, module_name = null, multiselectbox = null) {
            var id = '';
            //check for add action
            if ((edit == null || edit == '') && operation != 'legal_district_lawyer' && operation != 'legal_district_lawyer_grid') {
                id = jQuery("#" + operation).val();
            } else if (operation == 'legal_district_lawyer') {
                id = jQuery("#legal_district").val();
            } else if (operation == 'legal_district_lawyer_grid') {
                id = jQuery("#legal_district_grid").val();
            } else {
                id = edit;
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
                async: false,
                type: "post",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                    operation: operation
                },
                datatype: "json",
                success: function(response) {
                    var json = jQuery.parseJSON(response);
                    //console.log(json['row_info']);
                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();
                    if (operation == 'legal_region') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                        });
                        if (multiselectbox == null) {
                            jQuery("#legal_district").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Legal District",
                                source: legal_district,
                                width: 250,
                                height: 25
                            });
                        } else {
                            jQuery("#legal_district").jqxDropDownList({
                                theme: theme,
                                checkboxes: true,
                                autoDropDownHeight: false,
                                promptText: "Legal District",
                                filterable: true,
                                searchMode: 'containsignorecase',
                                source: legal_district,
                                width: 250,
                                height: 25
                            });
                        }
                    }
                    if (operation == 'legal_region_grid') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_district_grid").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Legal District",
                            source: legal_district,
                            width: '98%',
                            height: 25
                        });
                    }
                    if (operation == 'legal_district_lawyer') {
                        var lawyer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            lawyer.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        if (module_name == 'court_return') {
                            jQuery("#lawyer").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Select Lawyer",
                                source: lawyer,
                                width: 180,
                                height: 25
                            });
                        } else {
                            jQuery("#lawyer").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Select Lawyer",
                                source: lawyer,
                                width: 250,
                                height: 25
                            });
                        }

                    }
                    if (operation == 'legal_district_lawyer_grid') {
                        var lawyer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            lawyer.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#lawyer_grid").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Select Lawyer",
                            source: lawyer,
                            width: '98%',
                            height: 25
                        });

                    }

                },
                error: function(model, xhr, options) {
                    alert('failed');
                },
            });

            return false;
        }

        function datePicker(id) {
            jQuery(document).ready(function() {
                jQuery("*").dblclick(function(e) {
                    e.preventDefault();
                });
                jQuery('#' + id).datepicker({
                    inline: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    showButtonPanel: true,

                });
            });
        }
    </script>

    <body>
        <div class="slider_heading" style="height:30px;font-size:22px;padding:5px 0 0 10px;color:white">Edit</div>
    </body>

    <div id="lawer_bill">

        <form method="POST" name="lawyer_bill_form" id="lawyer_bill_form" style="margin:0px;">

            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <input type="hidden" name="edit_row" id="edit_row" value="<?php echo $id ?>">

            <table style="width:100%;margin-top:20px" id="tab1Table">
                <tbody>
                    <tr>
                        <td width="50%" style="display:contents;">
                            <table style="width: 50%;">

                                <tr>
                                    <td width="40%" style="font-weight: bold;">Case No <strong style="color: red;">*</strong></td>
                                    <td width="60%"><input name="case_number" type="text" tabindex="1" style="width:250px" id="case_number" /></td>
                                </tr>

                                <tr>
                                    <td width="40%" style="font-weight: bold;">Vendor<strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="lawyer" tabindex="3" name="lawyer" style="padding-left: 3px"></div>
                                    </td>

                                </tr>
                                <tr id="lawyer_region_row">
                                    <td width="40%" style="font-weight: bold;">Legal Region <strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="legal_region" tabindex="3" name="legal_region" style="padding-left: 3px"></div>
                                    </td>

                                </tr>
                                <tr id="lawyer_district_row">
                                    <td width="40%" style="font-weight: bold;">Legal District <strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="legal_district" tabindex="3" name="legal_district" style="padding-left: 3px"></div>
                                    </td>

                                </tr>

                                <tr>
                                    <td width="40%" style="font-weight: bold;"> Bill Amount <strong style="color: red;">*</strong></td>
                                    <td width="60%"><input name="amount" type="text" tabindex="1" style="width:250px" id="amount" /></td>
                                </tr>

                                <!-- PO Date -->
                                <tr>
                                    <td><strong style="vertical-align:top">Transition Date<span style="color: red;">*</span></strong></td>
                                    <td width="60%">
                                        <input style="width:250px" name="txrn_dt" id="txrn_dt" type="text" class="text-input" placeholder="dd/mm/yyyy">
                                        <script type="text/javascript">
                                            datePicker("txrn_dt");
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>

                                        <input type="button" value="Update" class="savebtn" id="update_btn" />
                                        <span id="send_loading" style="display: none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom" /></span>
                                    </td>
                                </tr>



                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            </tbody>
            </table>
        </form>
    </div>
<?php } else if ($option == "staff_conveyance") { ?>



    <script>
        var theme = getDemoTheme();

        jQuery(document).ready(function() {


            jQuery("#movement_details").val('<?= isset($result->movement_details) ? $result->movement_details : '' ?>');
            jQuery("#move_of_transfortaion").val('<?= isset($result->move_of_transfortaion) ? $result->move_of_transfortaion : '' ?>');
            jQuery("#particulars").val('<?= isset($result->particulars) ? $result->particulars : '' ?>');
            jQuery("#place").val('<?= isset($result->place) ? $result->place : '' ?>');
            jQuery("#description_of_journey").val('<?= isset($result->description_of_journey) ? $result->description_of_journey : '' ?>');
            jQuery("#journey_time").val('<?= isset($result->journey_time) ? $result->journey_time : '' ?>');
            jQuery("#journey_metar").val('<?= isset($result->journey_metar) ? $result->journey_metar : '' ?>');
            jQuery("#reached_time").val('<?= isset($result->reached_time) ? $result->reached_time : '' ?>');
            jQuery("#reached_metar").val('<?= isset($result->reached_metar) ? $result->reached_metar : '' ?>');
            jQuery("#purpose").val('<?= isset($result->purpose) ? $result->purpose : '' ?>');
            jQuery("#from").val('<?= isset($result->from) ? $result->from : '' ?>');
            jQuery("#time_out").val('<?= isset($result->time_out) ? $result->time_out : '' ?>');
            jQuery("#to").val('<?= isset($result->to) ? $result->to : '' ?>');
            jQuery("#time_in").val('<?= isset($result->time_in) ? $result->time_in : '' ?>');
            jQuery("#mode").val('<?= isset($result->mode) ? $result->mode : '' ?>');
            jQuery("#breakdown_bill").val('<?= isset($result->breakdown_bill) ? $result->breakdown_bill : '' ?>');

            jQuery("#to_date").val('<?= isset($result->to_date) ? $result->to_date : '' ?>');
            jQuery("#from_date").val('<?= isset($result->from_date) ? $result->from_date : '' ?>');

            jQuery("#txrn_dt").val('<?= isset($result->txrn_dt) ? $result->txrn_dt : '' ?>');
            jQuery("#amount").val('<?= isset($result->amount) ? $result->amount : '' ?>');


            var rules = [

                {
                    input: '#amount',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() == '') {
                            jQuery("#amount").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#amount',
                    message: 'Only Numeric',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() != '') {
                            if (!checkNANwDOT('amount')) {
                                jQuery("#amount").focus();
                                return false;
                            }
                        }
                        return true;

                    }
                },

                {
                    input: '#txrn_dt',
                    message: 'required',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (input.val() != '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                },

            ];

            jQuery("#update_btn").click(function() {
                jQuery('#lawyer_bill_form').jqxValidator({
                    rules: rules,
                    theme: theme
                });
                var validationResult = function(isValid) {
                    if (isValid) {
                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();
                        call_ajax_submit();
                    } else {
                        return;
                    }
                }
                jQuery('#lawyer_bill_form').jqxValidator('validate', validationResult);
            });


        });

        function call_ajax_submit() {

            var edit_row = jQuery("#edit_row").val();
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            var postData = jQuery('#lawyer_bill_form').serialize() + "&" + csrfName + "=" + csrfHash;
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/edit_action_staff_conveyance",
                data: postData,
                datatype: "json",
                async: false,
                success: function(response) {

                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    csrf_tokens = json.csrf_token;

                    if (json.Message != 'OK') {
                        jQuery("#update_btn").show();
                        jQuery("#send_loading").hide();
                        alert("something went wrong");

                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                        return false
                    } else {

                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();

                        window.parent.jQuery("#error").show();
                        window.parent.jQuery("#error").fadeOut(11500);
                        window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Update');
                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                    }

                }
            });

        }


        function validate(val) {
            //console.log(val.length)
            jQuery('#idbody').jqxValidator({
                rules: val
            });
            var d = true;
            if (val.length > 0) {
                d = false;
            }
            var validationResult = function(isValid) {
                if (isValid) {
                    d = true;
                }
            }
            jQuery('#idbody').jqxValidator('validate', validationResult);

            return d;
        }

        function datePicker(id) {
            jQuery(document).ready(function() {
                jQuery("*").dblclick(function(e) {
                    e.preventDefault();
                });
                jQuery('#' + id).datepicker({
                    inline: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    showButtonPanel: true,

                });
            });
        }
    </script>

    <body>
        <div class="slider_heading" style="height:30px;font-size:22px;padding:5px 0 0 10px;color:white">Edit</div>
    </body>

    <div id="lawer_bill">

        <form method="POST" name="lawyer_bill_form" id="lawyer_bill_form" style="margin:0px;">

            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <input type="hidden" name="edit_row" id="edit_row" value="<?php echo $id ?>">


            <div style="display: flex; ">

                <div id="table_left">
                    <table>
                        <tr>
                            <td width="40%" style="font-weight: bold;">Movement Details</td>
                            <td width="60%">
                                <textarea name="movement_details" id="movement_details" cols="30" rows="2"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td width="40%" style="font-weight: bold;">Move Of Transfortaion</td>
                            <td width="60%">
                                <textarea name="move_of_transfortaion" id="move_of_transfortaion" cols="30" rows="2"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td width="40%" style="font-weight: bold;">Particulars</td>
                            <td width="60%">
                                <textarea name="particulars" id="particulars" cols="30" rows="2"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td width="40%" style="font-weight: bold;">Place</td>
                            <td width="60%">
                                <textarea name="place" id="place" cols="30" rows="2"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td width="40%" style="font-weight: bold;">Description Of Journey</td>
                            <td width="60%">
                                <textarea name="description_of_journey" id="description_of_journey" cols="30" rows="2"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" style="font-weight: bold;">Journey Time</td>
                            <td width="60%">
                                <textarea name="journey_time" id="journey_time" cols="30" rows="2"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" style="font-weight: bold;">Journey Metar</td>
                            <td width="60%">
                                <textarea name="journey_metar" id="journey_metar" cols="30" rows="2"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><strong style="vertical-align:top">From Date</strong></td>
                            <td width="60%">
                                <input style="width:237px" name="from_date" id="from_date" type="text" class="text-input" placeholder="dd/mm/yyyy">
                                <script type="text/javascript">
                                    datePicker("from_date");
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td><strong style="vertical-align:top">Transaction Date<span style="color: red;">*</span></strong></td>
                            <td width="60%">
                                <input style="width:237px" name="txrn_dt" id="txrn_dt" type="text" class="text-input" placeholder="dd/mm/yyyy">
                                <script type="text/javascript">
                                    datePicker("txrn_dt");
                                </script>
                            </td>
                        </tr>
                    </table>


                </div>
                <div style="padding-left: 4rem" id="table_right">
                    <table>
                        <td width="50%" style="display:contents;">
                            <tr>
                                <td width="40%" style="font-weight: bold;">Purpose</td>
                                <td width="60%">
                                    <textarea name="purpose" id="purpose" cols="30" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" style="font-weight: bold;">From</td>
                                <td width="60%">
                                    <textarea name="from" id="from" cols="30" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" style="font-weight: bold;">Time Out</td>
                                <td width="60%">
                                    <textarea name="time_out" id="time_out" cols="30" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" style="font-weight: bold;">To</td>
                                <td width="60%">
                                    <textarea name="to" id="to" cols="30" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" style="font-weight: bold;">Time In</td>
                                <td width="60%">
                                    <textarea name="time_in" id="time_in" cols="30" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" style="font-weight: bold;">Mode</td>
                                <td width="60%">
                                    <textarea name="mode" id="mode" cols="30" rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td width="40%" style="font-weight: bold;">Breakdown Bill</td>
                                <td width="60%">
                                    <textarea name="breakdown_bill" id="breakdown_bill" cols="30" rows="2"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td><strong style="vertical-align:top">To Date</strong></td>
                                <td width="60%">
                                    <input style="width:237px" name="to_date" id="to_date" type="text" class="text-input" placeholder="dd/mm/yyyy">
                                    <script type="text/javascript">
                                        datePicker("to_date");
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" style="font-weight: bold;"> Bill Amount <strong style="color: red;">*</strong></td>
                                <td width="60%"><input name="amount" type="text" tabindex="1" style="width:237px" id="amount" /></td>
                            </tr>
                        </td>
                    </table>
                </div>
            </div>



            <div style="margin-left:27rem; margin-top:1rem">

                <input type="button" value="Update" class="savebtn" id="update_btn" />
                <span id="send_loading" style="display: none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom" /></span>


            </div>






        </form>
    </div>





<?php } else if ($option == "court_entertainment") { ?>


    <script>
        var theme = getDemoTheme();
        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];


                var legal_district = [<? $i = 1;
                    foreach ($district as $row) {
                        if ($i != 1) {
                            echo ',';
                        }
                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                        $i++;
                    } ?>];





        var expense_activities = [<? $i = 1;
                                    foreach ($expense_activities as $row) {
                                        if ($i != 1) {
                                            echo ',';
                                        }
                                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                        $i++;
                                    } ?>];





        jQuery(document).ready(function() {

            jQuery("#legal_region").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Region",
                source: legal_region,
                width: 250,
                height: 25
            });

            jQuery("#legal_district").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select District",
                source: legal_district,
                width: 250,
                height: 25
            });

            jQuery("#expense_activities").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Activities",
                source: expense_activities,
                width: 250,
                height: 25
            });



            // jQuery('#legal_region').bind('change', function(event) {
            //     change_dropdown('legal_region');
            // });




            jQuery("#case_number").val('<?= isset($result->case_number) ? $result->case_number : '' ?>');
            jQuery("#legal_region").jqxComboBox('val', '<?= isset($result->region) ? $result->region : '' ?>');
            jQuery("#legal_district").jqxComboBox('val', '<?= isset($result->district) ? $result->district : '' ?>');
            jQuery("#amount").val('<?= isset($result->amount) ? $result->amount : '' ?>');
            jQuery("#txrn_dt").val('<?= isset($result->txrn_dt) ? $result->txrn_dt : '' ?>');
            jQuery("#expense_activities").jqxComboBox('val', '<?= isset($result->activities_id) ? $result->activities_id : '' ?>');


            // Ajax Submit 

            var rules = [

                {
                    input: '#case_number',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#case_number").val() == '') {
                            jQuery("#case_number").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#legal_region',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='legal_region']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#legal_region input").focus();
                            return false;
                        }
                    }
                },

                {
                    input: '#legal_district',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#legal_district").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='legal_district']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#legal_district input").focus();
                            return false;
                        }
                    }
                },


                {
                    input: '#amount',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() == '') {
                            jQuery("#amount").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#amount',
                    message: 'Only Numeric',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() != '') {
                            if (!checkNANwDOT('amount')) {
                                jQuery("#amount").focus();
                                return false;
                            }
                        }
                        return true;

                    }
                },

                {
                    input: '#txrn_dt',
                    message: 'required',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (input.val() != '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                },

                {
                    input: '#expense_activities',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#expense_activities").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='expense_activities']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#expense_activities input").focus();
                            return false;
                        }
                    }
                },

            ];

            jQuery("#update_btn").click(function() {
                jQuery('#court_entertainment_from').jqxValidator({
                    rules: rules,
                    theme: theme
                });
                var validationResult = function(isValid) {
                    if (isValid) {
                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();
                        call_ajax_submit();
                    } else {
                        return;
                    }
                }
                jQuery('#court_entertainment_from').jqxValidator('validate', validationResult);
            });
        });

        function call_ajax_submit() {

            var edit_row = jQuery("#edit_row").val();
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            var postData = jQuery('#court_entertainment_from').serialize() + "&" + csrfName + "=" + csrfHash;
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/edit_action_court_entertainment",
                data: postData,
                datatype: "json",
                async: false,
                success: function(response) {

                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    csrf_tokens = json.csrf_token;

                    if (json.Message != 'OK') {
                        jQuery("#update_btn").show();
                        jQuery("#send_loading").hide();
                        alert("something went wrong");

                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                        return false
                    } else {

                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();

                        window.parent.jQuery("#error").show();
                        window.parent.jQuery("#error").fadeOut(11500);
                        window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Update');
                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                    }

                }
            });

        }


        function validate(val) {
            //console.log(val.length)
            jQuery('#idbody').jqxValidator({
                rules: val
            });
            var d = true;
            if (val.length > 0) {
                d = false;
            }
            var validationResult = function(isValid) {
                if (isValid) {
                    d = true;
                }
            }
            jQuery('#idbody').jqxValidator('validate', validationResult);

            return d;
        }

        function change_dropdown(operation, edit = null, module_name = null, multiselectbox = null) {
            var id = '';
            //check for add action
            if ((edit == null || edit == '') && operation != 'legal_district_lawyer' && operation != 'legal_district_lawyer_grid') {
                id = jQuery("#" + operation).val();
            } else if (operation == 'legal_district_lawyer') {
                id = jQuery("#legal_district").val();
            } else if (operation == 'legal_district_lawyer_grid') {
                id = jQuery("#legal_district_grid").val();
            } else {
                id = edit;
            }
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
                async: false,
                type: "post",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                    operation: operation
                },
                datatype: "json",
                success: function(response) {
                    var json = jQuery.parseJSON(response);
                    //console.log(json['row_info']);
                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();
                    if (operation == 'legal_region') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                        });
                        if (multiselectbox == null) {
                            jQuery("#legal_district").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Legal District",
                                source: legal_district,
                                width: 250,
                                height: 25
                            });
                        } else {
                            jQuery("#legal_district").jqxDropDownList({
                                theme: theme,
                                checkboxes: true,
                                autoDropDownHeight: false,
                                promptText: "Legal District",
                                filterable: true,
                                searchMode: 'containsignorecase',
                                source: legal_district,
                                width: 250,
                                height: 25
                            });
                        }
                    }
                    if (operation == 'legal_region_grid') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_district_grid").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Legal District",
                            source: legal_district,
                            width: '98%',
                            height: 25
                        });
                    }
                    if (operation == 'legal_district_lawyer') {
                        var lawyer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            lawyer.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        if (module_name == 'court_return') {
                            jQuery("#lawyer").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Select Lawyer",
                                source: lawyer,
                                width: 180,
                                height: 25
                            });
                        } else {
                            jQuery("#lawyer").jqxComboBox({
                                theme: theme,
                                autoDropDownHeight: false,
                                promptText: "Select Lawyer",
                                source: lawyer,
                                width: 250,
                                height: 25
                            });
                        }

                    }
                    if (operation == 'legal_district_lawyer_grid') {
                        var lawyer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            lawyer.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#lawyer_grid").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Select Lawyer",
                            source: lawyer,
                            width: '98%',
                            height: 25
                        });

                    }

                },
                error: function(model, xhr, options) {
                    alert('failed');
                },
            });

            return false;
        }

        function datePicker(id) {
            jQuery(document).ready(function() {
                jQuery("*").dblclick(function(e) {
                    e.preventDefault();
                });
                jQuery('#' + id).datepicker({
                    inline: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    showButtonPanel: true,

                });
            });
        }
    </script>

    <body>
        <div class="slider_heading" style="height:30px;font-size:22px;padding:5px 0 0 10px;color:white"> Edit </div>
    </body>

    <div id="lawer_bill">

        <form method="POST" name="court_entertainment_from" id="court_entertainment_from" style="margin:0px;">

            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <input type="hidden" name="edit_row" id="edit_row" value="<?php echo $id ?>">

            <table style="width:100%;margin-top:20px" id="tab1Table">
                <tbody>
                    <tr>
                        <td width="50%" style="display:contents;">
                            <table style="width: 50%;">

                                <tr>
                                    <td width="40%" style="font-weight: bold;">Case No <strong style="color: red;">*</strong></td>
                                    <td width="60%"><input name="case_number" type="text" tabindex="1" style="width:250px" id="case_number" /></td>
                                </tr>


                                <tr id="lawyer_region_row">
                                    <td width="40%" style="font-weight: bold;">Legal Region <strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="legal_region" tabindex="3" name="legal_region" style="padding-left: 3px"></div>
                                    </td>

                                </tr>
                                <tr id="lawyer_district_row">
                                    <td width="40%" style="font-weight: bold;">Legal District <strong style="color: red;">*</strong></td>
                                    <td width="60%" id="">
                                        <div id="legal_district" tabindex="3" name="legal_district" style="padding-left: 3px"></div>
                                    </td>

                                </tr>

                                <tr>
                                    <td width="40%" style="font-weight: bold;"> Bill Amount <strong style="color: red;">*</strong></td>
                                    <td width="60%"><input name="amount" type="text" tabindex="1" style="width:250px" id="amount" /></td>
                                </tr>

                                <!-- PO Date -->
                                <tr>
                                    <td><strong style="vertical-align:top">Transition Date<span style="color: red;">*</span></strong></td>
                                    <td width="60%">
                                        <input style="width:250px" name="txrn_dt" id="txrn_dt" type="text" class="text-input" placeholder="dd/mm/yyyy">
                                        <script type="text/javascript">
                                            datePicker("txrn_dt");
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <td><strong style="vertical-align:top">Activities Name<span style="color: red;">*</span></strong></td>
                                    <td width="60%">

                                        <div id="expense_activities" name="expense_activities"></div>

                                    </td>
                                </tr>

                                <tr>
                                    <td><strong style="vertical-align:top">Particulars</strong></td>
                                    <td width="60%">
                                        <textarea name="expense_remarks" id="expense_remarks" cols="32" rows="2"><?= isset($result->expense_remarks) ? $result->expense_remarks : '' ?></textarea>

                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>

                                        <input type="button" value="Update" class="savebtn" id="update_btn" />
                                        <span id="send_loading" style="display: none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom" /></span>
                                    </td>
                                </tr>



                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>

            </tbody>
            </table>
        </form>
    </div>
<?php } else if ($option == "others") { ?>


    <script>
        var theme = getDemoTheme();
        var expense_activities = [<? $i = 1;
                                    foreach ($expense_activities as $row) {
                                        if ($i != 1) {
                                            echo ',';
                                        }
                                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                        $i++;
                                    } ?>];





        jQuery(document).ready(function() {

            jQuery("#activities").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Activities",
                source: expense_activities,
                width: 250,
                height: 25
            });


            jQuery("#vendor_name").val('<?= isset($result->vendor_name) ? $result->vendor_name : '' ?>');
            jQuery("#amount").val('<?= isset($result->amount) ? $result->amount : '' ?>');
            jQuery("#activities_date").val('<?= isset($result->txrn_dt) ? $result->txrn_dt : '' ?>');
            jQuery("#activities").jqxComboBox('val', '<?= isset($result->activities_id) ? $result->activities_id : '' ?>');
            jQuery("#remarks").val('<?= isset($result->expense_remarks) ? $result->expense_remarks : '' ?>');

            // Ajax Submit 

            var rules = [

                {
                    input: '#vendor_name',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#vendor_name").val() == '') {
                            jQuery("#vendor_name").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

   

                {
                    input: '#amount',
                    message: 'required!',
                    action: 'keyup, blur',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() == '') {
                            jQuery("#amount").focus();
                            return false;
                        } else {
                            return true;
                        }
                    }
                },

                {
                    input: '#amount',
                    message: 'Only Numeric',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (jQuery("#amount").val() != '') {
                            if (!checkNANwDOT('amount')) {
                                jQuery("#amount").focus();
                                return false;
                            }
                        }
                        return true;

                    }
                },

                {
                    input: '#activities_date',
                    message: 'required',
                    action: 'keyup, blur, change',
                    rule: function(input, commit) {
                        if (input.val() != '') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                },

                {
                    input: '#activities',
                    message: 'required!',
                    action: 'blur,change',
                    rule: function(input) {
                        if (input.val() != '') {
                            var item = jQuery("#activities").jqxComboBox('getSelectedItem');
                            if (item != null) {
                                jQuery("input[name='activities']").val(item.value);
                            }
                            return true;
                        } else {
                            jQuery("#activities input").focus();
                            return false;
                        }
                    }
                },

            ];

            jQuery("#update_btn").click(function() {
                jQuery('#others_form').jqxValidator({
                    rules: rules,
                    theme: theme
                });
                var validationResult = function(isValid) {
                    if (isValid) {
                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();
                        call_ajax_submit();
                    } else {
                        return;
                    }
                }
                jQuery('#others_form').jqxValidator('validate', validationResult);
            });
        });

        function call_ajax_submit() {

            var edit_row = jQuery("#edit_row").val();
            var csrfName = jQuery('.txt_csrfname').attr('name');
            var csrfHash = jQuery('.txt_csrfname').val();
            var postData = jQuery('#others_form').serialize() + "&" + csrfName + "=" + csrfHash;
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/edit_action_others",
                data: postData,
                datatype: "json",
                async: false,
                success: function(response) {

                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    csrf_tokens = json.csrf_token;

                    if (json.Message != 'OK') {
                        jQuery("#update_btn").show();
                        jQuery("#send_loading").hide();
                        alert("something went wrong");

                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                        return false
                    } else {

                        jQuery("#update_btn").hide();
                        jQuery("#send_loading").show();

                        window.parent.jQuery("#error").show();
                        window.parent.jQuery("#error").fadeOut(11500);
                        window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Update');
                        window.top.EOL.messageBoard.close();
                        window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
                        window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');

                    }

                }
            });

        }

        function validate(val) {
            //console.log(val.length)
            jQuery('#idbody').jqxValidator({
                rules: val
            });
            var d = true;
            if (val.length > 0) {
                d = false;
            }
            var validationResult = function(isValid) {
                if (isValid) {
                    d = true;
                }
            }
            jQuery('#idbody').jqxValidator('validate', validationResult);

            return d;
        }


        function datePicker(id) {
            jQuery(document).ready(function() {
                jQuery("*").dblclick(function(e) {
                    e.preventDefault();
                });
                jQuery('#' + id).datepicker({
                    inline: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    showButtonPanel: true,

                });
            });
        }
    </script>

    <body>
        <div class="slider_heading" style="height:30px;font-size:22px;padding:5px 0 0 10px;color:white"> Edit </div>
    </body>

    <div id="lawer_bill">

        <form method="POST" name="others_form" id="others_form" style="margin:0px;">

            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

            <input type="hidden" name="edit_row" id="edit_row" value="<?php echo $id ?>">

            <table style="width:100%;margin-top:20px" id="tab1Table">
                <tbody>
                    <tr>
                        <td width="50%" style="display:contents;">

                            <table style="width: 50%;">
                                <tr id="load_row">
                                    <td width="40%" style="font-weight: bold;"><strong>Vendor Name</strong><span style="color:red">*</span> </td>
                                    <td width="60%">
                                        <input name="vendor_name" tabindex="3" type="text" class="" style="width:250px" id="vendor_name" value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%" style="font-weight: bold;">Activities Name<span style="color:red">*</span> </td>
                                    <td width="60%">
                                        <div id="activities" name="activities" style="padding-left: 3px"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%" style="font-weight: bold;">Activities Date<span style="color:red">*</span></td>
                                    <td width="60%"><input type="text" name="activities_date" placeholder="dd/mm/yyyy" style="width:250px;" id="activities_date" value="">
                                        <script type="text/javascript" charset="utf-8">
                                            datePicker("activities_date");
                                        </script>
                                    </td>

                                </tr>
                                <tr>
                                    <td width="40%" style="font-weight: bold;">Amount<span style="color:red">*</span> </td>
                                    <td width="60%"><input name="amount" type="text" class="" style="width:250px" id="amount" value="" /></td>
                                </tr>
                                <tr>
                                    <td width="40%" style="font-weight: bold;">Remarks</td>
                                    <td width="60%"><textarea type="text" name="remarks" id="remarks" rows="3" cols="32"></textarea></td>
                                </tr>



                                <tr>
                                    <td></td>
                                    <td>

                                        <input type="button" value="Update" class="savebtn" id="update_btn" />
                                        <span id="send_loading" style="display: none;">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom" /></span>
                                    </td>
                                </tr>


                            </table>



                        </td>
                        <td width="50%" style="display:contents;"> </td>
                    </tr>
                </tbody>
            </table>

            </tbody>
            </table>
        </form>
    </div>

<?php } ?>