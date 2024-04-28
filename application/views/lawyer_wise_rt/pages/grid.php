<style>
    #loading-page {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        /* semi-transparent white background */
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(1px);
        /* backdrop-filter for the blur effect */
        z-index: 9999;
    }

    #loading-text {
        font-size: 24px;
        color: #333;
    }
</style>



<!-- Loading Page -->
<div style="display: none;" id="loading-page">
    <p id="loading-text">Loading...<img src="<?= base_url() ?>images/loader.gif" align="bottom"></p>
</div>










<style type="text/css">
    #details {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .flex-container {
        display: flex;
        flex-direction: row;
        /* or column, row-reverse, column-reverse */
        justify-content: space-between;
        /* or flex-start, flex-end, center, space-around, space-evenly */
        align-items: center;
        /* or flex-start, flex-end, center, baseline, stretch */
        flex-wrap: nowrap;
        /* or wrap, wrap-reverse */
    }

    .flex-item {
        /* Additional styles for flex items */
    }


    #post_sts {
        width: 184px;
        height: 36px;
        text-align: center;
        font-family: initial;
        font-size: 23px;
        background: none;
        border: none;
        border: 2px solid #3cc;
        border-radius: 25px;
        cursor: pointer;
    }
</style>

<script type="text/javascript">
    jQuery().ready(function() {
    });
</script>
<?
$lawyer = $this->user_model->get_parameter_data('ref_lawyer', 'name', "data_status = '1'");
$district = array();
$report_sheet = array();
$report_sheet['1'] ='Court Fee Data Disburesd';
$report_sheet['2']='Court Fee Data Unused';
$report_sheet['3']='CMA Data';
$report_sheet['4']='Suit Data';
$report_sheet['5']='Pending Bill';
$report_sheet['6']='Disbursed Bill';
?>

    <script language="javascript" type="text/javascript">
        var start = 1990;
        let date = new Date().getFullYear();
        var year = [];
        for (var i = date; i >= start; i--) {
            year.push({
                value: i,
                label: i
            });
        }



        jQuery().ready(function() {
            
            var lawyer = [<? $i = 1;
                            foreach ($lawyer as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
            var region = [<? $i = 1;
                foreach ($region as $row) {
                    if ($i != 1) {
                        echo ',';
                    }
                    echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                    $i++;
                } ?>];


            var district = [<? $i = 1;
                            foreach ($district as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
            var report_sheet = [<? $i=1; foreach($report_sheet as $key=>$row){ if($i!=1){echo ',';} echo '{value:"'.$key.'", label:"'.$row.'"}'; $i++;}?>];
            jQuery("#report_sheet").jqxComboBox({theme: theme,  autoOpen: false, placeHolder: "Select Sheet", autoDropDownHeight: false, source: report_sheet, width: 200, height: 35});
            jQuery("#year").jqxDropDownList({
                theme: theme,
                checkboxes: true,
                autoDropDownHeight: false,
                promptText: "Year",
                filterable: true,
                searchMode: 'containsignorecase',
                source: year,
                width: 120,
                height: 35
            });
            jQuery("#legal_region").jqxDropDownList({
                theme: theme,
                checkboxes: true,
                autoDropDownHeight: false,
                promptText: "Select Region",
                filterable: true,
                searchMode: 'containsignorecase',
                source: region,
                width: 200,
                height: 35,
            });

            jQuery("#lawyer_name").jqxDropDownList({
                theme: theme,
                checkboxes: true,
                autoDropDownHeight: false,
                promptText: "Lawyer Name Dropdown",
                filterable: true,
                searchMode: 'containsignorecase',
                source: lawyer,
                width: 200,
                height: 35
            });

            jQuery("#district").jqxDropDownList({
                theme: theme,
                checkboxes: true,
                autoDropDownHeight: false,
                promptText: "Select district",
                filterable: true,
                searchMode: 'containsignorecase',
                source: district,
                width: 200,
                height: 35,

            });

            var ww = jQuery(window).width();
            var hh = jQuery(window).height();
            ww = ww - 20;
            hh = hh - 250;
            jQuery("#data_div").width(ww);
            jQuery("#data_div").height(hh);

            jQuery('#legal_region').bind('select', function(event) {
                change_dropdown('legal_region');
            });


        });
        function checkform_summery()
        {
            if(jQuery("#year").val()=='' && jQuery("#legal_region").val()=='' && jQuery("#district").val()=='' && jQuery("#lawyer_name").val()=='')
            {
                alert('Please Select At least one Parameter!!');
                return false;
            }
            return true;
        }
        function checkform_details()
        {
            if(jQuery("#year").val()=='' && jQuery("#legal_region").val()=='' && jQuery("#district").val()=='' && jQuery("#lawyer_name").val()=='' && jQuery("#report_sheet").val()=='')
            {
                alert('Please Select At least one Parameter!!');
                return false;
            }
            if(jQuery("#lawyer_name").val()=='' && jQuery("#report_sheet").val()=='')
            {
                alert('Please Select A Sheet to get all Lawyer Data!!');
                return false;
            }
            return true;
        }
        function change_dropdown(operation, edit = null) {
            var id = '';
            //check for add Region action
            if (edit == null) {
                id = jQuery("#" + operation).val();
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
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();

                    if (operation == 'legal_region') {
                        var district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            district.push({
                                value: obj.id,
                                label: obj.name
                            });
                        });
                        jQuery("#district").jqxDropDownList({
                            theme: theme,
                            checkboxes: true,
                            autoDropDownHeight: false,
                            promptText: "Select district",
                            filterable: true,
                            searchMode: 'containsignorecase',
                            source: district,
                            width: 250,
                            height: 35,
                        });
                    }

                },
                error: function(model, xhr, options) {
                    alert('failed');
                },
            });

            return false;
        }
        function search_submit() // customer search 
        {

            if(jQuery("#year").val()=='' && jQuery("#legal_region").val()=='' && jQuery("#district").val()=='' && jQuery("#lawyer_name").val()=='')
            {
                alert('Please Select At least one Parameter!!');
                return false;
            }
            var postdata = jQuery('#daily_report_search').serialize();

            jQuery("#loading-page").show();
            jQuery.ajax({
                type: "POST",
                cache: false,
                async: true,
                url: "<?= base_url() ?>index.php/lawyer_wise_rt/daily_report/",
                data: postdata,
                datatype: "json",
                success: function(response) {
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    jQuery("#loading-page").hide();
                    if(json.str_html!='')
                    {
                        jQuery('#list_body').html(json.str_html);
                    }
                    else
                    {
                        alert('Something went wrong!!!!');
                    }
                    
                    
                }
            });
        }
    </script>
    <style type="text/css">
        th {
            border-color: #ccc;
        }
    </style>

    <style>
        /* Custom styles for jqxComboBox */
        #jqxComboBox {
            width: 200px;
        }

        .custom-combobox {
            border: 3px solid #46b8b8;
            border-radius: 10px;
            overflow: hidden;
        }

        .custom-combobox input {
            padding: 5px;
            font-size: 14px;
            border: none;
            width: 80%;
            outline: none;
            box-sizing: border-box;
        }

        .custom-combobox .jqx-dropdownlist-content {
            padding: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 4px 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .custom-combobox .jqx-dropdownlist-arrow-normal {
            border-top: 6px solid #333;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
        }

        .custom-combobox .jqx-fill-state-pressed {
            background-color: #f0f0f0;
        }

        .custom-combobox .jqx-fill-state-hover {
            background-color: #e0e0e0;
        }
    </style>

    <div id="container" style="">
        <div id="body">
            <div style="display:block; height:auto">
                <form method="POST" name="form" target="_blank" id="daily_report_search" style="margin:0px;" action="<?= base_url() ?>index.php/lawyer_wise_rt/daily_report_xl/">
                    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <div style="padding: 1%;width:96%;height:45px; border:2px solid #3cc;font-family: Calibri;font-size: 14px;border-radius: 1rem;margin: 0 auto;">



                        <table id="deal_body" style="display:block;width:100%">
                            <tr>

                                <td style="width:5%">
                                    <div style="padding-right:1.8%" id="year" name="year"></div>
                                </td>


                                <td style="width:10%">
                                    <div style="padding-left:1.8%" id="legal_region" name="legal_region"></div>
                                </td>

                                <td style="width:10%">
                                    <div style="padding-left:1.8%" id="district" name="district"></div>
                                </td>
                                <td style="width:10%">
                                    <div style="padding-left:1.8%" id="lawyer_name" name="lawyer_name"></div>
                                </td>

                                <td style="width:10%">
                                    <div style="padding-left:1.8%" id="report_sheet" name="report_sheet"></div>
                                </td>




                                <td style="width:3%"><input onclick="search_submit()" name="post_sts" id="post_sts" class="crmbutton small create" value="Search" type="button">


                                <td style="width:3%">
                                    <button type='submit' onClick="return checkform_details();" formtarget="_blank" name='ac_wise_dump' id="post_sts" value='A/C Wise Dump' class="crmbutton small create xl_crmbutton" style="">A/C Wise Dump</button>
                                    <!-- <input  type="submit" formtarget="_blank"  name="post_sts" id="post_sts" class="crmbutton small create xl_crmbutton" value="A/C Wise Dump"> -->

                                </td>

                            </tr>
                        </table>
                    </div>
                    <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span></div>

                
            </div>
        </div>
    </div>

    <style>
        h2 {
            padding: 0;
            margin: 0;
            line-height: 2rem;
            font-family: ari;
            color: black;
            text-transform: uppercase;
        }
    </style>


    <table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
        <tbody>
            <tr>
                <td width="100%" style="border:#837E6F 2px inset">
                    <div id="data_div" style="overflow:scroll;min-width: 1000px;min-height: 100px; height: 220px;">

                        <table style="font-size:10pt" width="100%" class="input_box" border="0" cellspacing="0" cellpadding="1" align="center">
                            <thead>
                                <tr>
                                    <td style="text-align: center;" colspan="15">

                                        <!-- <h2>LAWYER NAME: <div id="lawyer_name_div"></div>
                                        </h2>
                                        <h2>REGION: <div id="region_name_div"></div>
                                        </h2>
                                        <h2>DISTRICT: <div id="drstrict_name_div"></div>
                                        </h2>
                                        <h2>Year: <div id="year_name_div"></div>
                                        </h2> -->
                                        <button type='submit' onClick="return checkform_summery();" formtarget="_blank" name='xl_search' id="xl_search" value='Search' style="width:58px;border: none;background: transparent"><img width="30px" id="xl_button_design" src="<?= base_url() ?>images/xl_logo_.png"></button>
                                        <!-- <img class="xl_crmbutton" width="30px" src="<?= base_url() ?>/images/xl_logo_.png" alt="xl logo"> -->
                                    </td>


                                </tr>
                            </thead>



                            <style>
                                th {
                                    color: #000;
                                    font-weight: 80000;
                                    font-size: 17px;
                                    font-family: initial;
                                    font-weight: bold;
                                    text-align: center;
                                }
                            </style>

                            <tr style="text-align:left; font-weight:bold; background-color:#3cc; border-color: #000 ;">
                                <th style="padding: 13px; " align="center">Lawyer Name</th>
                                <th style="padding: 13px; " align="left">Total File Assign</th>
                                <th style="padding: 13px; " align="left">Case Filing Completed</th>
                                <th style="padding: 13px; " align="left">Case Filing Pending</th>
                                <th style="padding: 13px; " align="left">Case Disposal</th>
                                <th style="padding: 13px; " align="left">Court Fees Disbursement</th>
                                <th style="padding: 13px; " align="left">Court Fees Unused</th>
                                <th style="padding: 13px; " align="left">ProfessionalBill Pending</th>
                                <th style="padding: 13px; " align="left">Disbursement Bill</th>
                                <th style="padding: 13px; " align="left">Running Case</th>
                            </tr>

                            <tbody id="list_body">

                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>