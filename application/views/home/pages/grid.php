<style>
    .dashBoardTable{
        font-family: Calibri;
    }
    .headerrow td{
        background-color:#CCCCCC;
        border:1px solid #333333;
    }
    .headerrow td{
        text-align:center;
        font-size:14px;
        padding:1px 0;
    }
    .tabHead{
        background-color:#E8E8E8;
        font-size:14px;
        color:#000000;
        padding:1px 0;
        border:1px solid #C7C7C7;
         border-top-left-radius: 6px;
      -moz-border-top-left-radius: 6px;
      -webkit-border-top-left-radius: 6px;
      border-top-right-radius: 6px;
      -moz-border-top-right-radius: 6px;
      -webkit-border-top-right-radius: 6px;
    }
    .MatrixLayer{
        float: left;
        overflow-x: hidden;
        overflow-y: auto;
        width: auto;
        margin:0;
        padding:0;
        position: relative;
        height:150px;
        border:1px inset #C7C7C7;
        font-family: Calibri;
        font-size:13px;
        float:left;
        border-bottom-left-radius: 6px;
      -moz-border-bottom-left-radius: 6px;
      -webkit-border-bottom-left-radius: 6px;
      border-bottom-right-radius: 6px;
      -moz-border-bottom-right-radius: 6px;
      -webkit-border-bottom-right-radius: 6px;
    }
    .innerRow:hover{
        background-color:#C9FFE5;
    }
    .innerRow2:hover{
        background-color:#66CC99;
    }
    .innerRow3:hover{
        background-color:#FF9966;
    }
    .showPanelBg
    {
        width:; float:left; padding: 7px 13px;
        overflow: none;
    }

</style>

<?php
    $CI =& get_instance();
    $deptId = $CI->session->userdata['ast_user']['user_department_id'];
    $workId = $CI->session->userdata['ast_user']['user_work_group_id'];
?>
<style type="text/css">
.main {
  background-color:#f7f7f7;
  overflow-y: auto;
}

.sidenav a {
  padding: 6px 8px;
  text-decoration: none;
  font-size: 15px;
  font-weight: normal;
  color: #fff;
  background-color: #1aa3aa;
  margin: 5px;
  border-radius: 4px;
  text-align: center;
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
table.preview_table2 td, table.preview_table2 th{
	border: 1px solid #c7c7c7;
	word-wrap:break-word;
	padding:5px;
}
#custsearchForm input {
    margin-top: 5px;
    margin-bottom: 10px;
    border-radius: 20px !important;
    border: 1px solid #ccc;
    padding: 20px 20px;
    width: 300px;
    height: 0px;
    font-size: 15px;
}
#custsearchForm button{
    background-color: #1CAD4A;
    border-radius: 25px;
    border: 1px solid #1CAD4A;
    padding: 5px 25px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}
.error{
    color: red;
    font-size: 20px;
    font-weight: bold;
    display:;
}
.vh {min-height: calc(100vh - 158px)!important;}
.column {
	width: 31%;
	margin: 1% auto;
	border: solid 2px #05286e;
	border-radius:3px;
	min-height: 300px;
}
.column2 {
	width: 99%;
	margin: 1% auto;
	border: solid 2px #05286e;
	border-radius:3px;
	min-height: 300px;
	float: left;
	margin-left: 2px;
}
.row {margin:5px!important;padding: 0;}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.head {
	height: 20px;
	padding: 3px 10px;
	/*background-color: #eaacae;*/
	background-color: #05286e;
	background-image: linear-gradient(#05286e, #006cbd);
	border-top-left-radius: 2px;
	border-top-right-radius: 2px;
	margin: 0;
	text-align: center;
	font-size: 16px;
	font-weight: bold;
	color:black;
}
.head_icon{
	height: 20px;
	padding: 10px;
	/*background-color: #eaacae;*/
	background-color:white;
	border-top-left-radius: 2px;
	border-top-right-radius: 2px;
	margin: 0;
	text-align: center;
	font-size: 20px;
	font-weight: bold;
	color:black;
	float: right;
	display: inline-block;
}
.head_icon2{
	height: 20px;
	padding: 0px;
	/*background-color: #eaacae;*/
	background-color:white;
	border-top-left-radius: 2px;
	border-top-right-radius: 2px;
	margin: 0;
	text-align: center;
	font-size: 20px;
	font-weight: bold;
	color:black;
	float: right;
	display: inline-block;
}

.content{
	padding: 10px 15px;
}
	
.sc-column .sc-canvas {float: none;}
	
body {  background-color:#d9d9d9 }
.sc-chart {height: 234px!important;}
.ln-chart { float:left; width:100%;height: 180px; padding:0px; margin:0px 0px;  background-color:#fff; /*box-shadow:0 15px 40px rgba(0,0,0,.1)*/ }
.cma-chart { float:left; width:100%;height: 180px; padding:0px; margin:0px 0px;  background-color:#fff; /*box-shadow:0 15px 40px rgba(0,0,0,.1)*/ }
.cma-chart-hidden { float:left; width:100%;height: 180px; padding:0px; margin:0px 0px;  background-color:#fff; /*box-shadow:0 15px 40px rgba(0,0,0,.1)*/ }
.auction-chart { float:left; width:100%;height: 180px; padding:0px; margin:0px 0px;  background-color:#fff; /*box-shadow:0 15px 40px rgba(0,0,0,.1)*/ }
h1 { margin-top:150px; text-align:center;}
	
#data_table {
	border-collapse: collapse;
}
#data_table th {
	word-wrap:break-word;
	border: 1px solid rgba(0,0,0,.20); 
}
#data_table td {
	word-wrap:break-word;
	border: 1px solid rgba(0,0,0,.20); 
}
.jqx-chart-legend-text{
	display: none;
}
.ui-datepicker-calendar {
	display: none;
}

/*Mamun Starts (June 02, 2022)*/
	
.ptbl {width: 98%;margin: 5px 1%;font-size: 13px;}
.ptbl td {padding: 2px 5px;}
	
.item1 { grid-area: year; height:20px;width:auto;}
.item2 { grid-area: month; height:20px;width:auto;}
.item3 { grid-area: district; height:20px;width:auto;}
.item4 { grid-area: regions; height:20px;width:auto;}
.item5 { grid-area: portfolio; height:20px;width:auto;}
.item6 { grid-area: legnotice; }	
.item7 { grid-area: delivery; }
.item8 { grid-area: livecase; }
.item9 { grid-area: cma; }
.item10 { grid-area: auction; }
.item11 { grid-area: moneyrecovery; }
.item12 { grid-area: wrarrest; }
.item13 { grid-area: caseupdate; }
.item80 { grid-area: highcourt; }
.item14 { grid-area: caseagainstbank; }
.item15 { grid-area: legcost;}
.item16 { grid-area: profbill; }
.item17 { grid-area: schedule; }
.item18 { grid-area: legvet; }
.height1 {height:50px;}
.height2 {height:48px;}
.width25 {width:25%;}
.width50 {width:50%;}
.width75 {width:75%;}
.width100 {width:100%;}

.grid-container {
	display: grid;
	grid-template-areas:
		'year month district district regions regions portfolio portfolio'
		'legnotice delivery delivery delivery livecase livecase wrarrest wrarrest'
		'cma delivery delivery delivery livecase livecase wrarrest wrarrest'	
		'auction moneyrecovery moneyrecovery moneyrecovery livecase livecase caseupdate caseupdate'
		'caseagainstbank moneyrecovery moneyrecovery moneyrecovery livecase livecase caseupdate caseupdate'
		/*'legnotice legnotice delivery delivery livecase livecase livecase livecase'
		'cma cma delivery delivery livecase livecase livecase livecase'
		'auction auction moneyrecovery moneyrecovery wrarrest wrarrest caseupdate caseupdate'
		'caseagainstbank caseagainstbank moneyrecovery moneyrecovery wrarrest wrarrest caseupdate caseupdate'*/
		'legcost profbill profbill profbill highcourt highcourt schedule schedule'
		'legvet profbill profbill profbill highcourt highcourt schedule schedule';
	gap: 8px;
	background-color: #d9d9d9;
	/*padding: 8px 0.5%;*/
	width:100%;
	font-family: tahoma;
}

.grid-container > div {
	background-color: #ffffff;
	text-align: center;
	padding: 3px 0;
	font-size: 16px;
	width:auto;
	height: auto;
}
	
.itm1 { grid-area: header;width:calc(100vw - 520px)!important;}
.itm2 { grid-area: chart;padding-top: 40px!important;width: 500px!important;}

	
.itm21 { grid-area: header;width:calc(100vw - 520px)!important;}
.itm22 { grid-area: chart;padding-top: 30px!important;width: 500px!important;}

	
.itm31 { grid-area: header;width:calc(100vw - 520px)!important;}
.itm32 { grid-area: chart;padding-top: 30px!important;width: 500px!important;}

.grid-container2 {
	display: grid;
	grid-template-areas:
		'header header header header header chart chart chart'
		'main main main main main chart chart chart'
		'main main main main main chart chart chart';
	gap: 8px;
	background-color: #d9d9d9;
	width:100%;
	min-height: 440px;
	height: calc(100vh - 190px);
}
	
.grid-container2 > div {
	background-color: #ffffff;
	text-align: center;
	padding: 3px 0;
	font-size: 12px;
	/*height: 130px!important;*/ 
	/*width: auto;*/
}
	
.itm41 { grid-area: top;}
.itm42 { grid-area: content;padding-top: 10px!important;}

.grid-container3 {
	display: grid;
	grid-template-areas:
		'top'
		'content';
	gap: 8px;
	background-color: #d9d9d9;
	width:100%;
	/*min-height: 440px;*/
}
	
.grid-container3 > div {
	background-color: #ffffff;
	text-align: center;
	padding: 3px 0;
	font-size: 12px;
}

.tab {
	overflow: hidden;
	border: 0px solid #ccc;
	background-color: #ffffff;
	padding: 7px;
	/*width:99.25%;
	margin:0 7px;*/
}

/* Style the buttons inside the tab */
.tab button {
	background-color: #348598;
	float: left;
	border: none;
	outline: none;
	cursor: pointer;
	padding: 2px 8px;
	margin:0 3px;
	transition: 0.3s;
	font-size: 13px;
	color:#ffffff;
	width:140px;
	border-radius:5px;
	min-height: 20px;
}

/* Change background color of buttons on hover */
.tab button:hover {
	background-color: #337182;
}

/* Create an active/current tablink class */
.tab button.active {
	background-color: #295a68;
}

/* Style the tab content */
.tabcontent {
	display: none;
	/*padding: 6px 12px;*/
	border: 0px solid #ccc;
	border-bottm: none;
	min-height: calc(100vh - 164px)!important;
}

#body {margin: 0;}
#year {margin: 0 auto;width: 120px;}
#month {margin: 0 auto;width: 120px;}
#region {margin: 0 auto;width: 120px;}
#district {margin: 0 auto;width: 120px;}
#loan_segment {margin: 0 auto;width: 120px;}
.h3 {margin: 0;padding: 2px 4px 4px; font-size:16px;font-weight:bold;color: #1D77F1;}
#livecase {margin-left: 10px;}
	
	
.canvasjs-chart-credit {display: none;}
	
#lglcosts { max-width: 480px;margin: 0 10px!important;}
#caseagainstbank { max-width: 480px;margin: 0 10px!important;}
	
	
.wrap-collabsible {
	margin: 0 .5rem .5rem;
}
input[type='checkbox'] {
	display: none;
}
.lbl-toggle {
	display: block;
	font-weight: bold;
	font-family: Helvetica, Arial," sans-serif";
	font-size: 0.9rem;
	text-transform: uppercase;
	text-align: center;
	padding: .5rem;
	color: #ffffff;
	background: #3a8adf;
	cursor: pointer;
	border-radius: 7px;
	transition: all 0.25s ease-out;
}
.lbl-toggle:hover {
	color: #000000;
}
.lbl-toggle::before {
	content: ' ';
	display: inline-block;
	border-top: 5px solid transparent;
	border-bottom: 5px solid transparent;
	border-left: 5px solid currentColor;
	vertical-align: middle;
	margin-right: .7rem;
	transform: translateY(-2px);
	transition: transform .2s ease-out;
}
.toggle:checked + .lbl-toggle::before {
	transform: rotate(90deg) translateX(-3px);
}
.collapsible-content {
	max-height: 0px;
	overflow: hidden;
	transition: max-height .25s ease-in-out;
}
.toggle:checked + .lbl-toggle + .collapsible-content {
	max-height: 100vh;
	overflow: scroll;
}
.toggle:checked + .lbl-toggle {
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}
.collapsible-content .content-inner {
	background: #f0f0f0;
	border-bottom: 1px solid #cccccc;
	border-bottom-left-radius: 7px;
	border-bottom-right-radius: 7px;
	padding: .5rem 1rem;
	color: #000000;
	font-size: 13px!important;
}
@media screen and (min-width: 480px) and (max-width: 1366px) {
  
  .height_class {
    height: 134px!important; 
  }
  .height_class2 {
    min-height: 450px!important; 
  }
  /*.height_class3 {
    height: 315px!important; 
  }*/
  .itm3 { grid-area: main;height:357px!important;width:calc(100vw - 520px)!important;}
	.itm23 { grid-area: main;height:350!important;width:calc(100vw - 520px)!important;}
	.itm33 { grid-area: main;height:357px!important;width:calc(100vw - 520px)!important;}
}

@media screen and (min-width: 1367px) and (max-width: 1920px) {
  .height_class {
    height: 166px!important; 
  }
  .height_class2 {
    min-height: 548px!important; 
  }
	.grid-container > div {
		font-size: 18px!important;
	}
	
	.column2 {
	  margin-left: 8px!important;
	}
  /*.height_class2 {
    height: 360px!important; 
  }
  .height_class3 {
    height: 340px!important; 
  }*/
  .itm3 { grid-area: main;height:455px!important;width:calc(100vw - 520px)!important;}
	.itm23 { grid-area: main;height:455px!important;width:calc(100vw - 520px)!important;}
	.itm33 { grid-area: main;height:455px!important;width:calc(100vw - 520px)!important;}
	
}
/*Mamun Ends (June 02, 2022)*/
</style>
<style type="text/css" >
    #table_calendar{
    	width: 100%;
    	height: auto;
    }
    #table_calendar th {
      text-align: center;
      font-size: 10px;
      font-family: tahoma;
    }
    #table_calendar td {
      text-align: center;
      font-size: 10px;
      font-family: tahoma;
    }
    
    .hover {
      background: #ddd;
      cursor: pointer;
    }
    .active{
        background: #AE1F55!important;
        color: #fff;
    }
    .select{
        background: #622E76!important;
        color: #fff!important;
    }
    
    .holiday{
        color: #B11E54;
    }
    .calendar_bar{
        width: 100%;
        height: 4px;
        background-image: linear-gradient(to right, #602E77,#B11E54);
        
    }
    .calendar_footer{
        width: 100%;
        text-align: center;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 12px;
    }
    .calendar{
    }
    .calendar_title{
        font-size: 14px;
        width: 100%;
        height: 16px;
        background-image: linear-gradient(to right, #602E77,#B11E54);
       
    }
    #year_c{
        font-weight: bold;
        float: left;
        color: #fff;
        position: relative;
        left: -20px;
    }
    #month_c{
        font-weight: bold;
        float: right;
        text-transform: uppercase;
        text-align: right;
        color: #fff;
        position: relative;
        right: -20px;
    }

    .left:hover{
        background: #622E76;
    }
    .right:hover{
        background: #AE1F55;
    }
    .left{
        float: left;
        text-align: center;
        background: #AE1F55;
        border: none;
        color: #fff;
        font-size: 12px;
        cursor: pointer;
        position: relative;
		top: 0px;
		left: 110px;
    }
    .right{
        float: right;
        background: #622E76;
        border: none;
        color: #fff;
        font-size: 12px;
        cursor: pointer;
        position: relative;
		top: 0px;
		right: 100px;
    }

/*  Legal Cost Design  css */

.legal_cost_header_design {
	background: #53a0a0 !important;
	border-radius: 2rem;
	/* color: #cca151; */
}
.legal_cost_header_design h1{
	color: #fff;
	font-family: serif;
}


.main_container{
	margin-top:6px;
	display:flex;
	border: 1px solid #29cdff;
	padding: 8px 10px;
	border-radius: 1rem;

}

.legal_cost_file {
	border: 1px solid #29cdff;
	padding: 14px;
	font-weight: 800;
	color: #000;
	border-radius: 10px;
}

.legal_cost_file_load_button_design{

	border: 1px solid #29cdff;
	padding: 14px;
	font-weight: 800;
	color: #000;
	border-radius: 10px;
	background-color:#ffffff;

}

#search_all_data {
	width: 19rem;
	height: 2.60rem;
	border-radius: 1rem;
	text-align: center;
	font-size: 24px;
	font-weight: 500;
	font-family: serif;
	
	color: gray;
	border: 1px solid #29cdff;
}
#legal_cost_button {
	border: none;
	width: 6rem;
	padding: 1rem;
	height: -11rem;
	border: 2px solid #29cdff;
	border-radius: 17px;
	background: white;
	cursor: pointer;
	font-weight: bold;
}

</style>
<script type="text/javascript" language="javascript">
	
	var csrf_token = "";
	var theme = 'classic';
	var wid = jQuery(window).width();
	var hei = jQuery(window).height();
	//alert(wid+" "+hei);
	var fontSize=8;
	if(wid>1366 && wid <2020){
		fontSize=9;
	}
	let date =  new Date().getFullYear();
	
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
	
	// prepare chart data as an array
	var loan_segment = [<? $i=1; foreach($loan_segment as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}'; $i++;}?>];
    var region = [<? $i=1; foreach($region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var case_type = [<? $i=1; foreach($case_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    jQuery(document).ready(function() {
		var proposed_type = ["Loan", "Card"];
		var notification_type = [
	        {value:'1',label:'1st Legal Notice'},
	        {value:'2',label:'Lawyer’s Professional Bill'},
	        {value:'3',label:'Paper Publication Bill'},
	        {value:'4',label:'AIT & VAT (HO)'},
	        {value:'5',label:'CMA'},
	        {value:'6',label:'Case status Update'},
	        {value:'7',label:'Court Fee Adjustment'},
	        {value:'8',label:'Court Fee Return'},
	        {value:'9',label:'Staff Connivance'},
	        {value:'10',label:'Authorization'},
	        {value:'11',label:'Case management'},
	        {value:'12',label:'Warrant of Arrest'},
	        {value:'13',label:'Appeal & Bail Money withdraw'},
	        {value:'14',label:'Case status Update  (High Court)'},
	    ];
	    jQuery("#notification_type").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: notification_type, width: 250, height: 25});
        jQuery("#notification_type").jqxDropDownList('val', 1);
		jQuery("#case_type").jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Case Type", source: case_type, height: 25});
		jQuery("#recovery_proposed_type").jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
		jQuery("#case_against_bank_proposed_type").jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
		// jQuery("#legal_cost_proposed_type").jqxComboBox({theme: theme, width: 80, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
		jQuery('#case_against_bank_proposed_type,#recovery_proposed_type,#case_type').focusout(function() {
	        commbobox_check(jQuery(this).attr('id'));
	    	});
	   	jQuery("#recovery_proposed_type").jqxComboBox('val','Loan');
	   	jQuery('#recovery_proposed_type').bind('change', function (event) {
            jQuery("#recovery_loan_ac").val('');
            jQuery("#recovery_hidden_loan_ac").val('');    
        });
        // jQuery("#legal_cost_proposed_type").jqxComboBox('val','Loan');
	   	// jQuery('#legal_cost_proposed_type').bind('change', function (event) {
        //     jQuery("#legal_cost_loan_ac").val('');
        //     jQuery("#legal_cost_hidden_loan_ac").val('');    
        // });
        jQuery("#case_against_bank_proposed_type").jqxComboBox('val','Loan');
	   	jQuery('#case_against_bank_proposed_type').bind('change', function (event) {
            jQuery("#case_against_bank_loan_ac").val('');
            jQuery("#case_against_bank_hidden_loan_ac").val('');    
        });
		jQuery("#hidden_selected_dt").val('');
		jQuery("#month").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Month", source: month, width: 120, height: 20});
		jQuery("#region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Region", source: region, width: 120, height: 20});
        jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select District", source: district, width: 120, height: 20});
        jQuery("#req_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Case Type", source: req_type, width: 180, height: 25});
        // jQuery("#legal_cost_req_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Case Type", source: req_type, width: 100, height: 25});
        jQuery("#loan_segment").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Portfolio", source: loan_segment, width: 130, height: 20});
        var start=1990;
        var year = [];
        for (var i = date; i >=start; i--) {
            year.push({ value: i, label: i });
        }
        //jQuery("#year").jqxDropDownList({theme: theme,autoDropDownHeight: false, dropDownHeight: 100,source: year, width: 100, height: 20});
        //jQuery("#yearselect").html(year);
        //jQuery("#year").jqxDropDownList('val', date);
        jQuery("#year").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Year", source: year, width: 180, height: 25});
        jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
        jQuery("#details").jqxWindow({ theme: theme,maxWidth: '95%', maxHeight: '90%',  width: '95%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#d_ok") });
        jQuery("#details3").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#d3_ok") });
        jQuery("#details2").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK") });
        jQuery("#details4").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK4") });
        jQuery("#prof_bill_zoom").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 600, height:500, resizable: false,  isModal: true, autoOpen: false ,cancelButton: jQuery("#prof_ok")});
        // jQuery('#prof_bill_zoom').jqxWindow({ showCloseButton: false }); 
        jQuery('#year').bind('change', function (event) {
            // var year = jQuery('#year').val();
            // if (year!='')
            // {
            //     get_deshboard_data();
            // } 
            get_deshboard_data(); 

            
        });
        get_deshboard_data(); 

        
    });
    function mask(str,textbox,prefix){
        var item = jQuery("#"+prefix+"proposed_type").jqxComboBox('getSelectedItem');
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
                    jQuery("#"+prefix+"hidden_loan_ac").val(str);
                }
                else//For single value enter
                {
                    //For New value
                    var orginal_loan_ac=jQuery("#"+prefix+"hidden_loan_ac").val();
                    if (orginal_loan_ac.length<str.length) 
                    {
                        var index = str.length-1;
                        var new_val=str.slice(index);
                        orginal_loan_ac+=new_val;
                        //alert(orginal_loan_ac);
                        jQuery("#"+prefix+"hidden_loan_ac").val(orginal_loan_ac);
                    }
                    //For delete key
                    else{
                        var len=str.length;
                        var new_val=orginal_loan_ac.slice(0,len);
                        jQuery("#"+prefix+"hidden_loan_ac").val(new_val);
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
                          if (letter_Count<6 || jQuery("#"+prefix+"hidden_loan_ac").val().length!=16) 
                          {
                            textbox.value = '';
                            jQuery("#"+prefix+"hidden_loan_ac").val('');
                            alert('Wrong way to input Card No please try again');
                          }
                    }
                }
            }
        }
        
    }
    function get_details(index,type) {
        var data = index.split("_");
        jQuery("#details_title").html(data[0]);
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var year = jQuery('#year').val();
        var item = jQuery("#month").jqxComboBox('getSelectedItem');
        if(item==null)
        {
            var month_value = 0;
        }
        else
        {
            var month_value = item.value;
        }
        var item2 = jQuery("#region").jqxComboBox('getSelectedItem');
        if(item2==null)
        {
            var region_value = 0;
        }
        else
        {
            var region_value = item2.value;
        }
        var item3 = jQuery("#district").jqxComboBox('getSelectedItem');
        if(item3==null)
        {
            var district_value = 0;
        }
        else
        {
            var district_value = item3.value;
        }
        var item4 = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
        if(item4==null)
        {
            var loan_segment_value = '';
        }
        else
        {
            var loan_segment_value = item4.value;
        }
        jQuery.ajax({
            type: "POST",
            async:false,
            url: "<?=base_url()?>home/product_details/",
            data : {[csrfName]: csrfHash,operation_name: index,year:year,month:month_value,region:region_value,district:district_value,loan_segment:loan_segment_value},
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json['csrf_token']);
                    if(json['row_info'])
                    {
                        document.getElementById("details3").style.visibility='visible';
                        var html='';
                        if (json['row_info'].length>0)
                        {
                            jQuery.each(json['row_info'],function(key,obj){
                                html+='<tr>';
                                    html+='<td align="left"><div style="text-align:center; cursor:pointer" onclick="ln_cma_auc_details('+obj.id+',\''+type+'\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div></td>';
                                    html+='<td align="left">'+obj.sl_no+'</td>';
                                    html+='<td align="center">'+obj.loan_ac+'</td>';
                                    html+='<td align="center">'+obj.ac_name+'</td>';
                                    html+='<td align="left">'+obj.region_name+'</td>';
                                    html+='<td align="left">'+obj.territory_name+'</td>';
                                html+='</tr>';
                            });
                        }
                        else
                        {
                            html+='<tr>';
                                    html+='<td colspan="5" align="center">No Data!!</td>';
                                html+='</tr>';
                        }
                        
                        jQuery("#details_main").html(html);
                        jQuery("#details3").jqxWindow('open');
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });

    }
    function r_history (id,type) {
        jQuery("#r_heading").html('Life Cycle');
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        if (type=='legal_notice') 
        {
            var url='legal_notice/r_history';
        }
        if (type=='cma')
        {
            var url='cma_process/r_history';
        }   
        var life_cycle='life_cycle';
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>"+url,
            data : {[csrfName]: csrfHash,id: id,life_cycle:life_cycle},
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json['row_info'])
                    {
                        document.getElementById("r_history").style.visibility='visible';
                        var html='';
                        jQuery.each(json['row_info'],function(key,obj){
                            html+='<tr>';
                                html+='<td align="left">'+obj.oprs_sts+'</td>';
                                html+='<td align="left">'+obj.r_by+'</td>';
                                html+='<td align="center">'+obj.oprs_dt+'</td>';
                                html+='<td align="left">'+obj.oprs_descriptions+'</td>';
                                if (obj.oprs_reason!=null)
                                {
                                    html+='<td align="center">'+obj.oprs_reason+'</td>';
                                }else{html+='<td align="center"></td>';}
                            html+='</tr>';
                        });
                        jQuery("#r_history_details").html(html);
                        jQuery("#r_history").jqxWindow('open');
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
    }
    function change_chart(operation)
    {
        if (operation=='show_hidden')
        {
            jQuery("#cma_chart_hidden").animate({
              height: 'toggle'
            }, 1000,function() {

            });
            jQuery("#cma_chart_init").hide();
            jQuery("#hide_image_cma").hide();
            jQuery("#show_image_cma").show();
        }
        else{
            jQuery("#cma_chart_hidden").hide();
            jQuery("#cma_chart_init").animate({
              height: 'toggle'
            }, 1000,function() {

            });
            jQuery("#show_image_cma").hide();
            jQuery("#hide_image_cma").show();
        }
    }
    function change_chart_live_case(operation)
    {
        if (operation=='show_hidden')
        {
            jQuery("#livecase_hidden").show();
            //jQuery("#cma_chart_hidden").show();
            jQuery("#livecase").hide();
            jQuery("#hide_image").hide();
            jQuery("#show_image").show();
        }
        else{
            jQuery("#livecase_hidden").hide();
            jQuery("#livecase").show();
            //jQuery("#cma_chart_init").show();
            jQuery("#show_image").hide();
            jQuery("#hide_image").show();
        }
    }
    function change_chart_case_status(operation)
    {
        //alert('success');
        if (operation=='show_hidden')
        {
            jQuery("#caseupdate_hidden").show();
            jQuery("#caseupdate").hide();
            jQuery("#hide_image_status").hide();
            jQuery("#show_image_status").show();
        }
        else{
            jQuery("#caseupdate_hidden").hide();
            jQuery("#caseupdate").show();
            jQuery("#show_image_status").hide();
            jQuery("#hide_image_status").show();
        }
    }
	function get_deshboard_data()
    {
        
        var year = jQuery('#year').val();
        var item = jQuery("#month").jqxComboBox('getSelectedItem');
        if(item==null)
        {
            var month_value = 0;
        }
        else
        {
            var month_value = item.value;
        }
        var item2 = jQuery("#region").jqxComboBox('getSelectedItem');
        if(item2==null)
        {
            var region_value = 0;
        }
        else
        {
            var region_value = item2.value;
        }
        var item3 = jQuery("#district").jqxComboBox('getSelectedItem');
        if(item3==null)
        {
            var district_value = 0;
        }
        else
        {
            var district_value = item3.value;
        }
        var item4 = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
        if(item4==null)
        {
            var loan_segment_value = '';
        }
        else
        {
            var loan_segment_value = item4.value;
        }

        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>Home/get_front_deshboard_data/",
            data : {
                [csrfName]: csrfHash,year:year,month:month_value,region:region_value,district:district_value,loan_segment:loan_segment_value
            },
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('#total_legal_notice').html(json.total_ln);
                jQuery('#total_cma').html(json.total_cma);
                jQuery('#total_auction').html(json.total_auction);
                jQuery('#total_case_against_bank').html(json.total_case_against_bank);
                jQuery('#total_legal_cost').html(json.total_legal_cost);
                //Instrument Delivered & Case Pending
               	
                var options = {
                    animationEnabled: true,
                    theme: "light2",            
                    title:{
                        text: "Instrument Delivered & Case Pending",
                        verticalAlign: "bottom",
                        horizontalAlign: "center",
                        fontSize: 12,
                        fontFamily: "tahoma",
                        fontWeight: "normal",
                    },
                    axisY:{
                        gridThickness:0,
                        labelFontSize: 12,
                        gridThickness: 0,
						tickLength: 0,
						lineThickness: 0,
						labelFormatter: function(){
						  return " ";
						}
                    },
                    axisX:{
                       labelFontSize: 12,
                       gridThickness:0,

                    },
                    
                    toolTip: {
                        shared: true
                    },
                    legend:{
                        verticalAlign: "top",
                        horizontalAlign: "center",
                        fontSize: 12,
                        fontWeight: "normal",
                    },
                    data: [
                    {     
                        type: "stackedBar",
                        showInLegend: true,
                        indexLabel: "{y}",
                        indexLabelFontColor: "#fff",
                        name: "File Delivered",
                        color: "#052c73",
                        fontWeight: "normal",
                        click: get_front_deshboard_details,
                        dataPoints: [
                            { y: parseInt(json.total_file_delivered), label: "Instrument Delivered" },
                            { y: parseInt(json.total_deleverd_filling), label: "Case Filing Pending" },
                            { y: parseInt(json.total_deleverd_live_case), label: "Live Case" }
                        ]
                    },
                    {
                        type: "stackedBar",
                        showInLegend: true,
                        indexLabel: "{y}",
                        indexLabelFontColor: "#fff",
                        name: "Cheque Delivered",
                        color: "#80afd6",
                        fontWeight: "normal",
                        click: get_front_deshboard_details,
                        dataPoints: [
                            { y: parseInt(json.total_instru_delivered), label: "Instrument Delivered" },
                            { y: parseInt(json.total_instru_filling), label: "Case Filing Pending" },
                            { y: parseInt(json.total_instru_live_case), label: "Live Case" }
                        ]
                    }
                    ]
                };

                jQuery("#chartContainer").CanvasJSChart(options);

                //Live Case Information
                var options2 = {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Live Case Information",
                        fontSize: 12,
                        fontWeight: "normal",
                        fontFamily: "tahoma",
                    },
					width: 250,
					height: 260,
                    axisX:{
                       labelFontSize: 12,
                       gridThickness:0,
                     },
                    axisY:{
                       labelFontSize: 12,
                       gridThickness: 0,
						tickLength: 0,
						lineThickness: 0,
						labelFormatter: function(){
						  return " ";
						}
                     },
                    data: [              
                    {
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        indexLabel: "{y}",
                        bevelEnabled: true,
                        click: get_front_deshboard_details,
                        dataPoints: [
                            { label: "ARA",  y: parseInt(json.ara)  },
                            { label: "NI ACT", y: parseInt(json.ni_act)  },
                            { label: "Others", y: parseInt(json.others)  },
                            { label: "Total", y: parseInt(json.others)+parseInt(json.ni_act)+parseInt(json.ara)  },
                        ]
                    }
                    ]
                };

                jQuery("#livecase").CanvasJSChart(options2);

                 //Disposal Case Information
                var options2 = {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Disposal Case Information",
                        fontSize: 12,
                        fontWeight: "normal",
                        fontFamily: "tahoma",
                    },
					width: 255,
					height: 260,
                    axisX:{
                       labelFontSize: 12,
                       gridThickness:0,
                     },
                    axisY:{
                       labelFontSize: 12,
                       gridThickness: 0,
						tickLength: 0,
						lineThickness: 0,
						labelFormatter: function(){
						  return " ";
						}
                     },
                    data: [              
                    {
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        indexLabel: "{y}",
                        bevelEnabled: true,
                        click: get_front_deshboard_details,
                        dataPoints: [
                            { label: "ara",  y: parseInt(json.ara_disposal)  },
                            { label: "ni act", y: parseInt(json.ni_act_disposal)  },
                            { label: "others", y: parseInt(json.others_disposal)  }
                        ]
                    }
                    ]
                };

                jQuery("#livecase_hidden").CanvasJSChart(options2);
                //Appeal & Bail Money Recovery
	            var chart = new CanvasJS.Chart("piechart",
	            {
	                title:{
	                    text: "Appeal & Bail Money Recovery",
	                    verticalAlign: "bottom",
	                    horizontalAlign: "center",
	                    fontSize: 12,
	                    fontWeight: "normal",
	                    fontFamily: "tahoma",
	                },
	                legend: {
	                    maxWidth: 350,
	                    itemWidth: 120,
	                    verticalAlign: "top",
	                    horizontalAlign: "center",
	                    fontSize: 12,
	                    fontWeight: "normal",
	                },
	                data: [
	                {
	                    type: "pie",
	                    indexLabelFontSize: 12,
	                    showInLegend: true,
	                    legendText: "{indexLabel} (Cr.)",
	                    click: get_front_deshboard_details,
	                    dataPoints: [
	                        { y: parseFloat(json.bail_money), indexLabel: "Bail Money" },
	                        { y: parseFloat(json.appeal_money), indexLabel: "Appeal Money" }
	                    ]
	                }
	                ]
	            });
            	chart.render();
            	//Warrant of Arrest Process
            	CanvasJS.addColorSet("wacolor",
                [//colorSet Array

                "#DF7970",
                "#51CDA0"              
                ]);
                var chart2 = new CanvasJS.Chart("doughnutchart",
                {
                	colorSet: "wacolor",
                    title:{
                        text: "Warrant of Arrest Process",
                        verticalAlign: "bottom",
                        horizontalAlign: "center",
                        fontSize: 12,
                        fontFamily:"tahoma",
                        fontWeight: "normal",

                    },
                    data: [
                    {
                        type: "doughnut",
                        indexLabelFontSize: 12,
                        startAngle: 30,
                        click: get_front_deshboard_details,
                        dataPoints: [
                            {  y: parseInt(json.pending_warrent), indexLabel: "Pending Warrant" },
                            {  y: parseInt(json.executed_warrent), indexLabel: "Warrant Execution" }
                        ]
                    }]
                });

                chart2.render();
                //Professionals Bill
                var options4 = {
	                animationEnabled: true,
	                theme: "light2",
	                title: {
	                    text: "Professionals Bill",
	                    fontSize: 12,
	                    fontFamily: "tahoma",
	                    fontWeight: "normal",

	                },
	                axisY:{
	                    minimum:0,
	                   labelFontSize: 12,
	                   gridThickness:0,
						tickLength: 0,
						lineThickness: 0,
						labelFormatter: function(){
						  return " ";
						}
	                 },
	                 axisX:{
						labelFontSize: 12,
	                 },
	                 toolTip: {
	                    shared: true
	                },
	                data: [              
	                {
	                    // Change type to "doughnut", "line", "splineArea", etc.
	                    type: "column",
	                    bevelEnabled: true,
	                    indexLabel: "{y}",
	                    indexLabelFontSize: 12,
	                    click: get_front_deshboard_details,
	                    dataPoints: [
	                        { label: "Court Ent.", y: parseFloat(json.total_court_enter)  },
	                        { label: "Staff Con.",  y: parseFloat(json.total_staff_conv)  },
	                        { label: "Vendor Bill", y: parseFloat(json.total_vendor_bill)  },
	                        { label: "Lawyer Bill",  y: parseFloat(json.total_lawyer_bill)  },
	                        { label: "Court Fees", y: parseFloat(json.total_court_fee)  },
	                        { label: "Total Bill",  y: parseFloat(json.total_cost)  },
	                    ]
	                }
	                ]
	            };

	            jQuery("#profbill").CanvasJSChart(options4);
	            //Professionals Bill Zoom
                var options4 = {
	                animationEnabled: true,
	                theme: "light2",
	                title: {
	                    text: "Professionals Bill",
	                    fontSize: 12,
	                    fontFamily: "tahoma",
	                    fontWeight: "normal",

	                },
					width:500,
	                axisY:{
						minimum:0,
						labelFontSize: 12,
						fontSize: 12,
						gridThickness:0,
						tickLength: 0,
						lineThickness: 0,
						labelFormatter: function(){
						  return " ";
						}
	                 },
	                 axisX:{
						labelFontSize: 12,
	                 },
	                 toolTip: {
	                    shared: true
	                },
	                data: [              
	                {
	                    // Change type to "doughnut", "line", "splineArea", etc.
	                    type: "column",
	                    indexLabel: "{y}",
	                    indexLabelFontSize: 12,
	                    bevelEnabled: true,
	                    click: get_front_deshboard_details,
	                    dataPoints: [
	                        { label: "Court Ent.", y: parseFloat(json.total_court_enter)  },
	                        { label: "Staff Con.",  y: parseFloat(json.total_staff_conv)  },
	                        { label: "Vendor Bill", y: parseFloat(json.total_vendor_bill)  },
	                        { label: "Lawyer Bill",  y: parseFloat(json.total_lawyer_bill)  },
	                        { label: "Court Fees", y: parseFloat(json.total_court_fee)  },
	                        { label: "Total Bill",  y: parseFloat(json.total_cost)  },
	                    ]
	                }
	                ]
	            };

	            jQuery("#profbill_zoom").CanvasJSChart(options4);
	            //Legal Costs
	            var cost = new CanvasJS.Chart("lglcosts",
				{
					title:{
						text: "Legal Costs",
						fontSize: 13,
						fontFamily: "tahoma",
						fontWeight: "normal",
					},
					axisX:{
						gridThickness: 0
				  	},
				  	axisY:{
						gridThickness: 0,
						tickLength: 0,
						lineThickness: 0,
						labelFormatter: function(){
							return " ";
						}
				  	},
					width: 400,
					dataPointWidth: 40,
				  	data: [
						{
							indexLabel: "{y}",
							bevelEnabled: true,
							indexLabelPlacement: "outside",
							type: "bar",
							dataPoints: [
								{ y: parseFloat(json.total_ara), label: "ARA Case"},
								{ y: parseFloat(json.total_ni_act), label: "NI Act Case"},
								{ y: parseFloat(json.total_others), label: "Others Case"}
							]
						}
				  	]
				});

				cost.render();
				//Case Against Bank
				var cabank = new CanvasJS.Chart("caseagainstbank",
				{
					title:{
						text: "Case Against Bank",
						fontSize: 13,
						fontFamily: "tahoma",
						fontWeight: "normal",
					},
					axisY:{
						gridThickness: 0,
						tickLength: 0,
						lineThickness: 0,
						labelFormatter: function(){
						  return " ";
						}
				  	},
					width: 450,
					dataPointWidth: 40,
				  	data: [
						{
							indexLabel: "{y}",
                        	bevelEnabled: true,
							indexLabelPlacement: "outside",
							type: "column",
							dataPoints: [						
								{ y: parseInt(json.total_civil), label: "Civil Case"},
								{ y: parseInt(json.total_criminal), label: "Criminal Case"}
							]
						}
				  	]
				});

				cabank.render();
				//Recovery After Case
				var livecases = {
					animationEnabled: true,
					theme: "light2",
					title: {
						text: "Recovery After Case",
						fontSize: 13,
						fontFamily: "tahoma",
						fontWeight: "normal",
					},
					axisX:{
					   labelFontSize: 12,
					 },
					axisY:{
					   labelFontSize: 12,
					 },
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "doughnut",
						indexLabel: "{y}",
						dataPoints: [
							{ label: "ARA",  y: parseFloat(json.recovery_ara_money)  },
							{ label: "NI ACT", y: parseFloat(json.recovery_ni_money)  },
							{ label: "Others", y: parseFloat(json.recovery_others_money)  }
						]
					}
					]
				};

				jQuery("#livecase2").CanvasJSChart(livecases);
				//hcad
                var options4 = {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "HC & AD Matter",
                    fontSize: 12,
                    fontFamily: "tahoma",
                    fontWeight: "normal",
                },
                axisX:{
                   labelFontSize: 12,
                 },
                axisY:{
                   labelFontSize: 12,
                   gridThickness: 0,
					tickLength: 0,
					lineThickness: 0,
					labelFormatter: function(){
					  return " ";
					}
                 },
                data: [              
                {
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        indexLabel: "{y}",
                        bevelEnabled: true,
                        dataPoints: [
                            { label: "High Court",  y: parseInt(json.total_hc_running_case)  },
                            { label: "Appeal Devision", y: parseInt(json.total_hc_running_case_ad) }
                        ]
                    }
                    ]
                };

                jQuery("#highcourt").CanvasJSChart(options4);
                //Case Status Data
				set_case_status_data();
            }
        });
    }
    function get_front_deshboard_details(e) {
        if(e.dataSeries.type=='doughnut' || e.dataSeries.type=='pie')
        {
            var index = e.dataPoint.indexLabel;
        }
        else
        {
            var index = e.dataPoint.label;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var year = jQuery('#year').val();
        var item = jQuery("#month").jqxComboBox('getSelectedItem');
        if(item==null)
        {
            var month_value = 0;
        }
        else
        {
            var month_value = item.value;
        }
        var item2 = jQuery("#region").jqxComboBox('getSelectedItem');
        if(item2==null)
        {
            var region_value = 0;
        }
        else
        {
            var region_value = item2.value;
        }
        var item3 = jQuery("#district").jqxComboBox('getSelectedItem');
        if(item3==null)
        {
            var district_value = 0;
        }
        else
        {
            var district_value = item3.value;
        }
        var item4 = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
        if(item4==null)
        {
            var loan_segment_value = '';
        }
        else
        {
            var loan_segment_value = item4.value;
        }
        //var date = jQuery("#hidden_selected_dt").val();
        var date = '';
        jQuery.ajax({
            type: "POST",
            async:false,
            url: "<?=base_url()?>home/get_front_deshboard_details/",
            data : {[csrfName]: csrfHash,date:date,operation_name: index,year:year,month:month_value,region:region_value,district:district_value,loan_segment:loan_segment_value},
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json['csrf_token']);
                    if(json.thead!='')
                    {
                        document.getElementById("details").style.visibility='visible';
                        jQuery("#print1").html(json.thead + json.tbody);
                        jQuery("#details").jqxWindow('open');
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
    }
    function details(id,type,cma_id=null,territory=null,region=null)
    {
        //jQuery("#details").jqxWindow('close');
        jQuery('#close_btn_row').show();
        if(type=='live_case' || type=='pending')
        {
            var url = "<?=base_url()?>legal_file_process/cma_and_suit_details";
        }
        else if(type=='delivered')
        {
            var url = "<?=base_url()?>cma_process/details";
        }
        jQuery('#loading_preview').show();
        jQuery('#loading_p').show();
        jQuery('#details_table').hide();
        jQuery("#details2").jqxWindow('open');
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: url,
            data : {[csrfName]: csrfHash,cma_id: cma_id,id:id,
            territory:territory,region:region
            },
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.str)
                    {
                        document.getElementById("details2").style.visibility='visible';
                        jQuery("#main_body").html(json['str']);
                        var html='';
                        jQuery("#details2").jqxWindow('open');
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
    }
    function get_pending_case_list(date=null)
    {
        var year = jQuery('#year').val();
        var item = jQuery("#month").jqxComboBox('getSelectedItem');
        if(item==null)
        {
            var month_value = 0;
        }
        else
        {
            var month_value = item.value;
        }
        var item2 = jQuery("#region").jqxComboBox('getSelectedItem');
        if(item2==null)
        {
            var region_value = 0;
        }
        else
        {
            var region_value = item2.value;
        }
        var item3 = jQuery("#district").jqxComboBox('getSelectedItem');
        if(item3==null)
        {
            var district_value = 0;
        }
        else
        {
            var district_value = item3.value;
        }
        var item4 = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
        if(item4==null)
        {
            var loan_segment_value = '';
        }
        else
        {
            var loan_segment_value = item4.value;
        }

        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>Home/get_pending_case_list/",
            data : {
                [csrfName]: csrfHash,date:date,year:year,month:month_value,region:region_value,district:district_value,loan_segment:loan_segment_value
            },
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json['csrf_token']);
                if(json.thead!='')
                {
                    document.getElementById("details").style.visibility='visible';
                    //jQuery("#details_head").html(json.thead);
                    //jQuery("#details_body_p").html(json.tbody);
                    jQuery("#print1").html(json.thead + json.tbody);
                    jQuery("#details").jqxWindow('open');
                }
                else {
                    alert("Something went wrong, please refresh the page.")
                }
            }
        });
        
    }
    function set_case_status_data(date=null)
    {
        var year = jQuery('#year').val();
        var item = jQuery("#month").jqxComboBox('getSelectedItem');
        if(item==null)
        {
            var month_value = 0;
        }
        else
        {
            var month_value = item.value;
        }
        var item2 = jQuery("#region").jqxComboBox('getSelectedItem');
        if(item2==null)
        {
            var region_value = 0;
        }
        else
        {
            var region_value = item2.value;
        }
        var item3 = jQuery("#district").jqxComboBox('getSelectedItem');
        if(item3==null)
        {
            var district_value = 0;
        }
        else
        {
            var district_value = item3.value;
        }
        var item4 = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
        if(item4==null)
        {
            var loan_segment_value = '';
        }
        else
        {
            var loan_segment_value = item4.value;
        }

        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>Home/get_case_sts_data/",
            data : {
                [csrfName]: csrfHash,date:date,year:year,month:month_value,region:region_value,district:district_value,loan_segment:loan_segment_value
            },
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json['csrf_token']);
                var options3 = {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Case Update Information",
                    fontSize: 12,
                    fontFamily: "tahoma",
                    fontWeight: "normal",
                },
                axisX:{
                   labelFontSize: 12,
                 },
                axisY:{
                   labelFontSize: 12,
                   gridThickness: 0,
					tickLength: 0,
					lineThickness: 0,
					labelFormatter: function(){
					  return " ";
					}
                 },
                data: [              
                {
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        bevelEnabled: true,
                        indexLabel: "{y}",
                        click: get_front_deshboard_details,
                        dataPoints: [
                            { label: "Status Update",  y: parseInt(json.total_updated)  },
                            { label: "Pending Update", y: parseInt(json.total_pending)  },
                            { label: "Yet To Fix", y: parseInt(json.total_yet_to_fix)  },
                            { label: "Not Available", y: parseInt(json.total_not_available)  }
                        ]
                    }
                    ]
                };

                jQuery("#caseupdate").CanvasJSChart(options3);
            }
        });
        
    }
    function obj_cleaner (str) {
        if (str!=null)
        {
            return str;
        }else{return 0;}
    }
	
    function abbreviateNumber(arr,indexes,operation=null) {
		var i=0;
		var newArr = [];
		jQuery.each(arr, function (index, value) {
			var arr_index=index;
			var newValue = value;
			if (value >= 1000) {
				var suffixes = [" ", " K", " mil", " bil", " t"];
				var suffixNum = Math.floor(("" + value).length / 3);
				var shortValue = '';
				for (var precision = 2; precision >= 1; precision--) {
					shortValue = parseFloat((suffixNum !== 0 ? (value / Math.pow(1000, suffixNum) ) : value).toPrecision(precision));
					var dotLessShortValue = (shortValue + '').replace(/[^a-zA-Z 0-9]+/g, '');
					if (dotLessShortValue.length <= 2) {
						break;
					}
				}
				if (shortValue % 1 !== 0)  shortNum = shortValue.toFixed(1);
				newValue = shortValue + suffixes[suffixNum];
			}
			newArr[index] = '<a href="#" style="color:black" onclick="get_details(\''+indexes[i]+'_'+operation+'\',\'cma\')">'+newValue+'</a>';
			i++;
		});
		return newArr;
	}
	
    function get_data()
    {
        var year = jQuery('#year').val();
        var item = jQuery("#month").jqxComboBox('getSelectedItem');
        if(item==null)
        {
            var month_value = 0;
        }
        else
        {
            var month_value = item.value;
        }
        var item2 = jQuery("#region").jqxComboBox('getSelectedItem');
        if(item2==null)
        {
            var region_value = 0;
        }
        else
        {
            var region_value = item2.value;
        }
        var item3 = jQuery("#district").jqxComboBox('getSelectedItem');
        if(item3==null)
        {
            var district_value = 0;
        }
        else
        {
            var district_value = item3.value;
        }
        var item4 = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
        if(item4==null)
        {
            var loan_segment_value = '';
        }
        else
        {
            var loan_segment_value = item4.value;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            complete:get_notification_data_dashboard,
            url: "<?=base_url()?>Home/get_sub_deshboard_data/",
            data : {
                [csrfName]: csrfHash,year:year,month:month_value,region:region_value,district:district_value,loan_segment:loan_segment_value
            },
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);

                
                //LN
                var ln_labels = ["Initiated", "Legal Notice Send", "Legal Notice UnSend"];
                if (json.ln_data[0])
                {
                    var inite=obj_cleaner(json.ln_data[0].inite);
                }else{var inite=0;}
                if (json.ln_data[0])
                {
                    var ln_sent=obj_cleaner(json.ln_data[0].ln_sent);
                }else{var ln_sent=0;}
                if (json.ln_data[0])
                {
                    var ln_unsent=obj_cleaner(json.ln_data[0].ln_unsent);
                }else{var ln_unsent=0;}
                //var ln_values = [inite, ln_sent];
                //var ln_outputValues = abbreviateNumber(ln_values,ln_labels,'ln');
                jQuery('#ln_initiated').html(inite);
                jQuery('#ln_sent').html(ln_sent);
                jQuery('#ln_unsent').html(ln_unsent);
                //CMA
                var cma_labels = ["ARA", "NI ACT","Others","Total"];
                if (json.cma_data[0])
                {
                    var ara=obj_cleaner(json.cma_data[0].ara);
                }else{var ara=0;}
                if (json.cma_data[0])
                {
                    var ni_act=obj_cleaner(json.cma_data[0].ni_act);
                }else{var ni_act=0;}
                if (json.cma_data[0])
                {
                    var others=obj_cleaner(json.cma_data[0].others);
                }else{var others=0;}
                if (json.cma_data[0])
                {
                    var total=obj_cleaner(json.cma_data[0].total);
                }else{var total=0;}
                var cma_values = [ara,ni_act, others,total ];
                var cma_outputValues = abbreviateNumber(cma_values,cma_labels,'cma');

                //CMA Initial Data
                var cma_labels_init = ["Initiated", "Decline","Approval"];
                if (json.cma_data_init[0])
                {
                    var init=obj_cleaner(json.cma_data_init[0].init);
                }else{var init=0;}
                if (json.cma_data_init[0])
                {
                    var decs=obj_cleaner(json.cma_data_init[0].decs);
                }else{var decs=0;}
                if (json.cma_data_init[0])
                {
                    var app=obj_cleaner(json.cma_data_init[0].app);
                }else{var app=0;}
                var cma_values_init = [init,decs, app];
                var cma_outputValues_init = abbreviateNumber(cma_values_init,cma_labels_init,'cma_init');


                //AUC
                var auction_labels = ["Approval", "Auction Complete"];
                if (json.auction_data[0])
                {
                    var approved=obj_cleaner(json.auction_data[0].approved);
                }else{var approved=0;}
                if (json.auction_data[0])
                {
                    var complete=obj_cleaner(json.auction_data[0].complete);
                }else{var complete=0;}
                jQuery('#auc_app').html(approved);
                jQuery('#auc_comp').html(complete);
                
                  //Legal Notice
                var total = (parseInt(inite)+parseInt(ln_sent));
                var init_parcent = (parseInt(inite)/total)*100;
                var ln_sent_parcent = (parseInt(ln_sent)/total)*100;
                var ln_unsent_parcent = (parseInt(ln_unsent)/total)*100;
                  var ln_data = [
                        {index: "Initiated", value: parseInt(init_parcent)},
                        {index: "Legal Notice Send", value: parseInt(ln_sent_parcent)},
                    	{index: "Legal Notice UnSend", value: parseInt(ln_unsent_parcent)}
                    ]
                    var source =
                        {
                            datatype: "array",
                            datafields: [
                                { name: 'index' },
                                { name: 'value' }
                            ],
                            localdata: ln_data
                        };
                    var dataAdapter = new jQuery.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading  : ' + error); } });
                    var settings = {
                        title: false,
                        description: false,
                        enableAnimations: true,
                        showLegend: false,
                        legendPosition: { left: 0, top: 0, width: 50, height: 50 },
                        padding: { left: 0, top: 0, right: 0, bottom: 0 },
                        titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                        source: dataAdapter,
                        colorScheme: 'scheme02',
                        seriesGroups:
                        [
                            {
                                type: 'donut',
                                showLabels: true,
                                series:
                                    [
                                        {
                                            dataField: 'value',
                                            displayText: 'index',
                                            labelRadius: 80,
                                            initialAngle: 0,
                                            radius: 125,
                                            innerRadius: 50,
                                            centerOffset: 0,
                                            formatSettings: { sufix: '%', decimalPlaces: 1 }
                                        }
                                    ]
                            }
                        ]
                    };
                    jQuery('#jqxChart_ln').jqxChart(settings);

                //CMA
                jQuery('.cma-chart-hidden').simpleChart({
                    title: {
                        text: '',
                        align: 'center'
                    },
                    type: 'column',
                    layout: {
                        width: '100%',
                        height: '250px'
                    },
                    item: {
                        label: cma_labels,
                        value: cma_values,
                        outputValue: cma_outputValues,
                        color: ['#34A4C1'],
                        prefix: '',
                        suffix: '',
                        render: {
                            margin: 10,
                            size: 'relative'
                        }
                    }
                });
                jQuery('.cma-chart').simpleChart({
                    title: {
                        text: '',
                        align: 'center'
                    },
                    type: 'column',
                    layout: {
                        width: '100%',
                        height: '250px'
                    },
                    item: {
                        label: cma_labels_init,
                        value: cma_values_init,
                        outputValue: cma_outputValues_init,
                        color: ['#34A4C1'],
                        prefix: '',
                        suffix: '',
                        render: {
                            margin: 10,
                            size: 'relative'
                        }
                    }
                });
                //Auction
                var total_auc = (parseInt(approved)+parseInt(complete));
                var app_parcent = (parseInt(approved)/total_auc)*100;
                var comp_parcent = (parseInt(complete)/total_auc)*100;
                  var auc_data = [
                        {index: "Approved", value: parseInt(app_parcent)},
                        {index: "Auction Complete", value: parseInt(comp_parcent)}
                    ]
                    var source2 =
                        {
                            datatype: "array",
                            datafields: [
                                { name: 'index' },
                                { name: 'value' }
                            ],
                            localdata: auc_data
                        };
                    var dataAdapter2 = new jQuery.jqx.dataAdapter(source2, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading  : ' + error); } });
                    var settings2 = {
                        title: false,
                        description: false,
                        enableAnimations: true,
                        showLegend: false,
                        legendPosition: { left: 0, top: 0, width: 50, height: 50 },
                        padding: { left: 0, top: 0, right: 0, bottom: 0 },
                        titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                        source: dataAdapter2,
                        colorScheme: 'scheme01',
                        seriesGroups:
                        [
                            {
                                type: 'donut',
                                showLabels: true,
                                series:
                                    [
                                        {
                                            dataField: 'value',
                                            displayText: 'index',
                                            labelRadius: 80,
                                            initialAngle: 0,
                                            radius: 125,
                                            innerRadius: 50,
                                            centerOffset: 0,
                                            formatSettings: { sufix: '%', decimalPlaces: 1 }
                                        }
                                    ]
                            }
                        ]
                    };
                    jQuery('#jqxChart_auc').jqxChart(settings2);
                    
            }
        });
		//get_notification_data_dashboard();
    }
    function get_notification_data_dashboard()
    {
    	var module_name = jQuery("#notification_type").val();
    	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "GET",
            cache: false,
            async:false,
            url: "<?=base_url()?>Home/get_notification_data_dashboard/",
            data : {
                [csrfName]: csrfHash,module_name:module_name
            },
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
         		var html='';
                jQuery("#notification_alerts").html(html);
                jQuery.each(json['notification'],function(key,obj){
                    html+='<tr>';
                        html+='<td align="center" width="5%"><div style="text-align:center;cursor:pointer" onclick="dashboard_notification_details('+obj.id+',\''+obj.module_name+'\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div></td>';
                        html+='<td align="left" width="95%">'+obj.type+'</td>';
                        
                    html+='</tr>';
                });
                jQuery("#notification_alerts").html(html);
                    
            }
        });
    }
    function ln_cma_auc_details(id,type,territory=null,region=null)
    {
        jQuery('#close_btn_row').show();
        if(type=='cma')
        {
            var url = "<?=base_url()?>cma_process/details";
        }
        else
        {
            var url = "<?=base_url()?>legal_notice/details";
        }
        jQuery('#loading_preview').show();
        jQuery('#loading_p').show();
        jQuery('#details_table').hide();
        jQuery("#details4").jqxWindow('open');
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: url,
            data : {[csrfName]: csrfHash,id: id,
            territory:territory,region:region
            },
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.str)
                    {
                        document.getElementById("details4").style.visibility='visible';
                        jQuery("#main_body_cma_ln_auc").html(json['str']);
                        var html='';
                        jQuery("#details4").jqxWindow('open');
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
    }
    function dashboard_notification_details(id,module_name)
    {
        jQuery('#close_btn_row').show();
        if(module_name=='ln')
        {
            var url = "<?=base_url()?>legal_notice/details";
        }
        else if(module_name=='bill_summery_lawyer')
        {
            var url = "<?=base_url()?>bill_ho/lawyer_bill_details";
        }
        else if(module_name=='bill_summery_paper')
        {
            var url = "<?=base_url()?>bill_ho/paper_bill_details";
        }
        else if(module_name=='cma')
        {
            var url = "<?=base_url()?>cma_process/details";
        }
        else if(module_name=='case_status')
        {
            var url = "<?=base_url()?>legal_file_process/details";
        }
        else if(module_name=='court_fee_adjustment')
        {
            var url = "<?=base_url()?>expenses/court_adjust_details";
        }
        else if(module_name=='court_fee_return')
        {
            var url = "<?=base_url()?>expenses/court_return_details";
        }
        else if(module_name=='staff_conv_data')
        {
            var url = "<?=base_url()?>expenses/get_staff_conv_details";
        }
        else if(module_name=='authorization')
        {
            return false;
        }
        else if(module_name=='case_management')
        {
           var url = "<?=base_url()?>cma_process/details";
        }else if(module_name=='ait_vat')
        {
           var url = "<?=base_url()?>ait_vat/details";
        }else if(module_name=='warrent_arrest')
        {
           var url = "<?=base_url()?>warrant_arrest/get_details/"+id;
        }else if(module_name=='appeal_bail_money')
        {
           var url = "<?=base_url()?>appeal_bail_money/get_details_withdraw/"+id;
        }else if(module_name=='hc_case_sts')
        {
           var url = "<?=base_url()?>hc_matter/get_details/"+id;
        }
        jQuery('#loading_preview').show();
        jQuery('#loading_p').show();
        jQuery('#details_table').hide();
        jQuery("#details4").jqxWindow('open');
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: url,
            data : {[csrfName]: csrfHash,id: id},
            datatype: "json",
            success: function(response){
            	//alert(response);
            	if(module_name=='ait_vat' || module_name=='warrent_arrest' || module_name=='appeal_bail_money' || module_name=='hc_case_sts'){
           			var ret = response.split("####");
					jQuery('.txt_csrfname').val(ret[1]);
					if(ret[0]){
						document.getElementById("details4").style.visibility='visible';
                        jQuery("#main_body_cma_ln_auc").html(ret[0]);
                        var html='';
                        jQuery("#details4").jqxWindow('open');
					}else{
						alert("Something went wrong, please refresh the page.");
					}
        		}else{
                	var json = jQuery.parseJSON(response);
                	jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.str)
                    {
                        document.getElementById("details4").style.visibility='visible';
                        jQuery("#main_body_cma_ln_auc").html(json['str']);
                        var html='';
                        jQuery("#details4").jqxWindow('open');
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }
                }
            }
        });
    }
    function get_recovery_after_case()
    {
        var recovery_loan_ac = jQuery('#recovery_loan_ac').val();
        var recovery_hidden_loan_ac = jQuery('#recovery_hidden_loan_ac').val();
        var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
        var item2 = jQuery("#recovery_proposed_type").jqxComboBox('getSelectedItem');
        if(item==null){
            var req_type = '';
        }else{
            var req_type = item.value;
        }
        if(item2==null){
            var proposed_type = '';
        }else{
            var proposed_type = item2.value;
        }
        jQuery("#recovery_loader").show();
		jQuery("#recovery_button").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>Home/get_recovery_after_case/",
            data : {
                [csrfName]: csrfHash,recovery_hidden_loan_ac:recovery_hidden_loan_ac,proposed_type:proposed_type,recovery_loan_ac:recovery_loan_ac,req_type:req_type
            },
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('#recovery_details').empty();
                var html_str = '';
                json.result.each(function(item,index){
                	html_str+='<tr><td>'+item.req_type+'</td><td>'+item.loan_ac+'</td><td>'+item.case_number+'</td><td>'+item.deposit_amt+'</td><td>'+item.withdraw_by+'</td><td>'+item.withdraw_dt+'</td></tr>';
                });
                jQuery('#recovery_details').append(html_str);
                jQuery("#recovery_loader").hide();
				jQuery("#recovery_button").show();
            }
        });
    }
    function get_legal_cost_type_wise()
    {
        // var legal_cost_loan_ac = jQuery('#legal_cost_loan_ac').val();
        // var legal_cost_hidden_loan_ac = jQuery('#legal_cost_hidden_loan_ac').val();
        // // var item = jQuery("#legal_cost_req_type").jqxComboBox('getSelectedItem');
        // // var item2 = jQuery("#legal_cost_proposed_type").jqxComboBox('getSelectedItem');
        // if(item==null){
        //     var req_type = '';
        // }else{
        //     var req_type = item.value;
        // }
        // if(item2==null){
        //     var proposed_type = '';
        // }else{
        //     var proposed_type = item2.value;
        // }
        jQuery("#legal_cost_loader").show();
		jQuery("#legal_cost_button").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postData = jQuery('#legal_cost_form').serialize()+"&"+csrfName+"="+csrfHash;
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>Home/get_legal_cost_type_wise/",
            data : postData,
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('#legal_cost_details').empty();
                var html_str = '';
                var total=0;
                json.result.each(function(item,index){
                	html_str+='<tr><td>'+item.loan_ac+'</td><td>'+item.req_type_name+'</td><td>'+item.ac_name+'</td><td>'+item.case_number+'</td><td>'+item.vendor_name+'</td><td>'+item.act_name+'</td><td>'+item.txrn_dt+'</td><td>'+item.amount+'</td></tr>';
                	total=parseFloat(total)+parseFloat(item.amount);
                });
                html_str+='<tr style="text-align:center;font-weight: bold;"><td colspan="7" text-align="center">Total Legal Cost</td><td>'+total+'</td></tr>';
                jQuery('#legal_cost_details').append(html_str);
                jQuery("#legal_cost_loader").hide();
				jQuery("#legal_cost_button").show();
            }
        });
    }

    function get_case_against_bank_data()
    {
        var case_against_bank_loan_ac = jQuery('#case_against_bank_loan_ac').val();
        var case_against_bank_hidden_loan_ac = jQuery('#case_against_bank_hidden_loan_ac').val();
        var item = jQuery("#case_type").jqxComboBox('getSelectedItem');
        var item2 = jQuery("#case_against_bank_proposed_type").jqxComboBox('getSelectedItem');
        if(item==null){
            var req_type = '';
        }else{
            var req_type = item.value;
        }
        if(item2==null){
            var proposed_type = '';
        }else{
            var proposed_type = item2.value;
        }
        jQuery("#case_against_bank_loader").show();
		jQuery("#case_against_bank_button").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>Home/get_case_against_bank_data/",
            data : {
                [csrfName]: csrfHash,case_against_bank_hidden_loan_ac:case_against_bank_hidden_loan_ac,proposed_type:proposed_type,case_against_bank_loan_ac:case_against_bank_loan_ac,req_type:req_type
            },
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery("#case_against_bank_loader").hide();
				jQuery("#case_against_bank_button").show();
                jQuery('#case_against_bank_details').empty();
                jQuery('#case_against_bank_details').append(json.str);
            }
        });
    }

    function get_360_details(){

    	var loan_ac = jQuery('#loan_ac_360').val();
        jQuery("#360_loader").show();
		jQuery("#360_button").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>Home/details_360/",
            data : {
                [csrfName]: csrfHash,loan_ac:loan_ac
            },
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery("#360_loader").hide();
				jQuery("#360_button").show();
                jQuery('#legal_notice_360_details').html(json.legal_notice_str);
                jQuery('#cma_360_details').html(json.cma_str);
                jQuery('#auction_360_details').html(json.auction_data_str);
                jQuery('#final_ln_360_details').html(json.final_legal_notice_str);
                jQuery('#suit_file_360_details').html(json.suit_data_str);
                jQuery('#other_document_360_details').html(json.other_document_str);
            }
        });
    }
    function zoom_prof_bill()
    {
    	document.getElementById("prof_bill_zoom").style.visibility='visible';
		jQuery("#prof_bill_zoom").jqxWindow('open');
    }

    function PrintTable(id) {
        var printWindow = window.open('', '', 'height=700,width=1000');
        printWindow.document.write('<html><head> <meta charset="utf-8"/><title>Table Contents</title>');
 
        //Print the Table CSS.
        //var table_style = document.getElementById("print_style").innerHTML;
        var table_style = '';
        printWindow.document.write('<style type = "text/css" media="print">');
        printWindow.document.write(".preview{display:none;}");
        printWindow.document.write('table tr td,table tr th{-moz-border:1px solid #000!important;border:1px solid #000!important;}');
        printWindow.document.write('</style>');
        printWindow.document.write('</head>');
 
        //Print the DIV contents i.e. the HTML Table.
        printWindow.document.write('<body>');
        var divContents = document.getElementById(id).innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>



<!-- dashboard report -->
<div id="container" class="vh">
    <div id="body"  >
        <div class="row">
        	<div id="Dashboard" class="tabcontent">
        		<div class="grid-container">
					<div class="item1">
						<div id="year" name="year"></div>
					</div>
					<div class="item2">
						<div class="month" id="month" name="month" onchange="get_deshboard_data()"></div>
					</div>
					<div class="item3">
						<div class="district" id="district" name="district" onchange="get_deshboard_data()"></div>
					</div>
					<div class="item4">
						<div class="region" id="region" name="region" onchange="get_deshboard_data()"></div>
					</div>
					<div class="item5">
						<div class="loan_segment" id="loan_segment" name="loan_segment" onchange="get_deshboard_data()"></div>
					</div>
					<div class="item6 height2">
						<h3 class="h3"><span id="total_legal_notice"></span></h3>
						<label class="">1st legal notice</label>
					</div>
					<div class="item7">
						<!--Delivery-->
						<div id="chartContainer" class="height_class" style="width: auto;margin: 0 auto;font-size:11px!important;"></div>						
					</div>  
					<div class="item8">
						<!--Live Case-->
						<img src="<?=base_url()?>images/arrowup.png" id="hide_image" onclick="change_chart_live_case('show_hidden')" style="margin-top: 5px;cursor:pointer;float:left">
						<img src="<?=base_url()?>images/arrowdown.png" id="show_image" onclick="change_chart_live_case('show_init')" style="margin-top: 5px;cursor:pointer;display:none;float:left">
						<div class="height_class" id="livecase_hidden" style="display:none;width: auto;"></div>
						<div id="livecase" class="height_class" style="width: auto;"></div>
					</div>
					<div class="item9 height2">
						<h3 class="h3"><span id="total_cma"></span></h3>
						<label class="">Case Merit Analysis Approved</label>
					</div>
					<div class="item10 height2">
						<h3 class="h3"><span id="total_auction"></span></h3>
						<label class="">Auction Completed</label>					
					</div>
					<div class="item11">
						<!--Case Update-->
						<div id="caseupdate" class="height_class" style="width: auto;"></div>
					</div>
					<div class="item12">
						<!--Wrarrant of Arrest-->
						<div id="doughnutchart" class="height_class" style="width: auto;margin: 0 auto;font-size:11px!important;"></div>
					</div>
					<div class="item13">
						<!--Money Recovery-->
						<div id="piechart" class="height_class" style="width: auto;margin: 0 auto;font-size:11px!important;"></div>
						
					</div>
					<div class="item14 height2">
						<h3 class="h3"><span id="total_case_against_bank"></span></h3>
						<label class="">Case Against Bank</label>						
					</div>
					<div class="item15 height2">
						<h3 class="h3"><span id="total_legal_cost"></span> Cr.</h3>
						<label class="">Legal Cost</label>
					</div>
					<div class="item16">
						<!--Prof Bill-->
						<img src="<?=base_url()?>images/maximize.png" onclick="zoom_prof_bill()" style="cursor:pointer;position: relative;right:10px;top:5px;float: right;z-index: 111;height: 20px;width: auto;">
						<div id="profbill" class="height_class" style="width: 95%;height:130px;"></div>
					</div>
					<div class="item80">
						<!--Case Update-->
						<div id="highcourt" class="height_class" style="width: auto;"></div>
					</div>
					<div class="item17">
                        <div style="width: 95%;margin: 0 auto;">
                           <h4 style="margin: 0 auto 2px;color: #000000;font-size:12px;">Case Schedule Today</h4>
                            <input type="hidden" name="hidden_selected_dt" id="hidden_selected_dt" value="">
                            <button class="left" type="button" id="left"><<</button>
                            	<button class="right" type="button" id="right">>></button>
                            <div class="calendar_title">
                            	<span id="year_c"></span>
                            	<span id="month_c"></span>
                            	
                            </div>
                            <div class="calendar" >
                                <table id="table_calendar" border="0" ></table>
                            </div>
                          
                        </div>
					</div>
					<div class="item18 height2">
						<h3 class="h3">0</h3>
						<label class="">Legal Vetting Completed</label>
					</div>
				</div>
			</div>
        	<div id="lglnotice" class="tabcontent">
        		<div class="height_class2" style="padding: 10px;background-color: #ffffff;">
        			<div class="column">
						<div class="head" style="color:white;font-family: Times New Roman;">1st Legal Notice</div>
						<div style="background-color:white">  
							<div id='jqxChart_ln' style="margin-top: 5px;width: 300px; height: 300px; position: relative; left: 0px; top: 0px;border:none"></div>    
						</div>
						<div style="background-color:white">
							<table border="1" id="data_table" cellspacing="0" cellpadding="2" style="width:50%;float:right" >
								<tr>
									<td width="10%"><div style="background-color:#0f6f6f;color:#0f6f6f">a</div></td>
									<td width="80%">Initiated</td>
									<td width="10%"><a href="#" style="color:#4F5155" onclick="get_details('Initiated_ln','ln')"><span id="ln_initiated"></span></a></td>
								</tr>
								<tr>
									<td width="10%"><div style="background-color:#f43c51;color:#f43c51">a</div></td>
									<td width="80%">Legal Notice Sent</td>
									<td width="10%"><a href="#" style="color:#4F5155" onclick="get_details('Legal Notice Send_ln','ln')"><span id="ln_sent"></span></a></td>
								</tr>
								<tr>
									<td width="10%"><div style="background-color:#ff7c39;color:#ff7c39">a</div></td>
									<td width="80%">Legal Notice Pending</td>
									<td width="10%"><a href="#" style="color:#4F5155" onclick="get_details('Legal Notice UnSend_ln','ln')"><span id="ln_unsent"></span></a></td>
								</tr>
							</table>
						</div>
					</div>
       				<div style="clear: both;"></div>
        		</div>			  
			</div>
			<div id="cma" class="tabcontent">
		  		<div class="height_class2" style="padding: 10px;background-color: #ffffff;">
					<div class="column">
						<div class="head" style="color:white;font-family: Times New Roman;">Case Merit Analysis (CMA) Approval</div>
						<div style="background-color:white">
							<div class="head_icon">
								<img src="<?=base_url()?>images/arrowup.png" id="hide_image_cma" onclick="change_chart('show_hidden')" style="margin-top: 5px;cursor:pointer;float:right">
								<img src="<?=base_url()?>images/arrowdown.png" id="show_image_cma" onclick="change_chart('show_init')" style="margin-top: 5px;cursor:pointer;display:none;float:right">
								<div id="year" tabindex="" name="year" style="padding-left: 3px"></div>
								<div style="clear: both;"></div>
							</div>
							<div class="cma-chart-hidden" id="cma_chart_hidden" style="display:none"></div>
							<div class="cma-chart" id="cma_chart_init"></div>
						</div>
					</div> 
				</div>
			</div>
			<div id="auction" class="tabcontent">
		  		<div class="height_class2" style="padding: 10px;background-color:#ffffff;">
					<div class="column">
						<div class="head" style="color:white;font-family: Times New Roman;">Auction Process</div>
						<div style="width:100%;height:80%;float:left;background-color:white"> 
							<div id='jqxChart_auc' style="margin-top: 5px;width: 300px; height: 260px; position: relative; left: 0px; top: 0px;border:none"></div>
						</div>
						<div style="width:100%;height:20%;float:right;background-color:white;margin-top: 12px;">
							<table border="1" id="data_table" cellspacing="0" cellpadding="2" style="width:50%;float:right" >
								<tr>
									<td width="10%"><div style="background-color:#ee3c61;color:#ee3c61">a</div></td>
									<td width="80%">Approval</td>
									<td width="10%"><a href="#" style="color:#4F5155" onclick="get_details('Approval_auction','cma')"><span id="auc_app"></span></a></td>
								</tr>
								<tr>
									<td width="10%"><div style="background-color:#07ad84;color:#07ad84">a</div></td>
									<td width="80%">Auction Complete</td>
									<td width="10%"><a href="#" style="color:#4F5155" onclick="get_details('Auction Complete_auction','cma')"><span id="auc_comp"></span></a></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div id="recovery" class="tabcontent">
		  		<div class="grid-container2">
					<div class="itm1" style="text-align: center;">
						<h1 style="margin-top: 0;">Recovery After Case</h1>

              

						<table style="margin:0 auto">
							<tr>
								<td><b>Type of Case</b></td>
								<td><div id="req_type" name="req_type"></div></td>
								<td><b>Proposed Type</b></td>
								<td><div id="recovery_proposed_type" name="recovery_proposed_type"></div></td>
								<td></td>
								<td><b>A/C No.</b></td>
								<td>
									<input type="hidden" name="recovery_hidden_loan_ac" id="recovery_hidden_loan_ac" >
									<input type="text" id="recovery_loan_ac" name="recovery_loan_ac" maxlength="16" size="16" onKeyUp="javascript:return mask(this.value,this,'recovery_');" style="width:180px;" />
								</td>
								<td><span id="recovery_loader" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><button type="button" id="recovery_button" onclick="get_recovery_after_case()" style="margin: 10px;" >Search</button></td>
							</tr>
						</table>
						</div>
					<div class="itm2">
						<div id="livecase2" style="margin: 0 auto;"></div>
					</div>
					<div class="itm3">
						<div style="overflow:scroll;max-height: 320px;min-height: 360px;height: 300px;">
							<table id="preview_table" class="ptbl">
								<thead><tr>
										<th align="center"><strong>Case Type</strong></th>
										<th align="center"><strong>Laon AC</strong></th>
										<th align="center"><strong>Case Number</strong></th>
										<th align="center"><strong>Deposit Amount</strong></th>
										<th align="center"><strong>Withdraw By</strong></th>
										<th align="center"><strong>Withdraw Date</strong></th>
									</tr></thead>
								<tbody id="recovery_details">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div id="lglcost" class="tabcontent">
		  		<div class="grid-container2">

					<div class="itm21" style="text-align: center;">
						<div class="legal_cost_header_design">
							<h1 style="margin: 0;">Legal Cost</h1>
						</div>

						<div class ="main_container">
							<div class="items01">
							<form method="POST" name="xl_dynamic" id="xl_dynamic" action="<?=base_url()?>home/file_upload_and_get_data"  enctype="multipart/form-data">
			                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	                                <table>
	                                	<tr>
	                                		<td>
	                                			<label class="legal_cost_file" for="recovery_file"> <strong >Select File</strong></label>
	                                			<input style="display:none " type="file" name="recovery_file" id="recovery_file" onchange="fileValidation('recovery_file')">
	                                		</td>
	                                		<td>

	                                			<!-- <label class="legal_cost_file" for="template_img"> <strong >Template</strong></label> -->

	                                			<a class="legal_cost_file" id="template_img" style="cursor:pointer; text-decoration:none; color:#000" href="<?=base_url()?>home/download_templete" target="_blank" >
	                                			<strong>Template</strong></a>
	                                		</td>
	                                
	                                		<td>
	                                			<input class="legal_cost_file_load_button_design" type="button" value="Genarate" id="load_button" class=""/>
	                                            <input type="button" value="Save" id="save_button" onclick="delete_action('save_recovery')" class="buttonclose" style="width:70px !important;height:40px;display:none" />
	                                		</td>
	                                	</tr>

	                                </table>
	                        </form>
							</div>
							<div class="items01">

								<form method="POST" name="legal_cost_form" id="legal_cost_form"   action="<?php echo base_url('Home/make_xl_legal_cost'); ?>">
                        		<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                        		<table>
                        			<tr>
                        				<td><input class="search_field_input" type="text" name="search_all_data" id="search_all_data" placeholder="Search"></td>
                        				<td> <button type="button" class="searchbutton" id="legal_cost_button" onclick="get_legal_cost_type_wise()" >Search</button></td>
                        				<td>
                        					<button class="legal_cost_file_load_button_design" title="Account Wise" type='submit' formtarget="_blank" name='xl_search' id="xl_search" value='Search'>
	                                    	<strong>A/C Wise </strong>
                        				</td>

                        				<td>
                        					<a href="<?php echo base_url('Home/download_total_legal_cost_dump'); ?>" class="legal_cost_file" style="cursor:pointer; text-decoration:none; color:#000">
	                                    	<strong>Dump</strong></a>
	                                    </td>
                        	
                        			</tr>
                        		</table>
								</form>
							</div>
						</div>
					</div>
					<div class="itm22" style="text-align: left;">
						<div id="lglcosts"></div>
					</div>
					<div class="itm23" style="text-align: left; border: 1px solid #29cdff;border-radius: 16px;">
					<div id="padding_content" style="overflow:scroll;max-height: 320px;min-height: 257px;height: 200px;margin:10px">
                            <table id="preview_table" class="ptbl" style="font-family:serif">
                                <tr>
                                    <td align="center">Loan Ac</td>
                                    <td align="center">Case Type</td>
                                    <td align="center">Account Name</td>
                                    <td align="center">Case Number</td>
                                    <td align="center">Vendor Name</td>
                                    <td align="center">Activities</td>
                                    <td align="center">Activities Date</td>
                                    <td align="center">Amount</td>
                                 </tr>
                               
                                <tbody id="legal_cost_details">
                                    
                                </tbody>
                            </table>
                        </div>
						
					</div>


	
				</div>
			</div>
			<div id="cab" class="tabcontent">
		  		<div class="grid-container2">
					<div class="itm31" style="text-align: center;">
						<h1 style="margin-top: 0;">Case Against Bank</h1>
						<table style="margin:0 auto">
							<tr>
								<td><b>Type of Case</b></td>
								<td><div id="case_type" name="case_type"></div></td>
								<td><b>Proposed Type</b></td>
								<td><div id="case_against_bank_proposed_type" name="case_against_bank_proposed_type"></div></td>
								<td></td>
								<td><b>A/C No.</b></td>
								<td>
									<input type="hidden" name="case_against_bank_hidden_loan_ac" id="case_against_bank_hidden_loan_ac" >
									<input type="text" id="case_against_bank_loan_ac" name="case_against_bank_loan_ac" maxlength="16" size="16" onKeyUp="javascript:return mask(this.value,this,'case_against_bank_');" style="width:180px;" />
								</td>
								<td><span id="case_against_bank_loader" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><button type="button" id="case_against_bank_button" onclick="get_case_against_bank_data()" style="margin: 10px;" >Search</button></td>
							</tr>
						</table>
					</div>
					<div class="itm32">
						<div id="caseagainstbank"></div>	
					</div>
					<div class="itm33">
						<div style="overflow-y: auto;" id="case_against_bank_details">
							
						</div>
					</div>
				</div>
			</div>
			
			<div id="360d" class="tabcontent">
		  		<div class="grid-container3">
		  			<div class="itm41" style="text-align: center;">
						<h1 style="margin-top: 0;">Customer 360&#176;</h1>
						<b>A/C No./Card No./Account Name</b><input type="text" id="loan_ac_360" name="loan_ac_360" style="margin: 10px 0 20px 10px;width:180px;" />
						<span id="360_loader" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
						<input type="button" id="360_button" value="Search" onclick="get_360_details()" style="margin: 10px 0 20px 10px;" />
					</div>
					<div class="itm42">
						<div style="overflow-y: auto;">
							<div class="wrap-collabsible">
								<input id="collapsible1" class="toggle" type="checkbox">
								<label for="collapsible1" class="lbl-toggle" tabindex="0">1st Legal Notice Details</label>
								<div class="collapsible-content">
									<div class="content-inner" id="legal_notice_360_details">
									</div>
								</div>
							</div>
							<div class="wrap-collabsible">
								<input id="collapsible2" class="toggle" type="checkbox">
								<label for="collapsible2" class="lbl-toggle" tabindex="0">CMA Details</label>
								<div class="collapsible-content">
									<div class="content-inner" id="cma_360_details">
										
									</div>
								</div>
							</div>
							<div class="wrap-collabsible">
								<input id="collapsible3" class="toggle" type="checkbox">
								<label for="collapsible3" class="lbl-toggle" tabindex="0">Auction Details</label>
								<div class="collapsible-content">
									<div class="content-inner" id="auction_360_details">
										
									</div>
								</div>
							</div>
							<div class="wrap-collabsible">
								<input id="collapsible4" class="toggle" type="checkbox">
								<label for="collapsible4" class="lbl-toggle" tabindex="0">Final Legal Notice Details</label>
								<div class="collapsible-content">
									<div class="content-inner" id="final_ln_360_details">
										
									</div>
								</div>
							</div>
							<div class="wrap-collabsible">
								<input id="collapsible5" class="toggle" type="checkbox">
								<label for="collapsible5" class="lbl-toggle" tabindex="0">Suit Filing Information</label>
								<div class="collapsible-content">
									<div class="content-inner" id="suit_file_360_details">
										
									</div>
								</div>
							</div>
							<div class="wrap-collabsible">
								<input id="collapsible6" class="toggle" type="checkbox">
								<label for="collapsible6" class="lbl-toggle" tabindex="0">Document Attachment</label>
								<div class="collapsible-content">
									<div class="content-inner" id="other_document_360_details">
										
									</div>
								</div>
							</div>
							<div class="wrap-collabsible">
								<input id="collapsible7" class="toggle" type="checkbox">
								<label for="collapsible7" class="lbl-toggle" tabindex="0">Other Information</label>
								<div class="collapsible-content">
									<div class="content-inner">
										<p> Avast red ensign parley clap of thunder no prey, no pay killick stern clipper execution dock splice the main brace. Grog blossom yardarm bilge water marooned cog wherry tackle aye Shiver me timbers come about.</p>
									</div>
								</div>
							</div>
							
							<script type="text/javascript">
	
							let myLabels = document.querySelectorAll('.lbl-toggle');

							Array.from(myLabels).forEach(label => {
							  label.addEventListener('keydown', e => {
								// 32 === spacebar
								// 13 === enter
								if (e.which === 32 || e.which === 13) {
								  e.preventDefault();
								  label.click();
								};
							  });
							});

							</script>
						</div>	
					</div>
				</div>
			</div>
			<div id="alerts" class="tabcontent">
		  		<div class="height_class2" style="padding: 10px;background-color: #ffffff;">
					<div id="notification_type" name="notification_type" onchange="get_notification_data_dashboard()"></div>
					<div class="column2">
						<div class="head" style="color:white;font-family: Times New Roman;">Alerts</div>
						<div style="background-color:white;overflow-y: scroll;height: 265px;">
							<table style="width: 100%;" class="preview_table2">
		                        <tbody id="notification_alerts">
		                            
		                        </tbody>
		                    </table>
						</div>
					</div> 
				</div>
			</div>
			<div class="tab">
			  <button class="tablinks" onclick="openCity(event, 'Dashboard')" id="defaultOpen">Dashboard</button>
			  <button class="tablinks" onclick="openCity(event, 'lglnotice')">1st Legal Notice</button>
			  <button class="tablinks" onclick="openCity(event, 'cma')">CMA Approval</button>
			  <button class="tablinks" onclick="openCity(event, 'auction')">Auction Process</button>
			  <button class="tablinks" onclick="openCity(event, 'recovery')">Recovery After Case</button>
			  <button class="tablinks" onclick="openCity(event, 'lglcost')">Legal Cost</button>
			  <button class="tablinks" onclick="openCity(event, 'cab')">Case Against Bank</button>
			  <button class="tablinks" onclick="openCity(event, '360d')">Customer 360&#176;</button>
			  <button class="tablinks" onclick="openCity(event, 'alerts')">Alert's</button>
			</div>

			<script>
			function openCity(evt, cityName) {
			  var i, tabcontent, tablinks;
			  tabcontent = document.getElementsByClassName("tabcontent");
			  for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			  }
			  tablinks = document.getElementsByClassName("tablinks");
			  for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			  }
			  document.getElementById(cityName).style.display = "block";
			  evt.currentTarget.className += " active";
				var year = jQuery("#year").val();
				get_data();
			}
			
			// Get the element with id="defaultOpen" and click on it
			document.getElementById("defaultOpen").click();
			</script>  	
        </div> 
    </div>
</div>

<div id="prof_bill_zoom" style="display: none;">
        <div style=""><strong>Profissional Bills</strong></div>
        <div style="" id="details_table">
            <form class="form" name="" id="" method="post" action="" enctype="">
            <div id="profbill_zoom" class="height_class" style="width: auto;"></div>
            <br>
            <div id="preview_bill_details" class="wrapper">
                
            </div>
            </form>
        </div>
    </div>
<div id="r_history" style="visibility:hidden;">
    <div><strong><span id="r_heading"></span></strong></div>
	<div style="" id="details_table">
		<table style="width: 100%;" class="preview_table2">
			<thead>
				<th width="20%" align="left"><strong>Status</strong></th>
				<th width="20%" align="left"><strong>User</strong></th>
				<td width="20%" align="center"><strong>Date and Time</strong></td>
				<td width="20%" align="left"><strong>Description</strong></td>
				<td width="20%" align="left"><strong>Reason</strong></td>
			</thead>
			<tbody id="r_history_details">

			</tbody>
		</table>
		<div class="wrapper">
			</br></br><input type="button" align="center" class="button1" style="margin-left:0px" id="r_ok" value="Close" />
		</div>
	</div>
</div>

<div id="details" style="visibility:hidden;">
    <div style=""><strong>Details</strong></div>
    
	<div style="" id="details_table">
		<button type="button" onclick="PrintTable('print1')" style="display:block; margin-right: auto;margin-left: auto;">Print</button>
		<div id="print1"></div>
		<br>
		<input type="button" class="button1" id="d_ok" value="Close" style="display:block; margin-right: auto;margin-left: auto;" />
		<br>
	</div>
</div>
<div id="details2" style="visibility:hidden;">
    <div style=""><strong>Details</strong></div>
        <div style="" id="details_table">
            <span id="main_body"></span>
            <br>
            <div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
                <input type="button" align="center" class="button1" id="codeOK" value="Close" />
            </div>
    </div>
</div>
<div id="details3" style="visibility:hidden;">
    <div style=""><strong id="details_title"></strong></div>
        <div style="" id="details_table">
            <table style="width: 100%;" class="preview_table2">
                <thead>
                    <th width="5%" align="center"><strong>P</strong></th>
                    <th width="15%" align="left"><strong>SL</strong></th>
                    <th width="20%" align="center"><strong>AC</strong></th>
                    <td width="20%" align="center"><strong>AC Name</strong></td>
                    <td width="20%" align="left"><strong>Region</strong></td>
                    <td width="20%" align="left"><strong>Territory</strong></td>
                </thead>
                <tbody id="details_main">
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" align="center"></br></br><input type="button" class="button1" id="d3_ok" value="Close" /></td>
                    </tr>
                </tfoot>
            </table>
            <br>
    </div>
</div>
<div id="details4" style="visibility:hidden;">
    <div style=""><strong>Details</strong></div>
        <div style="" id="details_table">
            <span id="main_body_cma_ln_auc"></span>
            <br>
            <div style="text-align:center;margin-bottom:30px;width:100%;">
                <input type="button" align="center" class="button1" id="codeOK4" value="Close" />
            </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url()?>scripts/jquery.canvasjs.min.js"></script>


<script>
jQuery(document).ready(function() {
  var currentDate = new Date();
  //console.log(currentDate);
  function generateCalendar(d) {
    function monthDays(month, year) {
      var result = [];
      var days = new Date(year, month, 0).getDate();
      for (var i = 1; i <= days; i++) {
        result.push(i);
      }
      return result;
    }
    Date.prototype.monthDays = function() {
      var d = new Date(this.getFullYear(), this.getMonth() + 1, 0);
      return d.getDate();
    };
    var details = {
      totalDays: monthDays(d.getMonth(), d.getFullYear()),
      totalDays: d.monthDays(),
      weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    };
    var start = new Date(d.getFullYear(), d.getMonth()).getDay();
    var cal = [];
    var day = 1;
    for (var i = 0; i <= 6; i++) {
        //if (day > details.totalDays) {continue;}
      cal.push(['<tr>']);
      for (var j = 0; j < 7; j++) {
        var holiday='';
        if(j==5 || j==6){holiday='holiday';}
        if (i === 0) {
          cal[i].push('<td class="'+holiday+'" style="background:#ddd;">' + details.weekDays[j] + '</td>');
        } else if (day > details.totalDays) {
          cal[i].push('<td class="'+holiday+'" >&nbsp;</td>');
        } else {
          if (i === 1 && j < start) {
            cal[i].push('<td class="'+holiday+'" >&nbsp;</td>');
          } else {
            var today = new Date();
            var datet = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var date = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+day;
            if(datet==date){
                cal[i].push('<td class="font day select '+holiday+'" data-date="'+date+'" onclick="get_date(this)">' + day++ + '</td>');
            }else{
                cal[i].push('<td class="font day '+holiday+'" data-date="'+date+'" onclick="get_date(this)">' + day++ + '</td>');
            }
            
          }
        }
      }
      cal[i].push('</tr>');
    }
    cal = cal.reduce(function(a, b) {
      return a.concat(b);
    }, []).join('');
    jQuery('#table_calendar').append(cal);
    jQuery('#month_c').text(details.months[d.getMonth()]);
    jQuery('#year_c').text(d.getFullYear());
    jQuery('td.day').click(function(){
        jQuery('td.day').removeClass("select");
        jQuery(this).toggleClass("select");
    });
    jQuery('td.day').mouseover(function() {
      jQuery(this).addClass('hover');
    }).mouseout(function() {
      jQuery(this).removeClass('hover');
    });
  }
  jQuery('#left').click(function() {
    jQuery('#table_calendar').text('');
    if (currentDate.getMonth() === 0) {
      currentDate = new Date(currentDate.getFullYear() - 1, 11);
      generateCalendar(currentDate);
    } else {
      currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1)
      generateCalendar(currentDate);
    }
  });
  jQuery('#right').click(function() {
    jQuery('#table_calendar').html('');
    if (currentDate.getMonth() === 11) {
      currentDate = new Date(currentDate.getFullYear() + 1, 0);
      generateCalendar(currentDate);
    } else {
      currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1)
      generateCalendar(currentDate);
    }
  });
  generateCalendar(currentDate);
});
function get_date(a){
    get_pending_case_list(jQuery(a).attr("data-date"));
    jQuery("#hidden_selected_dt").val(jQuery(a).attr("data-date"));
}

</script>

<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>

<script>

function fileValidation(name){
            //alert(name);
            var fileInput = document.getElementById(name);
            var filePath = fileInput.value;
            var allowedExtensions = /(\.xlsx)$/i;
            var fileSize = document.getElementById(name).files[0].size;
            if(!allowedExtensions.exec(filePath)){
                alert('Only xls file is allowed');
                fileInput.value = '';
                return false;
            }
            return true;
        }

        // var options007 = { 
        //     complete: function(response) 
        //     {

        //     }  
        // }; 


        // jQuery("#xl_dynamic").ajaxForm();

        jQuery("#load_button").click(function() {
        if (jQuery("#recovery_file").val()=='') 
        {
            alert('Please Select A file');
            return false;
        }
        else
        {
            // jQuery("#load_button").hide();
            // jQuery("#recovery_loading").show();
            jQuery("#xl_dynamic").submit();
        }       
    });

</script>