<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to LMS</title>
	<noscript> JavaScript should be enable in your browser !!</noscript>
    <link rel="icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
	
    <link type="text/css" href="<?=base_url()?>home/get_file/xyzzzsdsbbbcsss" rel="stylesheet" />
    <link type="text/css" href="<?=base_url()?>home/get_file/xyzzzsdsbbbcssf" rel="stylesheet" />
    
    <link type="text/css" href="<?=base_url()?>css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />
    
	<script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsjq36"></script>
	<script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsjqvmin"></script>
    <script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsjquimin"></script>
  

   
		<style type="text/css">
            #pagination a, #pagination strong {
             	background:  #e3e3e3;
             	padding: 4px 7px;
             	text-decoration: none;
            	border: 1px solid #666666;
            	color: #292929;
            	font-size: 13px;
            }

            #pagination strong, #pagination a:hover {
             	font-weight: normal;
             	background:  #666666;
             	color:#FFFFFF;
            }
			.hoverrow:hover{
				background-color:#FFCCCC;
			}
            .ui-datepicker-close{
    display: none;
   }
   .ui-datepicker-current{
    background: #008F40!important;
    color: #fff!important;
   }
   .ui-datepicker-current:hover{
    border-color: #008F40!important;
   }
        </style>
		<script type="text/javascript" charset="utf-8">
            jQuery.datepicker._gotoTodayOriginal = jQuery.datepicker._gotoToday;
jQuery.datepicker._gotoToday = function(id) {
    // now, optionally, call the original handler, making sure
    //  you use .apply() so the context reference will be correct
    jQuery.datepicker._gotoTodayOriginal.apply(this, [id]);
    jQuery.datepicker._selectDate.apply(this, [id]);
    
    
};
			function datePicker (id){
				jQuery(document).ready(function() {
					jQuery('#'+id).datepicker({
							inline: true,
							changeMonth: true,
							changeYear: true,
							dateFormat: 'dd/mm/yy',
                            showButtonPanel: true
					});
				});

			}
        </script>
		<script language = "Javascript">

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

        var dtCh= "/";
        var minYear=2012;
        var maxYear=2100;

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
            for (i = 0; i < s.length; i++){
                var c = s.charAt(i);
                if (bag.indexOf(c) == -1) returnString += c;
            }
            return returnString;
        }

        function daysInFebruary (year){
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

        function isDate(dtStr){
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
             else if ((("0123456789,").indexOf(keychar) > -1))
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
        function checknumber_alphabatic(element_id){

                var field = document.getElementById(element_id);//alert(field.value);
                var alphaExp = /^[0-9a-zA-Z-]+$/;
                //var alphaExp = /^[0-9]+$/;
                if(field.value.match(alphaExp)){
                    return true;
                }
                else{
                    field.value="";
                    //field.focus();
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
        </script>


</head>