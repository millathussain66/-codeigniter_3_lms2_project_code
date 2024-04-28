<title>Deal Details</title>
<script type="text/javascript" src="<?=base_url()?>scripts/jquery-1.10.1.min.js"></script>
<body>
<script type="text/javascript">
	jQuery().ready(function() {
			jQuery("#form").submit( function() {
					if(jQuery("#diduction_amount").val()=='')
					{
						alert('Diduction Amount Required');
						return false;
					}
					else if(jQuery("#diduction_remarks").val()=='')
					{
						alert('Diduction Remarks Required');
						return false;
					}
					else if (isNaN(jQuery("#diduction_amount").val())) {
							alert('Please insert only numeric value');
							return false;
						}
						else if(parseInt(jQuery("#diduction_amount").val())>parseInt(jQuery("#amount").val()))
						{
							alert('Diduction Amount Bigger Then Amount');
							return false;
						}
						else if(parseInt(jQuery("#diduction_amount").val())<0)
						{
							alert('Provide Valid Diduction Amount');
							return false;
						}
					$.ajax({
						      url: $('#form').attr('action'),
						      type: 'POST',
						      data : $('#form').serialize(),
						      success: function(){
						        alert("Sucessfully save");
						        window.close();
						        window.opener.location.reload(); 
						      }
    						});
						return false;

						});
				
	});
</script>
<!-- main wrap start -->
<div id="body_wrap">
 <table border="1" id="blotterTab" style="width:100%; background-color:#e8e8e8;border-collapse:collapse">
 	<tr><td colspan="2" align="center" style="color:#009900"><strong>Details Information</strong></td></tr>
	<form method="post" id="form" action="<?=base_url()?>bill_ho/update_bill/">
	<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	<input type="hidden" name="id" id="id" value="<?=$result->id;?>">
	<input type="hidden" name="amount" id="amount" value="<?=$result->amount;?>">
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Account  Number</strong></td> 
			<td width="66%"><?=$result->loan_ac?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Account Name</strong></td> 
			<td width="66%"><?=$result->ac_name?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Date</strong></td> 
			<td width="66%"><?=$result->txrn_dt?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>3 Type Of Case</strong></td> 
			<td width="66%"><?=$result->req_type?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Case Number</strong></td> 
			<td width="66%"><?=$result->case_number?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Court Name</strong></td> 
			<td width="66%"><?=$result->court_name?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Employee PIN</strong></td> 
			<td width="66%"><?=$result->vendor_pin?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Employee Name</strong></td> 
			<td width="66%"><?=$result->vendor_name?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>District</strong></td> 
			<td width="66%"><?=$result->district?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Region</strong></td> 
			<td width="66%"><?=$result->legal_region?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Bill  Purpose</strong></td> 
			<td width="66%"><?=$result->remarks?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Bill Amount </strong></td> 
			<td width="66%"><?=$result->amount?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Deduction Amount</strong></td> 
			<td width="66%"><input name="diduction_amount" onblur="" tabindex="0" type="text" class="" style="width:225px" id="diduction_amount" value="" /></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Bill Month</strong></td> 
			<td width="66%"><?=$result->billing_month?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Particular Activities </strong></td> 
			<td width="66%"><?=$result->activities_name?></td>
	</tr>
	<tr>                        
      <td width="34%" align="left" valign="middle" ><strong>Remarks</strong></td> 
			<td width="66%"><textarea name="diduction_remarks" tabindex="9" class="text-input-big" id="diduction_remarks" style="height:40px !important;width:250px"></textarea></td>
	</tr>
	<tr>              
			<td valign="middle" colspan="2" style="text-align: center;"><input type="submit" value="Update"></td>
	</tr>
	</form>
 </table>
</div>
</body>