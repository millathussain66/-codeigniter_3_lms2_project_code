<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<link rel="icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<noscript> 	JavaScript should be enable in your browser !!</noscript>
<title>Litigation Management System</title>
<link rel="shortcut icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<link rel="icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">


<link rel="stylesheet" href="<?=base_url()?>home/get_file/logoutzxzxbjsbase" type="text/css" />
	
	
	<script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsjq36"></script>
	
	
	
    <script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjscore"></script>
	
    <script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsval"></script>
    <script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsbut"></script>

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
</head>
<body>
