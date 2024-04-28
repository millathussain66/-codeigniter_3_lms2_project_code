<script type="text/javascript">
	jQuery().ready(function() {
       jQuery('#report_list').bind('change', function () {
       		var val = jQuery('#report_list').val();
       		if (val == '0') {
       			return false;
       		}
            var url = "<?=base_url()?>index.php/"+val+"/<?=$menu_group?>/<?=$menu_cat?>";
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
        var wint = 140/2;
        var winl = 100/2;
        
        newwindow=window.open(url,'name',"height="+pheight+", width="+pwidth+",top="+wint+", toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left="+winl);
        if (window.focus) {newwindow.focus()}
        return false;
    }
</script>
<?
$region = $this->user_model->get_parameter_data('ref_region','name',"data_status = '1'");
$territory = array();
$unit_office = array();
$district = array();
//$status = $this->user_model->get_parameter_data('ref_status','name',"data_status = '1' AND id IN(3,6,7,8,9,10,11,12,13,14)");

$sorting = array(array('value' => 'b.region','name'=>'Region'),array('value' => 'b.territory','name'=>'Territory'),array('value' => 'b.district','name'=>'District'));
$ordering = array(array('value' => 'ASC','name'=>'ASC'),array('value' => 'DESC','name'=>'DESC'));
?>

<? if($option == 'daily_report'){ ?>
	<script language="javascript" type="text/javascript">
	jQuery().ready(function() {
        jQuery('#region').bind('change', function (event) {
            change_dropdown('region');      
        });
        jQuery('#territory').bind('change', function (event) {
                change_dropdown('territory');       
            });
        jQuery('#district').bind('change', function (event) {
                change_dropdown('district');        
            });

        <?php
        $sFromDate=implode('-',array_reverse(explode('/',$FromDate))); 
        $sToDate=implode('-',array_reverse(explode('/',$ToDate)));
        $sappFromDate=implode('-',array_reverse(explode('/',$appFromDate)));
        $sappToDate=implode('-',array_reverse(explode('/',$appToDate)));

        /*$territory_id=$territory_id!=''?$territory_id:0;
        $district_id=$district_id!=''?$district_id:0;
        $unit_office_id=$unit_office_id!=''?$unit_office_id:0;
        $sappFromDate=$sappFromDate!=''?$sappFromDate:0;
        $sappToDate=$sappToDate!=''?$sappToDate:0;
        $sFromDate=$sFromDate!=''?$sFromDate:0;
        $sToDate=$sToDate!=''?$sToDate:0;*/

        //$url ='?FromDate='.$sFromDate.'&ToDate='.$sToDate.'&status='.$status_id.'&region='.$region_id.'&territory='.$territory_id.'&district='.$district_id.'&unit_office='.$unit_office_id.'&limit='.$limit.'&appFromDate='.$sappFromDate.'&appToDate='.$sappToDate;
        //$url =$sFromDate.'/'.$sToDate.'/'.$status_id.'/'.$region_id.'/'.$territory_id.'/'.$district_id.'/'.$unit_office_id.'/'.$limit.'/'.$sappFromDate.'/'.$sappToDate;

        ?>
        /*jQuery('#inXLadfc').attr('href','<?=base_url()?>index.php/cma_rt/mk_xl_daily_report/<?=$url?>');
        jQuery("#daily_report_search").submit( function() {
            var FromDate = jQuery("#FromDate").val().trim();
            var ToDate = jQuery("#ToDate").val().trim();

            if(FromDate == ''){
                alert('Please enter From Date');
                jQuery("#FromDate").focus();
                return false;
            }
            if(ToDate == ''){
                alert('Please enter To Date');
                jQuery("#ToDate").focus();
                return false;
            }
        });*/

        var region = [{value:'0', label:'All Region'},<? $i=1; foreach($region as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#region").jqxComboBox({theme: theme, promptText: "Select Region",selectedIndex: 0, source: region, width: '97%', height: 21});
        var territory = [<? $i=1; foreach($territory as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#territory").jqxComboBox({theme: theme, promptText: "Select territory", source: territory, width: '97%', height: 21});
        var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '97%', height: 21});
        var unit_office = [<? $i=1; foreach($unit_office as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
        jQuery("#unit_office").jqxComboBox({theme: theme, promptText: "Select unit office", source: unit_office, width: '97%', height: 21});
        var status = [{value:'0', label:'All Status'},<? $i=1; foreach($status as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
            jQuery("#status").jqxComboBox({theme: theme, promptText: "Select Status",selectedIndex: 0, source: status, width: '97%', height: 21});
        var proposed_type = [{value:'', label:'All Type'},{value:'Loan', label:'Loan'},{value:'Card', label:'Card'}];
        jQuery("#proposed_type").jqxComboBox({theme: theme, promptText: "Type",selectedIndex: 0, source: proposed_type, width: '97%', height: 21});
        var limit = [100,200,300,400,500,1000,'All'];
        jQuery("#limit").jqxComboBox({theme: theme, promptText: "Limit",selectedIndex: 0, source: limit, width: '97%', height: 21});

        <? if($post_sts=='1'){?>
            

            jQuery("#region").jqxComboBox('val', '<?=(isset($region_id))?$region_id:''?>');
            
            jQuery("#territory").jqxComboBox('val', '<?=(isset($territory_id) && $territory_id!=0)?$territory_id:''?>');
            jQuery("#district").jqxComboBox('val', '<?=(isset($district_id) && $district_id!=0)?$district_id:''?>');
            jQuery("#unit_office").jqxComboBox('val', '<?=(isset($unit_office_id) && $unit_office_id!=0)?$unit_office_id:''?>');

            jQuery("#status").jqxComboBox('val', '<?=(isset($status_id))?$status_id:''?>');
            jQuery("#proposed_type").jqxComboBox('val', '<?=(isset($proposed_type))?$proposed_type:''?>');
            jQuery("#limit").jqxComboBox('val', '<?=(isset($limit))?$limit:''?>');
        <? } ?>


        jQuery('#region,#territory,#district,#unit_office,#status,#proposed_type,#limit').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

	});
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
         data: { [csrfName]: csrfHash,id : id,operation:operation},
        datatype: "json",
        success: function(response){
            var json = jQuery.parseJSON(response);
                    //console.log(json['row_info']);
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
                        jQuery("#territory").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select territory", source: territory, width: '97%', height: 21});
                        //For edit action
                        if (edit!=null) 
                        {
                            //alert('success');
                            jQuery("#territory").jqxComboBox('val', '<?=(isset($result->territory) && $result->territory!=0)?$result->territory:''?>');
                        }
                    }
                    if (operation=='territory') 
                    {
                        var district = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            district.push({ value: obj.id, label: obj.name });
                        });
                        jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: '97%', height: 21});
                        //For edit action
                        if (edit!=null) 
                        {
                            jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
                        }
                    }
                    if (operation=='district') 
                    {
                        var unit_office = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            unit_office.push({ value: obj.id, label: obj.name });
                        });
                        jQuery("#unit_office").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Unit Office", source: unit_office, width: '97%', height: 21});
                        //For edit action
                        if (edit!=null) 
                        {
                            jQuery("#unit_office").jqxComboBox('val', '<?=(isset($result->unit_office) && $result->unit_office!=0)?$result->unit_office:''?>');
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
<style type="text/css">
	th{border-color: #ccc;}
</style>
<div id="container" style="">
    <div id="body"  >
        <div  style="display:block; height:auto">
            <form method="POST" name="form" id="daily_report_search"  style="margin:0px;" action="<?=base_url()?>index.php/cma_rt/daily_report/<?=$menu_group?>/<?=$menu_cat?>">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
               <div style="padding: 0.5%;width:98%;height:60px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                    <table id="deal_body" style="display:block;width:100%">
                        <tr>
                           
                            <td style="text-align:right;width:4%"><strong>Region&nbsp;&nbsp;</strong> </td>
                            <td style="width:13%"><div style="padding-left:1.8%" id="region" name="region_id"></div></td>
                            <td style="text-align:right;width:5%"><strong>Territory&nbsp;&nbsp;</strong> </td>
                            <td style="width:13%"><div style="padding-left:1.8%" id="territory" name="territory"></div></td>
                            <td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
                            <td style="width:13%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
                            <td style="text-align:right;width:6%"><strong>Unit Ofice&nbsp;&nbsp;</strong> </td>
                            <td style="width:13%"><div style="padding-left:1.8%" id="unit_office" name="unit_office"></div></td>
                            <td style="text-align:right;width:5%"><strong>Type&nbsp;&nbsp;</strong> </td>
                            <td style="width:10%"><div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div></td>
                            <td style="text-align:right;width:4%"><strong>Limit&nbsp;&nbsp;</strong> </td>
                            <td style="width:10%"><div style="padding-left:1.8%" id="limit" name="limit"></div></td>
                            <td style="width:2%"></td>
                            
                        </tr>
                    </table>
                    <table id="deal_body" style="display:block;width:100%">
                        <tr>
                            <td style="text-align:right;width:5%"><strong>Status&nbsp;&nbsp;</strong> </td>
                            <td style="width:15%"><div style="padding-left:1.8%" id="status" name="status_id"></div></td>
                            <td style="text-align:right;width:5%"><strong>Init. Date:&nbsp;&nbsp;</strong> </td>
                            <td style="width:15%"><input id="FromDate" name="FromDate" value="<?=$FromDate?>" style="width:40%" /><script type="text/javascript">datePicker("FromDate");</script>
                            <strong>To</strong> <input id="ToDate" name="ToDate" value="<?=$ToDate?>"  style="width:40%" /><script type="text/javascript" >datePicker("ToDate");</script>
                            </td>
                            <td style="text-align:right;width:5%"><strong>App. Date:&nbsp;&nbsp;</strong> </td>
                            <td style="width:15%"><input id="appFromDate" name="appFromDate" value="<?=$appFromDate?>" style="width:40%" /><script type="text/javascript">datePicker("appFromDate");</script>
                            <strong>To</strong> <input id="appToDate" name="appToDate" value="<?=$appToDate?>"  style="width:40%" /><script type="text/javascript" >datePicker("appToDate");</script>
                            </td>
                            <td style="width:5%"><div style="padding-left:1.8%"><strong>Column&nbsp;&nbsp;</strong></div></td>
                            <td style="width:15%"><div style="padding-left:1.8%">
                                <select id="col_xl" tabindex="16" name="col_xl[]" multiple="multiple" style="width:250px">
                                    <option <?php if(!empty($col_xl)){if(in_array(1,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="1">SL No.</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(2,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="2">Requisition Type</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(3,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="3">Proposed Type</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(4,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="4">Loan A/C No.</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(5,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="5">CIF</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(6,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="6">Branch SOL</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(7,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="7">Loan A/C Name</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(8,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="8">Business Type</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(9,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="9">Spouse Name</option>
                                    <!--option <?php //if(!empty($col_xl)){if(in_array(10,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="10">Father Name</option-->
                                    <option <?php if(!empty($col_xl)){if(in_array(11,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="11">Mother Name</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(12,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="12">Loan Segment (Portfolio)</option>
                                    <!--option <?php //if(!empty($col_xl)){if(in_array(13,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="13">Permanent Address</option>
                                    <option <?php //if(!empty($col_xl)){if(in_array(14,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="14">Present Address</option>
                                    <option <?php //if(!empty($col_xl)){if(in_array(15,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="15">Business Address</option-->
                                    <option <?php if(!empty($col_xl)){if(in_array(16,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="16">Current/Updated Address</option>
                                    <!--option <?php //if(!empty($col_xl)){if(in_array(17,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="17">Summon Send To</option-->
                                    <option <?php if(!empty($col_xl)){if(in_array(18,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="18">Region</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(19,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="19">Territory</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(20,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="20">District</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(21,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="21">Unit Office</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(22,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="22">More A/C No.</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(23,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="23">Remarks</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(24,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="24">Status</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(25,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="25">Initiate By</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(26,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="26">Initiate Date Time</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(27,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="27">STC By</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(28,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="28">STC Date Time</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(29,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="29">Recommended By</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(30,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="30">Recommend Date Time</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(31,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="31">Acknowledge By</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(32,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="32">Acknowledge Date Time</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(33,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="33">Send To HOLM By</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(34,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="34">Send To HOLM Date Time</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(35,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="35">Verify By</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(36,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="36">Verify Date Time</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(37,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="37">Card Issuing Date</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(38,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="38">Expire Date</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(39,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="39">Credit Limit</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(40,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="40">Outstanding Balance</option>

                                    <option <?php if(!empty($col_xl)){if(in_array(41,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="41">Chq Expiry Date</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(42,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="42">Last Payment Date</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(43,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="43">Last Payment Amount</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(44,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="44">Previous Auction Sts</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(45,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="45">Current Auction Sts</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(46,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="46">Current DPD</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(47,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="47">Legal Region</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(48,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="48">Loan Sanction Date</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(49,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="49">Auction Complete By</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(50,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="50">Auction Complete Date</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(51,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="51">Hold Reason</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(52,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="52">Previous Case Filling Date</option>


                                    <option <?php if(!empty($col_xl)){if(in_array(53,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="53">Guarantor</option>
                                    <option <?php if(!empty($col_xl)){if(in_array(54,$col_xl)){echo 'selected';}}else{echo 'selected';}?> value="54">Facility Details</option>
                                </select><script>jQuery('#col_xl').multipleSelect({ placeholder: "Select Column for Excel Export" });</script>
                            </div></td>
                            <td  style="text-align:right;width:5%"><input name="post_sts" id="post_sts" class="crmbutton small create"  value="Search Now" type="submit">
                            </td>
                            <td style="width:2%" valign="top">
                                <?php if (count($result) >0 && !empty($col_xl)) { ?>
                                    <button type="submit" formtarget="_blank" name="xlsts"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                                    <!--a id="inXLadfc" style="text-align:center;cursor:pointer;" target="_blank" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></a-->
                                <?php } ?>
                                
                            </td>
                            
                        </tr>
                    </table>
              </div>
              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>

            </form>
         </div>
    </div>
</div>
    
    <table align="center" border="0"  cellpadding="0" cellspacing="0" width="98%">
        <tbody><tr>
            <td width="100%" valign="top" <? if($post_sts == 1){?> style="border:#837E6F 2px inset" <? }?>>
                <? if($post_sts == 1){?>
                       <table style="font-size:10pt" width="100%" class="input_box" border="0" cellspacing="0" cellpadding="1" align="center">           
                        <tr style="text-align:left; font-weight:bold; background-color: #B8E4F3; border-color: #ccc">
                            <th align="center">Sl</th>
                            <th align="left">Req.Type</th>
                            <th align="left">Proposed Type</th>
                            <th align="left">Loan AC</th>
                            <th align="left">CIF</th>
                            <th align="left">AC Name</th>
                            <th align="left">Region</th>
                            <th align="left">Territory</th>
                            <th align="left">District</th>
                            <th align="left">Unit Office</th>
                            <th align="left">Status</th>
                        </tr>
                        <?php if (!empty($result)): ?>
                            <?php foreach ($result as $key): ?>
                                <tr>
                                    <td align="center"><?=$key->sl_no;?></td>
                                    <td align="left"><?=$key->req_type;?></td>
                                    <td align="left"><?=$key->proposed_type;?></td>
                                    <td align="left"><?=$key->loan_ac;?></td>
                                    <td align="left"><?=$key->cif;?></td>
                                    <td align="left"><?=$key->ac_name;?></td>
                                    <td align="left"><?=$key->region_name;?></td>
                                    <td align="left"><?=$key->territory_name;?></td>
                                    <td align="left"><?=$key->district_name;?></td>
                                    <td align="left"><?=$key->unit_office_name;?></td>
                                    <td align="left"><?=$key->cma_sts;?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                             <tr style="vertical-align:top;" ><td colspan="12" align="center" style="color: #AA0000">No result found !!</td></tr>
                        <?php endif ?>
                    </table><br /><br /><br />
                <? }?>
            </td>
        </tr>
        </tbody>
    </table>
         
<? } 

else { ?>

   <!--  <form action="<?=base_url()?>index.php/other_report/view<?=$menu_group?>/<?=$menu_cat?>" style="margin:auto; padding:0; clear:both" id="report_form_search" method="post">
        <table  style="background-color:#CCC" align="center" border="0" cellpadding="1" cellspacing="2" width="98%">
            <tbody>
            <tr>
                <td align="left" nowrap="nowrap" width="30%"><strong>Report Type:</strong>
                    <?=form_dropdown('report_list', $report_list, $report_select, " id=\"report_list\" style=\"width:70%\" ");?></td>
                <td width="70%">&nbsp;</td>
                
                
            </tr>
        </tbody>
        </table>
    </form><br/>
     -->
         
<? } ?>

