<?php $this->load->view('hc_matter/pages/css'); ?>

<script type="text/javascript">
    var theme = getDemoTheme();
    var proposed_type = ["Loan", "Card"];
    var limit = [100, 200,500];

    var req_type = [<? $i=1; foreach($hc_case_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var loan_segment = [<? $i=1; foreach($loan_segment as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}'; $i++;}?>];
     var hc_case_type = [<? $i=1; foreach($hc_case_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
     var case_category = [<? $i=1; foreach($hc_case_category as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
     var hc_case_status=[];
     var proposed_type =['Loan','Card'];
    //var limit =['5','100','All'];
    jQuery(document).ready(function () {
        jQuery("#proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 150, height: 25});
        jQuery("#limit").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Limit", source: limit, width: 100, height: 25});
        jQuery("#portfolio").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Portfolio", source: loan_segment, width: 150, height: 25});
        jQuery("#case_category").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Category", source: case_category, width: 150, height: 25});
        jQuery("#case_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: hc_case_type, width: 150, height: 25});
        
        jQuery("#present_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Present Proceeding Status", source: hc_case_status, width: 200, height: 25});  
              
        jQuery('#portfolio,#case_type,#present_status,#limit,#proposed_type,#case_category').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });  

        jQuery("#proposed_type").jqxComboBox('val','Loan');
        change_caption();
        jQuery('#proposed_type').bind('change', function (event) {
            jQuery("#ac_no").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();       
        });



        jQuery("#limit").jqxComboBox('val',100);
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        
                        break;
                    /*case 1:
                        //initGrid();
                        break;*/
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
               //clear_form();
            });
           // jQuery('#jqxTabs').jqxTabs('select', 1);
            
            /*var win_h=jQuery( window ).height()-330;
            document.getElementById('search_div').setAttribute("style","padding:10px;margin:0 0px;width:1110px;overflow-y:scroll;height:"+win_h+"px");*/
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
        });
function mask(str,textbox){
    var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
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
    if (jQuery("#proposed_type").val()=='') 
    {
        document.getElementById("ac_no").disabled = true;
        jQuery("#s_l_or_c_no").html('Loan A/C or Card');
    }
    else
    {
        document.getElementById("ac_no").disabled = false;
        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
        if (item.value=='Loan') {
            jQuery("#s_l_or_c_no").html('Loan A/C ');
        }
        else if(item.value=='Card'){
            jQuery("#s_l_or_c_no").html('Card');
        }
    }
    
}
    function get_case_status(){
        var item = jQuery("#case_type").jqxComboBox('getSelectedItem');
        if (item!=null)
        {
            var case_type = item.value;
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?=base_url()?>index.php/hc_matter/get_case_status',
            async:false,
            type: "post",
           data: { [csrfName]: csrfHash,case_type : case_type},
            datatype: "json",
            success: function(response){
               // console.log(response);
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var str='';
                var theme = getDemoTheme();
                        var present_status = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            present_status.push({ value: obj.id, label: obj.name });
                            //alert(obj.name);
                        });
                        //console.log(present_status);
                        jQuery("#present_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Present Proceeding Status", source: present_status, width: 250, height: 25});
                        jQuery('#present_status').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                },
                error:   function(model, xhr, options){
                    alert('failed');
                },
                });
        }
        else
        {
            jQuery("#present_status").jqxComboBox('clearSelection');
            jQuery("#present_status").val('');
        }
    }
    function searchdata()// customer search 
    {
        jQuery("#grid_loading").show();
        jQuery("#grid_search").hide();
        var postdata = jQuery('#action_form').serialize();
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>index.php/hc_matter/get_ad_case_details/",
            data :postdata,
            datatype: "html",
            success: function(response){
                //console.log(response);
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('#search_res').empty();
                var html_str='';var i=1;
                json.row_info.forEach(function(row,index) {

                    html_str+='<tr><td align="center">'+i+'</td>';
                    html_str+='<td align="left"><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details(\''+row.id+'\',\''+row.hc_matter_type+'\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div></td>';
                    html_str+='<td align="left">'+row.ac_number+'</td>';
                    html_str+='<td align="left">'+row.ac_name+'</td>';
                    html_str+='<td align="left">'+row.portfolio_name+'</td>';
                    html_str+='<td align="left">'+row.case_category_name+'</td>';
                    html_str+='<td align="left">'+row.hc_type_name+'</td>';
                    html_str+='<td align="left">'+row.case_no+'</td>';
                    html_str+='<td align="left">'+row.case_claim+'</td>';
                    html_str+='<td align="left">'+row.filing_date+'</td>';
                    html_str+='<td align="left">'+row.district_name+'</td>';
                    html_str+='<td align="left">'+row.case_sts_name+'</td>';
                    html_str+='<td align="left">'+row.last_act+'</td>';
                    html_str+='<td align="left">'+row.present_cause_action+'</td></tr>';
                    i++;

                });
                
                jQuery("#grid_loading").hide();
                jQuery("#grid_search").show();
                if(json.row_info.length>0){
                    jQuery('#xl_search').show();
                }else{
                    jQuery('#xl_search').hide();
                    html_str+='<tr><td align="center" colspan="13">No Data Found</td></tr>';
                }
                jQuery('#search_res').append(html_str);
                
                //jQuery('#xl').attr('href','<?=base_url()?>index.php/legal_file_process/make_xl/'+req_type+'/'+proposed_type+'/'+ac+'/'+region+'/'+territory+'/'+district+'/'+unit_office+'/'+loan_segment+'/'+case_number); 

            }
        });
        
    }
    function details (id,hc_matter_type) {
    //console.log(dataRecord);
    jQuery("#r_heading").html('AD Matter');

    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/get_data_details_preview_ad/"+id,
        data : {[csrfName]: csrfHash,hc_matter_type:hc_matter_type},
        datatype: "json",
        async:false,
        success: function(response){
            var ds=response.split('####');
            jQuery('.txt_csrfname').val(ds[1]);
            jQuery('#previewtable').html(ds[0]);
        }
    });
    
    document.getElementById("details").style.display='block';
    jQuery("#details").jqxWindow('open');
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
                        <div >
                            <div id='jqxTabs'>
                                <ul>
                                	
                                    <li style="margin-left: 30px;">ADM Case Details</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;" class="back_image">
                                    <form method="POST" name="form" id="action_form"  style="margin:0px;" action="<?php echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>ad_case_details">
                                        <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                       <div style="padding-right:5px ; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                            <table id="deal_body" style="display:block;width:100%">
                                                <tr>
                                                   
                                                    <td style="text-align:right;width:4%"><strong>Portfolio&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:11%"><div style="padding-left:1.8%" id="portfolio" name="portfolio"></div></td>
                                                    <td style="text-align:right;width:4%"><strong>Case Category&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:11%"><div style="padding-left:1.8%" id="case_category" name="case_category"></div></td>
                                                    <td style="text-align:right;width:11%"><strong>Case Types&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:13%"><div style="padding-left:1.8%" id="case_type" name="case_type" onchange="get_case_status()"></div></td>
                                                    <td style="text-align:right;width:25%"><strong>Present Proceeding Status&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:13%"><div style="padding-left:1.8%" id="present_status" name="present_status"></div></td>
                                                    
                                                    
                                                </tr>
                                            </table>
                                            <table id="deal_body" style="display:block;width:100%">
                                                <tr>
                                                    <td><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                    <td><div id="proposed_type" name="proposed_type"></div></td>
                                                    <td style="width: 100px;"><strong><span id="s_l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:13%"><input id="ac_no" name="ac_no" value="" style="width: 150px;" maxlength="16"/></td>
                                                    <td style="text-align:right;width:10%"><strong>Case/Rule NO&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:10%"><input id="case_number" name="case_number" value="" style="width: 150px;" /></td>
                                                    <td style="text-align:right;width:4%"><strong>Limit&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:10%"><div style="padding-left:1.8%" id="limit" name="limit"></div></td>
                                                    <td  style="text-align:right;width:5%"><input name="search" id="search" class="crmbutton small create"  value="Search Now" type="button" onclick="searchdata()">
                                                    </td>
                                                    
                                                    <td style="width:2%" valign="top">
                                                            <button type="submit" id="xl_search"  style="display: none;" formtarget="_blank" name="mk_xl"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                                            <!--a id="inXLadfc" style="text-align:center;cursor:pointer;" target="_blank" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></a-->
                                                        
                                                        
                                                    </td>
                                                    
                                                </tr>
                                            </table>
                                      </div>
                                      <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>

                                    </form>

                                    <table align="center" border="0"  cellpadding="0" cellspacing="0" width="98%">
                                        <tbody><tr>
                                            <td width="100%" valign="top">
                                                
                                                       <table style="font-size:10pt" width="100%" class="input_box" border="0" cellspacing="0" cellpadding="1" align="center">           
                                                        <tr style="text-align:left; font-weight:bold; background-color: #B8E4F3; border-color: #ccc">
                                                            <th align="center">Sl</th>
                                                            <th align="left">Preview</th>
                                                            <th align="left">A/C NO</th>
                                                            <th align="left">A/C NAME</th>
                                                            <th align="left">Portfolio</th>
                                                            <th align="left">Case Category</th>
                                                            <th align="left">Case Types</th>
                                                            <th align="left">CASE NO</th>
                                                            <th align="left">Case Claim</th>
                                                            <th align="left">Filing Date</th>
                                                            <th align="left">NAME OF DIST</th>
                                                            <th align="left">Status</th>
                                                            <th align="left">LAST ACTIVITIES</th>
                                                            <th align="left">PRESENT CAUSE OF ACTION</th>
                                                        </tr>
                                                       <tbody id="search_res"></tbody>
                                                    </table><br /><br /><br />
                                              
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                
                            </div>
                        </div>
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
        <input name="d_suit_id" id="d_suit_id" value="" type="hidden">
        <div id="previewtable"></div>
        <div id="preview" class="wrapper">
            </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
        </div>
       
        </form>
    </div>
</div>