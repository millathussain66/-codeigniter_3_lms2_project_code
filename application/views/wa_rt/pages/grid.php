<?php $this->load->view('wa_rt/pages/css'); ?>


<script type="text/javascript">
        var theme = 'classic';
    var type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var proposed_type =['Loan','Card'];
    jQuery(document).ready(function () {
        jQuery("#s_proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 150, height: 25});
        jQuery("#case_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: type, width: 150, height: 25});       
        jQuery('#case_type,#s_proposed_type').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

        jQuery("#s_proposed_type").jqxComboBox('val','Loan');
        change_caption();
        jQuery('#s_proposed_type').bind('change', function (event) {
            jQuery("#s_account").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();       
        });

        jQuery(window).bind('resize', function() {
            var width = window.innerWidth-244;
            var height = window.innerHeight-258;
            jQuery("#searchTable").css("width",width);
            //jQuery("#searchTable").css("height",height);
        });

    });

function mask(str,textbox){
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
function change_caption(){   
    if (jQuery("#s_proposed_type").val()=='') 
    {
        document.getElementById("s_account").disabled = true;
        jQuery("#l_or_c_no").html('Loan A/C or Card');
    }
    else
    {
        document.getElementById("s_account").disabled = false;
        var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
        if (item.value=='Loan') {
            jQuery("#l_or_c_no").html('Loan A/C ');
        }
        else if(item.value=='Card'){
            jQuery("#l_or_c_no").html('Card');
        }
    }
    
}
function search_data(){
    
    var loan_ac = jQuery('#s_account').val();
    var case_number = jQuery('#s_case_number').val();
    var s_proposed_type = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
    var case_type = jQuery("#case_type").jqxComboBox('getSelectedItem');
    if(case_type==null && s_proposed_type==null && loan_ac=='' && case_number=='')
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
            url: "<?=base_url()?>index.php/wa_rt/execution_rt/",
            data : postdata,
            datatype: "html",
            success: function(response){
                //console.log(response)
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
                <td valign="top" id="demos" class='rc-all content'>
                    <div id="search_area" style="_max-width: 85%;">
                    <form method="POST" name="form" id="form" action="<?php echo base_url('wa_rt/execution_rt_xl'); ?>"  style="margin:0px;">
                        <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                       <div style="padding: 0px;_width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                            <table id="deal_body" style="_display:block;_width:100%">
                                <tr>
                                    <td><strong>Type of Case&nbsp;&nbsp;</strong> </td>
                                    <td><div id="case_type" name="case_type"></div></td>
                                    <td><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                    <td><div id="s_proposed_type" name="s_proposed_type"></div></td>
                                    <td style="width: 70px;"><strong><span id="l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
                                    <td><input name="s_account" tabindex="" type="text" class="" maxlength="16" size="16" style="width: 125px;" id="s_account" value="" onKeyUp="javascript:return mask(this.value,this);"/>
                                        </td>
                                    <td><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                    <td><input type="text" id="s_case_number" name="s_case_number" style="" /></td>
                                    <td><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                    </td>
                                    <td  style="text-align:left;_width:5%"><button type='submit' formtarget="_blank" name='xl_search' id="xl_search" value='Search' style="border: none;background: transparent;display: none;cursor: pointer;"><img src="<?=base_url()?>images/icon_xls.gif" width="20px" height="20px"></button>
                                    </td>
                                </tr>
                            </table>
                      </div>
                      <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                      
                    </form>
                    <div id="searchTable"  style="display: none;height: 400px;border:1px solid #000;overflow: scroll;width:1120px;"></div>
                    
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

