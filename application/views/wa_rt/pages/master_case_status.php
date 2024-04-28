<?php $this->load->view('wa_rt/pages/css'); ?>


<script type="text/javascript">
        var theme = 'classic';
    var type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    jQuery(document).ready(function () {

        jQuery("#case_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: type, width: 250, height: 25});
        
       
        jQuery('#case_type').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

       
    });

function search_data(){
    var loan_ac = jQuery('#s_account').val();
    var case_number = jQuery('#s_case_number').val();
   
    
    if(loan_ac=='' && case_number=='')
    {
        alert('Please provide at least one search parameter!!!');
    }
    else
    {
        jQuery("#grid_loading").show();
        //jQuery("#load").hide();
        var postdata = jQuery('#form').serialize();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>index.php/wa_rt/master_case_rt/",
            data : postdata,
            datatype: "html",
            success: function(response){
                console.log(response)
                jQuery("#grid_loading").hide();
                var data = response.split("####");
                jQuery('.txt_csrfname').val(data[1]);
                jQuery("#load_suit_loading").hide();
                jQuery("#load").show();
                jQuery("#xl_search").show();
                jQuery('#searchTable').show();
                jQuery('#searchTable').html(data[0]);

            }
        });
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
                    <?php $this->load->view('wa_rt/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->
                </td>
                <td valign="top" id="demos" class='rc-all content' style="max-width: 90%;">
                    <div id="search_area" style="_max-width: 33%;">
                    <form method="POST" name="form" id="form" action="<?php echo base_url('wa_rt/master_case_rt_xl'); ?>"  style="margin:0px;">
                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                       <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                            <table id="deal_body" style="display:block;width:100%">
                                <tr>
                                    <td style="text-align:right;width:10%"><strong>Type of Case&nbsp;&nbsp;</strong> </td>
                                    <td style="width:20%"><div id="case_type" name="case_type"></div></td>
                                    <td style="text-align:right;width:10%"><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                    <td style="width:15%"><input type="text" id="s_case_number" name="s_case_number" style="width:100%" /></td>
                                    <td style="text-align:right;width:10%"><strong>Account&nbsp;&nbsp;</strong> </td>
                                    <td style="width:15%"><input type="text" id="s_account" name="s_account" maxlength="16" style="width:100%" /></td>
                                    <td  style="text-align:left;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                    </td>
                                    <td  style="text-align:left;width:5%"><button type='submit' formtarget="_blank" name='xl_search' id="xl_search" value='Search' style="width:58px;border: none;background: transparent;display: none;"><img src="<?=base_url()?>images/icon_xls.gif" width="20px" height="20px"></button>
                                    </td>
                                </tr>
                            </table>
                      </div>
                      <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                      
                    </form>
                    </div>
                    <div id="searchTable"  style="max-width: 1120px;overflow: hidden;overflow: scroll;display: none;height: 500px;"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
