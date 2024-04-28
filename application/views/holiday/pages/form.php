<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>eDeal</title>

<script type="text/javascript" src="<?=base_url()?>holiday_asset/js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>holiday_asset/js/jquery-ui-1.11.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>holiday_asset/js/jquery-ui.multidatespicker.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>holiday_asset/css/mdp.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>holiday_asset/css/prettify.css">

<script type="text/javascript" src="<?=base_url()?>holiday_asset/js/prettify.js"></script>
<script type="text/javascript" src="<?=base_url()?>holiday_asset/js/lang-css.js"></script>
<script type="text/javascript">
	jQuery(function() {
		var today = new Date();
		var y = '<?=$Year?>';
		jQuery('#full-year').multiDatesPicker({
			addDates: ['<?=$Date?>'],
			numberOfMonths: [3,4],
			defaultDate: '1/1/'+y,
			dateFormat: 'dd/mm/yy',
			onSelect : function(dateText, inst){
				selDates = jQuery(this).multiDatesPicker('getDates');
				jQuery('#dates').val(selDates);
			}
		});
	});
	
	function load_calender(yearValue){
		 var url = "<?=base_url()?>holiday/from/edit/<?=$id?>/"+yearValue; // get selected value
		  if (url) { // require a URL
			  window.location = url; // redirect
		  }
		  return false;
	}
	function clear_selection()
	{
		jQuery('#dates').val('01/01/1900');
		jQuery('#full-year').multiDatesPicker('resetDates');
	}

	function checking_checkd(){
		if(jQuery('#dates').val() == '' || jQuery('#dates').val() == '01/01/1900'){
			alert('Select at least one date');
			return false;
		}else{
			return true;
		}
	}
	
	function OnclikValidation()
	{
		if(checking_checkd()==true)
		{
		var postdata = jQuery('#form').serialize(); 
		jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>holiday/add_edit_action/<?=$add_edit?>/<?=$id?>",
						data : postdata,
						datatype: "json",
						async:false,
						success: function(addresponse){ 
							var json = jQuery.parseJSON(addresponse); 
							jQuery('.txt_csrfname').val(json.csrf_token);
							if(json.Message!='OK')
							{
								alert(json.Message);
								return false
							}else{
								jQuery("#msgArea").val('');
								window.parent.jQuery("#error").show();
								window.parent.jQuery("#error").fadeOut(11500);
								window.parent.jQuery("#error").html('<img align="absmiddle" src="<?=base_url()?>images/drag.png" border="0" /> &nbsp;Successfully Saved');							
								window.top.EOL.messageBoard.close();
							}
						}
					});	
		}
	}
</script>
</head>
<body leftmargin="0" topmargin="0" class="small" marginheight="0" marginwidth="0" style="height:98%">

<style type="text/css">
        
       .text-input
        {
            height: 23px;
            width: 250px;
        }
        .register-table
        {
            margin-top: 10px;
            margin-bottom: 10px;
			margin:auto
        }
        .register-table td, 
        .register-table tr
        {
            border-spacing: 0px;
            border-collapse: collapse;
            font-family: Verdana;
            font-size: 12px;
        }
        h3 
        {
            display: inline-block;
            margin: 0px;
        }
       .form {
		   min-height:410px
        }
		.required
		{
			vertical-align: baseline;
			color: red;
			font-size: 10px;
		}
    </style>   
    
	

    <div  style=" width:100%; margin:auto">
       <form class="form" id="form" method="post" action="#" style="font-size: 13px; font-family: Verdana;">
       	<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	        <div>
                <h2 align="center">Holiday Setup</h2>
            </div>
            <table class="small" border="0" cellpadding="0" cellspacing="0" width="100%">
																			<tbody>
																				<tr>
																					<td colspan="4" style="padding: 5px;">
																						<div align="center">
																							
																							<input title="Update [Alt+S]" accesskey="S" class="crmbutton small save" onClick="this.form.action.value='Update'; return OnclikValidation();" name="button" value="  Save  " style="width: 70px;" type="button" tabindex="33" >
																							<input title="Cancel [Alt+X]" accesskey="X" class="crmbutton small cancel" onClick="window.top.EOL.messageBoard.close()" name="button" value="  Cancel  " style="width: 70px;" type="button" tabindex="34">
																						</div>
																					</td>
																				</tr>
																				<tr>
                                                                                	<td width="9%" class="detailedViewHeader">&nbsp;</td>
																					<td width="51%"  class="detailedViewHeader">
																						<strong>Country : <?=$cName?></strong>
																					</td>
                                                                                    <td width="21%" style="text-align:right" class="detailedViewHeader">
																						
																						<span >
																							<?php 
																								$years_drop = array();
																								$cur_year = date('Y');
																								for($i = 0; $i <= 10; $i++) {
																									$years_drop[$cur_year+$i] = $cur_year+$i;
																								}
																								if(!array_key_exists($Year, $years_drop)){
																									$years_drop[$Year] = $Year;
																								}
																								ksort($years_drop);
																							?>
																							Year : <?=form_dropdown('year', $years_drop, $Year, 'id = "year" style="width: 150px;" onChange="load_calender(this.value);" class="detailedViewTextBox" tabindex="1" onFocus="this.className=\'detailedViewTextBoxOn\'" onBlur="this.className=\'detailedViewTextBox\'"');?>
																						</span>
																					</td>
                                                                                   <td width="9%" class="detailedViewHeader">
                                                                                   &nbsp;&nbsp;&nbsp;<input type="button" value="Clear Selection" onclick="clear_selection()" />
                                                                                   </td>
																				</tr>
																				<tr>
																					<td class="dvtCellLabel" colspan="4" align="center" valign="top" style="padding-top:3px">
																						<div id="full-year" class="box"></div>
																						<input type="hidden" name="dates" id="dates" value="<?=$datevalue?>" />
																					</td>
																				</tr>
																				<tr>
																					<td colspan="4" style="padding: 5px;">
																						<div align="center">
																							<input title="Update [Alt+S]" accesskey="S" class="crmbutton small save" onClick="this.form.action.value='Update'; return OnclikValidation();" name="button" value="  Save  " style="width: 70px;" type="button" tabindex="35">
																							<input title="Cancel [Alt+X]" accesskey="X" class="crmbutton small cancel" onClick="window.top.EOL.messageBoard.close()" name="button" value="  Cancel  " style="width: 70px;" type="button" tabindex="36">
																						</div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
           
        </form>
       
    </div>
    
    </body>
    </html>
    