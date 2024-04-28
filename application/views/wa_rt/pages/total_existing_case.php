<?php $this->load->view('wa_rt/pages/css'); ?>


<script type="text/javascript">
        var theme = 'classic';
    var year = [<? $i=1; for($j=date('Y');$j>=1990;$j--){ if($i!=1){echo ',';} echo '{value:"'.$j.'", label:"'.$j.'"}'; $i++;}?>];

    jQuery(document).ready(function () {
        
       jQuery("#year").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Year", source: year, width: 150, height: 25});
        jQuery('#year').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

       
    });

function search_data(){
    //var months = jQuery("#month").jqxComboBox('getSelectedItem');
    var year = jQuery("#year").jqxComboBox('getSelectedItem');
   
    
    if(year==null)
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
            url: "<?=base_url()?>index.php/wa_rt/total_existing_case_rt/",
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
                <td valign="top" align="left" class='navigation' style="width: 15%;">
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('wa_rt/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->
                </td>
                <td valign="top" id="demos" class='rc-all content'  style="width:85%;overflow: hidden;">
                    <div id="search_area">
                    <form method="POST" name="form" id="form" action="<?php echo base_url('wa_rt/total_existing_case_rt_xl'); ?>"  style="margin:0px;">
                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                       <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                            <table id="deal_body" style="display:block;width:100%">
                                <tr>
                                    
                                    <td><strong>Year&nbsp;&nbsp;</strong> </td>
                                    <td><div id="year" name="year"></div></td>
                                    <td><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                    </td>
                                    <td><button type='submit' formtarget="_blank" name='xl_search' id="xl_search" value='Search' style="width:58px;border: none;background: transparent;display: none;cursor: pointer;"><img src="<?=base_url()?>images/icon_xls.gif" width="20px" height="20px"></button>
                                    </td>
                                </tr>
                            </table>
                      </div>
                      <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                      
                    </form>
                    </div>
                    <div id="searchTable"  style="display: none;"></div>
                </td>
            </tr>
        </table>
    </div>
</div>


