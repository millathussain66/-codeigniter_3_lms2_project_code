<?php
$CI =& get_instance();
$chk_menu = $CI->uri->segment('3');
$chk_sub_menu = $CI->uri->segment('4');
$_SESSION['LAST_ACTIVITY'] = time(); 

$sub_uri = config_item('sub_uri');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to LMS</title>
	<link rel="shortcut icon" href="<?=$sub_uri?>images/favicon.png" type="image/x-icon">
	<link rel="icon" href="<?=$sub_uri?>images/favicon.png" type="image/x-icon">
	<noscript> 	JavaScript should be enable in your browser !!</noscript>
	<style type="text/css">@import url("<?=$sub_uri?>css/style.css");</style>
	<style type="text/css">@import url("<?=$sub_uri?>css/form.css");</style>
	<style type="text/css">@import url("<?=$sub_uri?>css/simple-chart.css");</style>
	<link rel="stylesheet" href="<?=$sub_uri?>jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="<?=$sub_uri?>jqwidgets/styles/jqx.summer.css" type="text/css" />
	<script type="text/javascript" src="<?=$sub_uri?>js/moment.js"></script>
	<link rel="stylesheet" href="<?=$sub_uri?>jqwidgets/styles/jqx.fresh.css" type="text/css" />
	<link rel="stylesheet" href="<?=$sub_uri?>jqwidgets/styles/jqx.energyblue.css" type="text/css" />
	<link rel="stylesheet" href="<?=$sub_uri?>jqwidgets/styles/jqx.light.css" type="text/css" />
	<link rel="stylesheet" href="<?=$sub_uri?>jqwidgets/styles/jqx.ui-sunny.css" type="text/css" />
	<link rel="stylesheet" href="<?=$sub_uri?>jqwidgets/styles/jqx.energyblue.css" type="text/css" />
	<link rel="stylesheet" href="<?=$sub_uri?>jqwidgets/styles/jqx.darkblue.css" type="text/css" />
	<link rel="stylesheet" href="<?=$sub_uri?>css/multiple-select.css" type="text/css" />
	
	<script type="text/javascript" src="<?=$sub_uri?>scripts/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="<?=$sub_uri?>scripts/simple-chart.js"></script>
	<script type="text/javascript" src="<?=$sub_uri?>js/rpie.js"></script>
	<script type="text/javascript" src="<?=$sub_uri?>js/jquery.multiple.select.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxchart.js"></script>
	<script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxexpander.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxvalidator.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/globalization/globalize.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxmaskedinput.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxcombobox.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxswitchbutton.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxradiobutton.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxgrid.edit.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxdata.export.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxgrid.export.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>scripts/gettheme.js"></script>
	<script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxpanel.js"></script>
	<script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxtooltip.js"></script>
	<script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxtabs.js"></script>
    <!--
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?=$sub_uri?>jqwidgets/jqxtabs.js"></script>-->

	<script type="text/javascript">

	function get_browser(){
		var N=navigator.appName, ua=navigator.userAgent, tem;
		var M=ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
		if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
		M=M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];
		return M[0];
    }
	function get_browser_version(){
		var N=navigator.appName, ua=navigator.userAgent, tem;
		var M=ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
		if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
		M=M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];
		return M[1];
    }
	var browser=get_browser();
	var browser_version=get_browser_version();

	if(browser=='MSIE' && browser_version<=6)
	{
		alert("This site does not support Internet Explorer 6.0 or lower. Please upgrade to IE8 or upper/Firefox 24.x/Chrome");
		window.location="<?=base_url()?>browser.php";
	}
	if(browser=='Firefox' && browser_version<=23)
	{
		alert("This site does not support Firefox 23.x or lower version. Please upgrade to Firefox 24.x or higher ");
		window.location="<?=base_url()?>browser.php";
	}
	var baseurl = "<?=base_url()?>";
	jQuery.noConflict();
	var j = jQuery.noConflict();

	function deleteItem(msg)
	{
		if (confirm(msg))
			return true;
		else
			return false;
	}
	function validate_date(inputText)
	{
		var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
		if(inputText.match(dateformat))
		{
			return true;
			}else {
			 return false;
			}
	}
	</script>
	<script src="<?=$sub_uri?>js/custom.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?=$sub_uri?>msg_popup_hsn/common.css" type="text/css">
    <script language="JavaScript" type="text/javascript" src="<?=$sub_uri?>msg_popup_hsn/Util-jar.js"></script>

	<!-- below two link for calender -->
    <link type="text/css" href="<?=$sub_uri?>css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=$sub_uri?>js/jquery-ui.min.js"></script>
	<style type="text/css">
		table.input_box{ border-collapse:collapse; font-size:8pt}
		table.input_box tr.menuon { background-color: #b8e4f3; line-height:16px}
		table.input_box tr.menuoffC { background-color: #f1fdff; line-height:16px}
		table.input_box tr.menuoffC2 { background-color: #f9ffff; line-height:16px}
		table.input_box td {border: #999999 solid 1px; vertical-align:top}
		input.text{font-size:8pt}
		table#preview_table td {
			border: 1px solid #c7c7c7;
			word-wrap:break-word
		}
		#pagination a, #pagination strong {
		 background:  #e3e3e3;
		 padding: 4px 7px;
		 text-decoration: none;
		border: 1px solid #666666;
		color: #292929;
		font-size: 13px;
		}
		#gurantor_table {
        border-collapse: collapse;
        word-wrap:break-word;
	    }
	    #gurantor_table td {
	        border: 1px solid rgba(0,0,0,.20); 
	        word-wrap:break-word;
	    }
	    #facility_table {
        border-collapse: collapse;
        word-wrap:break-word;
	    }
	    #facility_table td {
	        border: 1px solid rgba(0,0,0,.20); 
	        word-wrap:break-word;
	    }
		#pagination strong, #pagination a:hover {
		 font-weight: normal;
		 background:  #666666;
		 color:#FFFFFF;

		}
		.button1 {
	      background-color: #555555; /* Green */
	      border: none;
	      color: white;
	      padding: 10px 20px;
	      text-align: center;
	      text-decoration: none;
	      display: inline-block;
	      font-size: 16px;;
	      border-radius: 12px;
	    }
		.ui-datepicker { z-index: 999999 !important; }
		.usermenuinfo td
		{
			padding: 0px 10px;
			font-size: 13px;
			text-align: left;
		}
		#header
		{
			border-bottom: none !important;
		}
		#jqxMenu .jqx-menu-item-top
		{
			/*background-color: #ffe672 !important;*//*background-color: #94a1ac !important;*/
			margin: 1px 3px 0px 1px !important;
			padding: 3px 20px !important;
			border:solid 1px transparent;
			border:solid 1px #ffffff;
			border-radius: 15px !important;
			color: #ffffff !important;
		}
		#jqxMenu .jqx-menu-item-top:hover
		{
			background-color: #ffffff !important;
			border:solid 1px #ffffff !important;
			color: #000000 !important;
		}
		#jqxMenu
		{
			height: 36px !important;
			background: none !important;
			border: none !important;
		}
		#jqxMenuUl .jqx-menu li, #jqxMenuUl .jqx-menu-dropdown li
		{
			color: #fff !important;
			font-weight: normal !important;
		}
		#jqxMenu .jqx-menu-dropdown
		{
			background-color: #008F40 !important;
		}
		#jqxMenu .jqx-menu-item:hover
		{
			background-color: #3fe811 !important;
		}
		#jqxMenu .jqx-menu-item
		{
			padding: 5px 10px !important;
			font-weight: normal !important;
			border-radius: 0px !important;
		}
		#jqxMenu .mgrpSelected
		{
			background-color: #fff !important;
			color:#000000!important;
		}
		#jqxMenu .mcatSelected
		{
			background: #4ED2A1 !important;
		}
		#jqxMenu .jqx-widget-header-energyblue
		{
			background-color: none !important;
		}
		#examplePath
		{
			margin-bottom: 5px !important;
		}
		.jqx-menu-item-top .jqx-icon-arrow-down, .jqx-menu-item-top .jqx-icon-arrow-down-hover, .jqx-menu-item-top .jqx-icon-arrow-down-selected
		{
			background-image: url('<?=base_url()?>images/icon-select.png');/*background-image: url('<?=base_url()?>images/icon-down_menu.png');*/
		}
		fieldset, legend{
			border-radius: 0px !important;
		}
		#jqxgrid
		{
			border-radius: 0px !important;
		}
		.buttonStyle
		{
			border-radius: 0px !important;
		}
		/* input
		{
			border-radius: 0px !important;
		}
		textarea
		{
			border-radius: 0px !important;
		} */
		.jqx-input-label
		{
			visibility: hidden !important;
		}
		/* Preloader Css */
		#footer_loader_body{
		  display: none;
		}

		#preloader {
		  position: fixed;
		  width: 100%;
		  height: 100%;
		  background: #fff;
		  z-index: 999; /* makes sure it stays on top */
		}
		#demos #loding {
		  width: 300px;
		  height: 300px;
		  position: absolute;
		  left: 25%; /* centers the loading animation horizontally one the screen */
		  _top: 50%; /* centers the loading animation vertically one the screen */
		  background-image: url('<?php echo base_url('images/ajax-loader.gif'); ?>'); /* path to your loading animation */
		  background-repeat: no-repeat;
		  background-position: center;
		  _margin: -150px 0 0 -150px /* is width and height divided by two */
		  z-index: 999;
		}
	</style>

<style>
.result_table table{
	   color: #333;
	   font-family: Helvetica, Arial, sans-serif;
	   width: 640px;
	   border-collapse: collapse;
	   collapse; border-spacing: 0;
	   margin-top:15px;
	}

   .result_table td, .result_table th {
	   border: 1px solid #ccc;
	   height: 25px;
	   transition: all 0.3s;
	}

   .result_table th {
	   background: #FAFAFA;
	   font-weight: bold;
	   padding-left:5px;
	   padding-right:5px;
	   text-align: left;
	   white-space:nowrap;
   }
	.custtable table{
	   color: #333;
	   font-family: Helvetica, Arial, sans-serif;
	   width: 640px;
	   border-collapse: collapse;
	   collapse; border-spacing: 0;
	   margin-top:15px;
	}

   .custtable td, .custtable th {
	   border: 1px solid #ccc;
	   height: 25px;
	   transition: all 0.3s;
	}

   .custtable th {
	   background: #DFDFDF;
	   font-weight: bold;
	   padding-left:5px;
	   padding-right:5px;
	   text-align: left;
	   white-space:nowrap;
   }

   .custtable td {
	   background: #FAFAFA;
	   padding-left:5px;
	   padding-right:5px;
	   text-align: left;
   }
   .custtable tr:nth-child(even) td { background: #F1F1F1; }
   .custtable tr:nth-child(odd) td { background: #FEFEFE; }
   .custtable tr:hover{ background: #666; color: #000; }
   #sendButton, .buttonStyle
   {
	 cursor:pointer !important;
   }
   #footer
   {
	 position: fixed !important;
   }
   .ui-datepicker-close{
   	display: none;
   }
   .ui-datepicker-current{
   	background: #185891!important;
   	color: #fff!important;
   }
   .ui-datepicker-current:hover{
   	border-color: #185891!important;
   }
   #loading-overlay {
        position: absolute;
        width: 100%;
        height:100%;
        left: 0;
        top: 0;
        display: none;
        align-items: center;
        background-color: #000;
        z-index: 999;
        opacity: 0.5;
    }
    .loading-icon{ position:absolute;border-top:2px solid #fff;border-right:2px solid #fff;border-bottom:2px solid #fff;border-left:2px solid #767676;border-radius:25px;width:25px;height:25px;margin:0 auto;position:absolute;left:50%;margin-left:-20px;top:50%;margin-top:-20px;z-index:4;-webkit-animation:spin 1s linear infinite;-moz-animation:spin 1s linear infinite;animation:spin 1s linear infinite;}
    @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
    @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
    @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
</style>
<script>
//override the existing _goToToday functionality
jQuery.datepicker._gotoTodayOriginal = jQuery.datepicker._gotoToday;
jQuery.datepicker._gotoToday = function(id) {
    // now, optionally, call the original handler, making sure
    //  you use .apply() so the context reference will be correct
    jQuery.datepicker._gotoTodayOriginal.apply(this, [id]);
    jQuery.datepicker._selectDate.apply(this, [id]);
    
    
};
</script>
<script type="text/javascript" charset="utf-8" language = "Javascript">
	// javascript functions by khaleed star
	jQuery(document).ready(function() {
		jQuery(".numbersonly").on("keypress keyup blur",function (event) {
			jQuery(this).val(jQuery(this).val().replace(/[^\d].+/, ""));
			if ((event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		});

		jQuery(".only_account_or_card_no").on("blur",function (event) {
			jQuery(this).val(jQuery(this).val().replace(/[^\d].+/, ""));
			validateAccountOrCardNumber(jQuery(this).val());
		});
	});


	// javascript functions by khaleed end
	// function popup(url) {
	// 	alert(url)
	// 	var winl = (screen.width - 900) / 2;
	// 	var wint = 40;
	// 	newwindow=window.open(url,'name','height=600, width=900,top='+wint+', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left='+winl);
	// 	if (window.focus) {newwindow.focus()}
	// 	return false;
	// }
	function popup(url) {
		window.open(url, "_blank")
		//window.location = url; // redirect
        return false;
        if(url.endsWith(".msg"))
        {
            window.location = url; // redirect
            return false;
        }
        var winl = (screen.width - 900) / 2;
        var wint = 40;
        newwindow=window.open(url,'name','height=600, width=900,top='+wint+', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left='+winl);
        if (window.focus) {newwindow.focus()}
        return false;
    }
	function FormatCCYAmount(ID)
	{
		//Rate calculations in lost fouc event
		var amount=jQuery("#"+ID).val();
		if (amount.length > 0) {

			amount = amount.replace(/[^0-9.]/g, "");

			if(amount==''){
				jQuery("#"+ID).val('');
			}else if(isNaN(amount)){

				jQuery("#"+ID).val(amount);
			}else{

					jQuery("#"+ID).val(parseFloat(amount).toFixed(2));
			}

		}
	}
	function numberWithCommas(x) {
		    var parts = x.toString().split(".");
		    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		    return parts.join(".");
		}
	function replace_string(ID) {
                    //Rate calculations in lost fouc event
                    var str_val=jQuery("#"+ID).val();
                    if (str_val.length > 0) {
						//var a=array('!','@','#','$','%','^','&','*','[',']','{','}',':','“','‘',';','|','<','>','?','and','=');
//var b=array(' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','','');
				//alert(str.replace(a, b, str));
                        str_val = str_val.replace(/[^0-9.a-zA-Z]/g, "");;
                        //alert(lc_amount);
                       // lc_amount = formatNumber(lc_amount);
                        if(str_val==''){
                        	jQuery("#"+ID).val('');
                        }else if(isNaN(str_val)){
                        	jQuery("#"+ID).val(str_val);
                        }else{

                        	  jQuery("#"+ID).val(str_val);
                        }

                    }
				}

	function emptyCheckCombo(field){
		if(jQuery("#"+field).val()==''){ return false; }
		var item = jQuery("#"+field).jqxComboBox('getSelectedItem');
		if(!item){return false;} else {return true};
	}

	function validEmailCheck(val)
	{
		var arr_emails = val.split(',');
		var flag = 0;
		for(var i=0;i < parseInt(arr_emails.length); i++)
		{
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    	if(re.test(arr_emails[i]) == false)
	    	{
	    		flag = 1;
	    		break;
	    	}
		}
		if(flag==1){ return false; }
		else{ return true; }
	}
	function set_final_remarks(status_id,req_type)
    {
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?php echo base_url(); ?>index.php/user_info/check_status_closing',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,id : status_id,req_type:req_type},
        datatype: "json",
        success: function(response){
            var json = jQuery.parseJSON(response);
                    var  csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.status=='success')
                    {
                        if(json.row_info==1)
                        {
                            jQuery("#final_remarks").jqxComboBox('val',2);
                        }
                        else
                        {
                            jQuery("#final_remarks").jqxComboBox('val',1);
                        }
                    }
                    else
                    {
                        jQuery("#final_remarks").jqxComboBox('val',1);
                    }
            },
            error:   function(model, xhr, options){
                alert('failed');
                jQuery("#final_remarks").jqxComboBox('val',1);
            },
        });
        
    }
	function datePicker (id){
		jQuery(document).ready(function() {
			jQuery("*").dblclick(function(e){
				e.preventDefault();

			  });
			

			jQuery('#'+id).datepicker({
					beforeShow: function(i) { 
                      if (jQuery(i).attr('readonly')) { return false; } 
                   	},
					inline: true,
					changeMonth: true,
					changeYear: true,
					dateFormat: 'dd/mm/yy',
					//showOn: "button",
					//buttonImage: "<?=base_url()?>old_assets/images/calendar.gif",
					//buttonImageOnly: true,
					showButtonPanel: true	
			});
		});

	}
	function datePicker_without_advance (id){
		jQuery(document).ready(function() {
			jQuery("*").dblclick(function(e){
				e.preventDefault();

			  });
			

			jQuery('#'+id).datepicker({
					inline: true,
					changeMonth: true,
					changeYear: true,
					dateFormat: 'dd/mm/yy',
					//showOn: "button",
					//buttonImage: "<?=base_url()?>old_assets/images/calendar.gif",
					//buttonImageOnly: true,
					showButtonPanel: true,
					maxDate:0	
			});
		});

	}
	

	function set_expense_lawyer(lawyer_id,counter)
    {
        jQuery("#vendor_id_"+counter).jqxComboBox('val', lawyer_id);
    }

	function calcJulian(isDate){
		gregDate = new Date(isDate);
		year = gregDate.getFullYear();
		month = gregDate.getMonth()+1;
		day = gregDate.getDate();
		A = Math.floor((7*(year+Math.floor((month+9)/12)))/4);
		B = day+Math.floor((275*month)/9)
		isJulian = (367*year)-A+B+1721014;
		return isJulian;
	}
	function validate(date1, date2){
		tmp = date1.split("/")
		xDate = tmp[1]+"/"+tmp[0]+"/"+tmp[2];
		refDate = calcJulian(xDate);
		tmp = date2.split("/")
		xDate = tmp[1]+"/"+tmp[0]+"/"+tmp[2];
		fwdDate = calcJulian(xDate);
		if (fwdDate < refDate)
		{
			return false;
		}
		return true;
	}

	function validateDate(date1,type)
	{
		var now = new Date();
		now.setHours(0, 0, 0, 0);
		var today = now.valueOf()  ;

		tmp = date1.split("/")
		xDate = tmp[1]+"/"+tmp[0]+"/"+tmp[2];
		var curent = new Date(xDate);
		refDate = curent.valueOf();

		if(type == 'advance')
		{
			if (today < refDate)
			{
				return false;
			}
			return true;
		}
		if(type == 'back_equal')
		{
			if (today >= refDate)
			{
				return false;
			}
			return true;
		}
		else
		{
			if (today > refDate)
			{
				return false;
			}
			return true;
		}
	}
	function name_filter(str)
	{
		if (str=='' || str==undefined) 
		{
			return '';
		}
		else
		{
			first = str.charAt(0)
			while(!first.match(/[a-z]/i))
			{
				str = str.substring(1);
				first = str.charAt(0)
			}
			str = str.charAt(0).toUpperCase() + str.slice(1);
			return str;
		}
	}
	function address_filter(str)
	{
		if (str=='' || str==undefined) 
		{
			return '';
		}
		else
		{
			str = str.replace(/  +/g, ' ');
			str = str.charAt(0).toUpperCase() + str.slice(1);
			myArray = str.split(",");
			length = myArray.length;
			var final_str='';
			for (var i = 0; i < length; i++) 
			{
				if(i==(length-1) || myArray[i+1]=='')
				{
					final_str+=myArray[i].charAt(0).toUpperCase() + myArray[i].slice(1);
				}
				else
				{
					final_str+=myArray[i].charAt(0).toUpperCase() + myArray[i].slice(1)+', ';
				}
			}
			str = final_str;
			return str;
		}
	}
	function address_trim_end(str)
	{
		if (str=='' || str==undefined) 
		{
			return '';
		}
		else
		{
			return str.trimEnd();
		}
	}
	function obj_cleaner_for_api_data(str)
	{
		if (typeof str==='object')
		{
			if (str[0]!=undefined)
			{
				return str[0];
			}
			else{return '';}
		}
		else
		{
			return str;
		}
	}
	function bigger_date_valid(svalue1,bvalue2)
	{
		var arrDate1 = svalue1.split("/");
		Date1 = new Date(arrDate1[2], arrDate1[1] - 1, arrDate1[0]);
		var arrDate2 = bvalue2.split("/");
		Date2 = new Date(arrDate2[2], arrDate2[1] - 1, arrDate2[0]);
		//alert('op'+Date2+'exp'+Date1);
		if(Date1 < Date2)
		{
			//alert('f');
			return false;
		}
		else
		{
			//alert('t');
			return true;
		}
	}
/**
 * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */
// Declaring valid date character, minimum year and maximum year
var dtCh= "/";
//var minYear=1900;
//var maxYear=2100;
var minYear=1900;
var maxYear=2025;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   }
   return this
}
function check_group_javascript(group_id)
{
	if(group_id=='' || group_id==null)
	{
		return false;
	}
	var groups='<?=$this->session->userdata['ast_user']['user_work_group_id']?>'.split(',');
	for (var i = 0; i < groups.length; i++)
	{
		if(group_id==groups[i])
		{
			return true;
		}
	}
	return false;

}
function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	var strm='1';
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		strm="The date format should be : dd/mm/yyyy";
		return strm;
	}
	if (strMonth.length<1 || month<1 || month>12){
		strm="Please enter a valid month";
		return strm;
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		strm="Please enter a valid day";
		return strm;
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		strm="Please enter a valid 4 digit year between "+minYear+" and "+maxYear;
		return strm;
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		strm="Please enter a valid date";
		return strm;
	}
return strm;
}

function isDate22(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strDay=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format should be : dd/mm/yyyy")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date")
		return false
	}
return true
}

function numbersonly(myfield, e, dec) {
     var key;
     var keychar;

     if (window.event)
        key = window.event.keyCode;
     else if (e)
        key = e.which;
     else
        return true;
     keychar = String.fromCharCode(key);
 // control keys
     if ((key==null) || (key==0) || (key==8) ||
         (key==9) || (key==13) || (key==27) )
        return true;

     // numbers
     else if ((("0123456789.").indexOf(keychar) > -1))
     //else if ((("0123456789")))
        return true;
 // decimal point jump
     else if (dec && (keychar == "."))
        {
        myfield.form.elements[dec].focus();
        return false;
        }
     else
        return false;
}

function numbersonly44(myfield, e, dec) {
     var key;
     var keychar;

     if (window.event)
        key = window.event.keyCode;
     else if (e)
        key = e.which;
     else
        return true;
     keychar = String.fromCharCode(key);
 // control keys
     if ((key==null) || (key==0) || (key==8) ||
         (key==9) || (key==13) || (key==27) )
        return true;

     // numbers
     else if ((("0123456789").indexOf(keychar) > -1))
     //else if ((("0123456789")))
        return true;
 // decimal point jump
     /*else if (dec && (keychar == "."))
        {
        myfield.form.elements[dec].focus();
        return false;
        }*/
     else
        return false;
}
function set_expense_date(fieldname,counter=null,check_session=null)
{
	var session_case_checked = 0;
	if(check_session==1)//checking session case or not
	{
		var item = jQuery("#case_name").jqxComboBox('getSelectedItem');
		if(item!=null && item.value==15)//when session case
		{
			session_case_checked = 1;
		}
		else
		{
			session_case_checked = 0;
		}
	}
	else
	{
		session_case_checked = 0;
	}
    if(jQuery('#add_edit').val()=='add' && (counter==null || counter=='') && session_case_checked==0)//for set all expens date
    {
        var date = jQuery('#'+fieldname).val();
        var counter = jQuery('#expense_counter').val();
        for (i=1;i<=counter;i++) 
        {
            if(jQuery('#expense_delete_'+i).val()==0) 
            {
                if(date!='' && validate_date(date)==true)
                {
                 jQuery('#activities_date_'+i).val(date);
                }
            }
        }
    }
    else if(jQuery('#add_edit').val()=='add' && counter!=null && session_case_checked==0) //for set new added expense date
    {
        var date = jQuery('#'+fieldname).val();
        if(date!='' && validate_date(date)==true)
        {
            jQuery('#activities_date_'+counter).val(date);
        }
    }
}
function make_expense_amount_editable(counter_field,loan_segment)
{
	var counter = jQuery('#'+counter_field).val();
        for (i=1;i<=counter;i++) 
        {
            if(jQuery('#expense_delete_'+i).val()==0) 
            {
            	if(loan_segment=='C')
            	{
            		jQuery('#amount_'+i).attr('readonly', false);
            	}
            	else
            	{
            		jQuery('#amount_'+i).attr('readonly', true);
            	}
            }
        }
}
function block_fields_for_any_time_edit(field_list)
{
	if (field_list.length === 0)//check empty array
	{
		return false;
	}
	for (var i = 0; i < field_list.length; i++) {
		var str = field_list[i];
		let position = str.search("####");
		if(position>0)//checking the concat tag exist or not
		{
			const myArray = str.split("####");//split the field name with field type
			if(myArray[1]=='combo') //for combobox disable
			{
				jQuery('#'+myArray[0]).jqxComboBox({ disabled: true });
			}
			if(myArray[1]=='input') //for input field readonly
			{
				document.getElementById(myArray[0]).readOnly = true;
			}
			if(myArray[1]=='checkbox') //for checkbox readonly
			{
				jQuery('#'+myArray[0]).jqxCheckBox({ disabled: true });
			}
		}
		
	}
}
function unblock_fields_for_any_time_edit(field_list)
{
	if (field_list.length === 0)//check empty array
	{
		return false;
	}
	for (var i = 0; i < field_list.length; i++) {
		var str = field_list[i];
		let position = str.search("####");
		if(position>0)//checking the concat tag exist or not
		{
			const myArray = str.split("####");//split the field name with field type
			if(myArray[1]=='combo') //for combobox disable
			{
				jQuery('#'+myArray[0]).jqxComboBox({ disabled: false });
			}
			if(myArray[1]=='input') //for input field readonly
			{
				document.getElementById(myArray[0]).readOnly = false;
			}
			if(myArray[1]=='checkbox') //for checkbox readonly
			{
				jQuery('#'+myArray[0]).jqxCheckBox({ disabled: false });
			}
		}
		
	}
}
function number_alphabatic(myfield, e, dec) {
     var key;
     var keychar;

     if (window.event)
        key = window.event.keyCode;
     else if (e)
        key = e.which;
     else
        return true;
     keychar = String.fromCharCode(key);
 // control keys
     if ((key==null) || (key==0) || (key==8) ||
         (key==9) || (key==13) || (key==27) )
        return true;

     // numbers
     else if ((("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz_").indexOf(keychar) > -1))
     //else if ((("0123456789")))
        return true;
 // decimal point jump
     /*else if (dec && (keychar == "."))
        {
        myfield.form.elements[dec].focus();
        return false;
        }*/
     else
        return false;
}

function checkNAN(element_id){

	var field = document.getElementById(element_id);//alert(field.value);
	var alphaExp = /^[0-9a-zA-Z-]+$/;
	if(field.value.match(alphaExp)){
		return true;
	}
	else{
		field.value="";
		field.focus();
		return false;
	}

}
function allLetter(element_id){
  	var field = document.getElementById(element_id);//alert(field.value);
  	var letters = /^[a-zA-Z.\s-, ]+$/;
  	if(field.value.match(letters))
	 {
	  return true;
	 }
   	else
     {
     return false;
     }
}
function checknumber_alphabatic(element_id){

		var field = document.getElementById(element_id);//alert(field.value);
		//var alphaExp = /^[0-9a-zA-Z-]+$/;
		var alphaExp = /^[0-9.]+$/;
		if(field.value.match(alphaExp)){
			return true;
		}
		else{
			//field.value="";
			field.focus();
			return false;
		}

}
function checknumber_only(element_id){

		var field = document.getElementById(element_id);//alert(field.value);
		//var alphaExp = /^[0-9a-zA-Z-]+$/;
		var alphaExp = /^[0-9]+$/;
		if(field.value.match(alphaExp)){
			return true;
		}
		else{
			//field.value="";
			field.focus();
			return false;
		}

}
function checknumber_alphabaticwithstar(element_id){

		var field = document.getElementById(element_id);//alert(field.value);
		//var alphaExp = /^[0-9a-zA-Z-]+$/;
		var alphaExp = /^[0-9*]+$/;
		if(field.value.match(alphaExp)){
			return true;
		}
		else{
			//field.value="";
			field.focus();
			return false;
		}

}
function checknumber_alphabaticDot(element_id){

		var field = document.getElementById(element_id);//alert(field.value);
		//var alphaExp = /^[0-9a-zA-Z-]+$/;
		var alphaExp = /^[0-9.]+$/;
		if(field.value.match(alphaExp)){
			return true;
		}
		else{
			//field.value="";
			field.focus();
			return false;
		}

}
function checkNANNotDOT(element_id){

		var field = document.getElementById(element_id);//alert(field.value);
		//var alphaExp = /^[0-9a-zA-Z-]+$/;
		var alphaExp = /^[0-9]+$/;
		if(field.value.match(alphaExp)){
			return true;
		}
		else{
			field.value="";
			//field.focus();
			return false;
		}

	}
function checkNANwDOT(element_id){

		var field = document.getElementById(element_id);//alert(field.value);
		//var alphaExp = /^[0-9a-zA-Z-]+$/;
		var alphaExp = /^[0-9.]+$/;
		if(field.value.match(alphaExp)){
			return true;
		}
		else{
			field.value="";
			//field.focus();
			return false;
		}

	}

	// function commbobox_check(id) // for set combox value && clean if typed wrong
	// {
	// 	var item = jQuery('#'+id).jqxComboBox('getSelectedItem');
	// 	if(item != null && jQuery('#'+id).val() != '')
	// 	{
	// 		jQuery("input[name='"+id+"']").val(item.value);
	// 		if(item.label!=jQuery('#'+id).val())
	// 		{
	// 			jQuery('#'+id).val('');
	// 			jQuery("input[name='"+id+"']").val('');
	// 			jQuery('#'+id).jqxComboBox('clearSelection');
	// 		}
	// 	}else{
	// 		jQuery('#'+id).val('');
	// 		jQuery("input[name='"+id+"']").val('');
	// 		jQuery('#'+id).jqxComboBox('clearSelection');
	// 	}
	// }

	function commbobox_check(id) // for set combox value && clean if typed wrong
	{
		var item = jQuery('#'+id).jqxComboBox('getSelectedItem');
		//console.log(item);
		if(item != null && jQuery('#'+id).val() != '')
		{
			jQuery("input[name='"+id+"']").val(item.value);
			if(item.value!=jQuery('#'+id).val())
			{
				jQuery('#'+id).val('');
				jQuery("input[name='"+id+"']").val('');
				jQuery('#'+id).jqxComboBox('clearSelection');
			}
		}else{
			jQuery('#'+id).val('');
			jQuery("input[name='"+id+"']").val('');
			jQuery('#'+id).jqxComboBox('clearSelection');
		}
	}
	function advancedateCheck(id) {
        	date1=jQuery("#"+id).val();
		   
		    var str_subsdt = date1.split("/")
			var subsdt = str_subsdt[1]+"/"+str_subsdt[0]+"/"+str_subsdt[2];
			var subdt = new Date(subsdt);

			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();

			today = mm + '/' + dd + '/' + yyyy;

			var cur_date = new Date(today);

			var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
			if(Date.parse(subdt) > Date.parse(cur_date)){
            return false;
	        }

	        return true;
    }


</script>
<script>
    function updateConnectionStatus() {  
        var status = document.getElementById("connection");
        if(navigator.onLine) {
            jQuery(".warning").css("display", "none");
            status.innerHTML = "Online";
            status.classList.add("online");
            status.classList.remove("offline");                        
        } else {
        	jQuery(".warning").css("display", "block");
            status.innerHTML = "Offline";
            status.classList.add("offline");
            status.classList.remove("online");            
        }
    }

    // Attaching event handler for the load event
    window.addEventListener("load", updateConnectionStatus);
    // Attaching event handler for the online event
    window.addEventListener("online", function(e) {
        updateConnectionStatus();
    });
    
    // Attaching event handler for the offline event
    window.addEventListener("offline", function(e) {        
        updateConnectionStatus();
    });
    function check_hiliday(id)
    {
    	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var date  = jQuery('#'+id).val();
		if(date!='' && validate_date(date)==true)
		{
			jQuery.ajax({
	        url: '<?=base_url()?>index.php/Home/check_hiliday',
	        async:false,
	        type: "post",
	       	data: { [csrfName]: csrfHash,date : date},
	        datatype: "json",
	        success: function(response){
	        	var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				var str='';
				if(json.row_info==0){
					alert('Sorry selected date are in holiday');
	                jQuery('#'+id).val('');
	            }else if(json.row_info==2){
	                alert('Sorry There is no holiday setup for this Year');
	                jQuery('#'+id).val('');
	            }
	            else
	            {
	            	return true;
	            }
	            },
	            error:   function(model, xhr, options){
	                alert('failed');
	            },
	        });
		}
		
    }
</script>
<style type="text/css">
		#connection {
            border: 2px solid;
            padding: 5px 0px 5px 50px;
            width: 140px;
            margin: 0 auto;
            border-radius: 20px;
            font-size: 30px;
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            z-index: 999;
            left: 45%;
            top: 35%;

        }
        .warning {
        height: 100vh;
        background: rgba(255, 255, 255, 0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        position: fixed;
        z-index: 99999;
        top: 0;
        left: 0;
        user-select: none;
        color: red;
        font-family: serif;
        display: none;
    }
        #connection.online {
            color: green;
        }        
        #connection.offline {
            color: red;
        }
        #connection.online::before, #connection.offline::before {
            width: 25px;
            height: 25px;
            content: "";
            border-radius: 15px;
            box-shadow: 0 0 8px;
            position: absolute;
            left: 13px;
            top:11px;
        }
        #connection.online::before {
            background: green;
        }
        #connection.offline::before {
            background: red;
        }
	</style>
</head>
<body>
<div class="warning">
<div id="connection"></div>
</div>