<?
	function getallrefforedit($i=NULL,$se=NULL)
	{
		$reftype1=new ref_model();
		$reftype=$reftype1->ref_model->referencefield();
		
		$str="<select name=\"refer$i\"  id=\"refer$i\" onchange=\"clearfield($i)\" style=\"width:90% !important;\" >";
		foreach($reftype as $row)
		{
			if($row->table_name==$se){$sef='selected="selected"';}else{$sef='';}
			$str.="<option value='".$row->table_name."' ".$sef." >".$row->ref_name."</option>";
		}
		$str.="</select>";
		return $str;
	}
		
	function getallreffieldedit($refid=NULL,$i=NULL,$selecfield=NULL)
	{
		$reftype2=new ref_model();
		
		$str="<select name=\"ref_value_field$i\"  id=\"ref_value_field$i\" >
		<option value='id'"; if($selecfield == 'id'){ $str.=" selected"; } $str.=">id</option>";
		
		$reftype1=$reftype2->ref_model->reference_list_field($refid);
		foreach($reftype1 as $row)
		{
			if($row->field_name==$selecfield){$sef='selected="selected"';}else{$sef='';}
			$str.="<option value='".$row->field_name."' ".$sef.">".$row->field_caption."</option>";
		}
		
		$str.="</select>";
		echo $str;
	}
	
	function getallreffield($refid=NULL,$i=NULL,$selecfield=NULL)
	{
		$reftype2=new ref_model();
		
		$str="<select name=\"ref_show_field$i\"  id=\"ref_show_field$i\" style=\"width:100%;\"  >";
		
		$reftype1=$reftype2->ref_model->reference_list_field($refid);
		foreach($reftype1 as $row)
		{
			if($row->field_name==$selecfield){$sef='selected="selected"';}else{$sef='';}
			$str.="<option value='".$row->field_name."' ".$sef.">".$row->field_caption."</option>";
		}
		
		$str.="</select>";
		echo $str;
	}

?>
<style type="text/css">
select{
	max-width: 100%;
}
td{
	text-align: center;
	border-color:#c0c0c0
}
th{
	text-align: center;
	border-color:#c0c0c0
}
 .addmore
	{
		background-image:url(<?=base_url()?>images/addmore_grn.png);
		/*background-size: 20px 20px;*/
		background-repeat: no-repeat;
		border:0;
		width:18px; height:18px;
		background-color:transparent;
		cursor:pointer;
	}
	.del
	{
		background-image:url(<?=base_url()?>images/del.png);
		background-repeat: no-repeat;
		border:0;
		width:18px; height:18px;
		background-color:transparent;
		cursor:pointer;
	}
</style>
<body style="height:98%">
<script language="javascript" type="text/javascript">
	var csrf_token='';
	jQuery(document).ready(function () {

		var theme = 'classic';
		jQuery("#add_from_others").jqxCheckBox({width: 22, theme: theme <?=$add_edit=='edit'?(($result['add_from_others_sts']=='1')?',checked:true':',checked:false'):',checked:false'?> });
		//jQuery("#add_from_others").jqxCheckBox({width: 22, theme: theme ,checked:false });
		jQuery("#add_from_others").bind('change', function (event) {
	        var checked = event.args.checked;
	        if(checked==true){ 
	            jQuery("#add_from_others_sts").val(1); 
	                       
	        }else{
	            jQuery("#add_from_others_sts").val(0); 
	    }
	    });
		jQuery("#sendButton").jqxButton({template:"default",width:"120"});
		jQuery('.text-input-small').addClass('jqx-input');
		jQuery('.text-input-small').addClass('jqx-rc-all');
		jQuery('.text-input-big').addClass('jqx-input');
		jQuery('.text-input-big').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input-small').addClass('jqx-input-' + theme);
			jQuery('.text-input-small').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input-small').addClass('jqx-rc-all-' + theme);
			jQuery('.text-input-big').addClass('jqx-input-' + theme);
			jQuery('.text-input-big').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input-big').addClass('jqx-rc-all-' + theme);
		}
		
		
		// initialize validator.
		jQuery('#form').jqxValidator({
			rules: [
				{ input: '#name', message: 'name is required!', action: 'keyup,blur', rule: 'required' },
				{ input: '#name', message: 'Invalid Reference Name!', action: 'keyup,blur', rule: function(input){
						 
						var str = jQuery.trim(input.val());
						if(str != '') 
						{
							var regx = /^[A-Za-z0-9 ]+$/;
							 if (!regx.test(str)) 
							 {
								return false;
							 }
							 return true;
						} 
						return true; 
					}
				},
				{ input: '#name', message: 'Duplicate Reference Name!', action: 'blur', rule: function (input, commit) {
					if(input.val()==''){
						commit(true);
						return true
					}
					else
					{
						var flag=0;
						var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
						var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
						jQuery.ajax({
							type: "POST",
							cache: false,
							url: "<?=base_url()?>index.php/ref/duplicate_reference/<?=$add_edit?>/<?=$id?>",
							data : {[csrfName]: csrfHash,val: input.val()},
							datatype: "json",
							success: function(response){
								var json = jQuery.parseJSON(response);
								jQuery('.txt_csrfname').val(json.csrf_token);
								if(json.Status=='ok')
								{
									commit(true);
									flag=0;
								}
								else{
									commit(false);
									var flag=1;
								}
							}
						});
						if(flag==1){ return false; }
						return true;
					}
				}
			}
			]
		});
		
		jQuery("#sendButton").bind('click',function () {			
			var validationResult = function (isValid) {
				if (isValid && onclickvalidation() != false) {
					call_ajax_submit();
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);
		});
		
		jQuery("#name").focus();
	});
	
	function alphaNumericOnly(element_id)
	{
		var field = document.getElementById(element_id);//alert(field.value);
		var alphaExp = /^[0-9A-Za-z ]+$/;
		if(field.value !='')
		{
			if(field.value.match(alphaExp)){
				return true;
			}
			else
			{
				alert("Alpha Numeric only!!");
				setTimeout(function(){jQuery("#"+element_id).focus();}, 0);	
				field.value="";
				return false;
			}
		}
		else { return true; }
		
	}

	
	function call_ajax_submit()
	{
		jQuery("#sendButton").hide();
		jQuery("#loading").show();

		var postdata = jQuery('#form').serialize();

		jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?=base_url()?>index.php/ref/add_edit_action/<?=$add_edit?>/<?=$id?>",
				data : postdata,
				datatype: "json",
				success: function(addresponse){
					var json = jQuery.parseJSON(addresponse);
					window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
					jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.Message!='OK')
					{
						jQuery("#sendButton").show();
						jQuery("#loading").hide();
						alert(json.Message);
						return false
					}else{
						if(json.row_info != '')
						{
							var row = {};
							row["id"] = json['row_info'].id;
							row["reference_name"] = json['row_info'].reference_name;
							row["reference_remarks"] = json['row_info'].reference_remarks;
							row["data_status"] = json['row_info'].data_status;

							window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
							jQuery("#loading").hide();

							<? if($add_edit =='add'){?>
							var paginginformation = window.parent.jQuery("#jqxgrid").jqxGrid('getpaginginformation');
							var insert_index=paginginformation.pagenum*paginginformation.pagesize;
							var commit = window.parent.jQuery("#jqxgrid").jqxGrid('addrow', null, row,insert_index);
							window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', insert_index);
							
							<? }else{?>
							jQuery.each(row, function(key,val){
								window.parent.jQuery("#jqxgrid").jqxGrid('setcellvalue', <?=$editrow?>, key, row[key]);
							});
							window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?=$editrow?>);

							<? }?>

							window.parent.jQuery("#error").show();
							window.parent.jQuery("#error").fadeOut(11500);
							window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
							window.top.EOL.messageBoard.close();
							
						}
						else
						{
							window.parent.jQuery("#error").show();
							window.parent.jQuery("#error").fadeOut(11500);
							window.parent.jQuery("#error").css("color", "red");
							window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/invalid_icon.png" border="0" /> &nbsp;Sorry, could not saved successfully');
							window.top.EOL.messageBoard.close();
						}
					}
				}
			});
	}

   function addmore()
   {

	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
	var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
						
				
	  <?php if($add_edit == 'add'){ ?>

	    var counter =jQuery('#counter').val();

	    jQuery.ajax({
				type: "POST",
				cache: false,
				async: false,
				url: "<?=base_url()?>index.php/ref/addmore/"+counter,
				data : {[csrfName]: csrfHash,},
				datatype: "html",
				success: function(response){
					
						var fields = response.split(':::');

						var table = fields[0];
						jQuery('.txt_csrfname').val(fields[1]);
						jQuery('#tr'+counter).after(table);
					   c=parseInt(counter)+1;
					   jQuery('#counter').val(c);
					
				}
			});
	   
		 
	  <?php
	   }
	   else{
	  ?>
		var counter =jQuery('#counter').val();
		jQuery.ajax({
				type: "POST",
				cache: false,
				async: false,
				url: "<?=base_url()?>index.php/ref/editaddmore/"+counter+"/<?=$id?>",
				data : {[csrfName]: csrfHash},
				datatype: "html",
				success: function(response){
					
						var fields = response.split(':::');

						var table = fields[0];
						 var csrf_tokena = fields[1];
						jQuery('.txt_csrfname').val(fields[1]);
						jQuery('#tr'+counter).after(table);
					   c=parseInt(counter)+1;
					   jQuery('#counter').val(c);
					
				}
			});
	   
		
	 <?php }?>
	}

	function changlength(i)
	{
	 	if(jQuery('#fieldtype'+i+' option:selected ').text()!='VARCHAR' && jQuery('#fieldtype'+i+' option:selected ').text()!='NUMBER') {
		 //alert(jQuery(this).text())
		 	jQuery('#length'+i).attr("disabled","disabled");
		 } else {
		 	jQuery('#length'+i).removeAttr("disabled");
			//alert('pp');
		 }
	}	
	function checkselect(i)
    {
	    if(jQuery('#inputtype'+i+' option:selected ').val()==2 || jQuery('#inputtype'+i+' option:selected ').val()==5) 
		{
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			jQuery.ajax({
				type: "POST",
				cache: false,
				async: false,
				url: "<?=base_url()?>index.php/ref/getallref/"+i,
				data : {[csrfName]: csrfHash},
				datatype: "html",
				success: function(response){
					
						var fields = response.split(':::');

						var table = fields[0];
						jQuery('.txt_csrfname').val(fields[1]);
						
					   jQuery('#refid'+i).html(table);
					
				}
			});

		 	
	    }
		else
		{
			jQuery('#refid'+i).html("");
			jQuery('#ref_value'+i).html("");
			jQuery('#ref_show'+i).html("");
		}

	}

	function clearfield(i)
    {
	    if(jQuery('#inputtype'+i+' option:selected ').text()!='Select') 
		{
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash

			jQuery.ajax({
							type: "POST",
							cache: false,
							async: false,
							url: "<?=base_url()?>index.php/ref/getallreffield/"+jQuery('#refer'+i).val()+"/"+i,
							data : {[csrfName]: csrfHash},
							datatype: "json",
							success: function(response){
								
									var json = jQuery.parseJSON(response);
									jQuery('.txt_csrfname').val(json.csrf_token);
									jQuery('#ref_value'+i).html(json.ref_value);
		   							 jQuery('#ref_show'+i).html(json.ref_show);
								
							}
						});
		 	
	     }
		else
		{
			jQuery('#refsortid'+i).html("");
		}
	}

	function deleterow(i)
	{
	    <?php if($add_edit == 'add'){ ?>
		jQuery('#tr'+i).css('display','none');
		jQuery('#delete'+i).val(1);
	   <?php }else{ ?>
		var editab =jQuery('#edittem'+i).val();
		if(editab==1)
		{
			var rowids =jQuery('#dropta'+i).val();
			var rownames =jQuery('#editfield'+i).val();
			
			if(confirm('This field will be droped from table and all the data will be lost.\nAre you sure want to delete?'))
				{
					var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
					var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
					jQuery.ajax({
						type: "POST",
						cache: false,
						async: false,
						url: "<?=base_url()?>index.php/ref/dropfield/<?=$id?>/"+rowids+"/"+rownames,
						data : {[csrfName]: csrfHash},
						datatype: "html",
						success: function(response){
							var json = jQuery.parseJSON(response);
								jQuery('.txt_csrfname').val(json.csrf_token);
						}
					});
					
					jQuery('#tr'+i).css('display','none');
					jQuery('#delete'+i).val(1);
				}
				else
				{
					return false;
				}
		}
		else{
			jQuery('#tr'+i).css('display','none');
			jQuery('#delete'+i).val(1);
		}
	<?php }?>
	  }
	  
	 function numbersonly(e)
	 {
		var unicode=e.charCode? e.charCode : e.keyCode
		if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
		if (unicode<48||unicode>57) //if not a number
		return false //disable key press
						}
	 }
	 
	function checkDuplicateFieldName(fname,refid,counter)
	{
		if(fname != '')
		{

			jQuery.post('<?=base_url()?>index.php/ref/checkDuplicateFieldName/'+fname+'/'+refid,function(data){
			if(data > 0)
				{
					alert('Duplicate Field name not allowed!!');
					jQuery('#inputcaption'+counter).val('');
					jQuery('#inputcaption'+counter).focus();
				}
			});
		}
	}

    function onclickvalidation()
	{
		 
		 //alert(jQuery('#counter').val());
		 if(jQuery('#name').val()==""){
			alert('Parameter name is required!');
			jQuery('#name').focus();
			return false;
		 }
		  for(i=1;i<=jQuery('#counter').val();i++)
		  {
				if(jQuery('#delete'+i).val()==0) {
	
				  if(jQuery.trim(jQuery('#inputcaption'+i).val())==''){
					alert('Please Enter Input Caption Name');
					jQuery('#inputcaption'+i).focus();
					return false
				  }
				 if(jQuery('#fieldtype'+i).val()=='0'){
					alert('Please Select Field Type');
					jQuery('#fieldtype'+i).select();
					return false
				 }
				 if(jQuery('#fieldtype'+i+' option:selected ').text()=='VARCHAR2' ||  jQuery('#fieldtype'+i+' option:selected ').text()=='NUMBER')
					 {
						if(jQuery('#length'+i).val()=='') {
							alert('Please Enter Length');
							jQuery('#length'+i).focus();
							return false;
						}
					 }
				 if(jQuery('#inputtype'+i).val()=='0'){
					alert('Please Select Input Type');
					jQuery('#inputtype'+i).select();
					return false;
				 }
				 if(jQuery('#inputtype'+i).val()=='2') {
					if(jQuery('#refer'+i).val()=='0'){
						alert('Please Select Reference Name');
						jQuery('#refer'+i).select();
						return false;
					} else {
							if(jQuery('#ref_value_field'+i).val()=='0'){
								alert('Please Select Ref. Value');
								jQuery('#ref_value_field'+i).select();
								return false;
							}
							if(jQuery('#ref_show_field'+i).val()=='0'){
								alert('Please Select Display Name');
								jQuery('#ref_show_field'+i).select();
								return false;
							}
					}
				 }
	
				  for(j=i+1;j<=jQuery('#counter').val();j++)
				  {
					  if(jQuery('#delete'+j).val()==0)
					  {
					  		var keystring = jQuery.trim(jQuery('#inputcaption'+i).val());
							keystring = keystring.toLowerCase();
							var searchstring = jQuery.trim(jQuery('#inputcaption'+j).val());
							searchstring = searchstring.toLowerCase();
							
							   if((keystring==searchstring) && searchstring!='')
							   {
								   alert("Duplicate Input Caption Name!!");
								   jQuery('#inputcaption'+j).focus();
								   return false;
							}
	
						}
	
				  }
				}
			 }
			return true;
	  }
	  
		var cdrMessageDialog;
		function initCdrMessageDialog() {
			// Define various event handlers for Dialog
			var handleCancel = function() {
				this.hide();
			};
		 	var handleCdrMessageSuccess = function(req) {
			var response = eval('(' + req + ')');
			//alert(response.errorMsgs+eval('(' + req + ')')+req)
			if( response.status == 'success') {
				cdrMessageDialog.hide();
				//reload results
				reloadCurrentMessages();
				/*jQuery("#msgArea").val('');
				window.parent.jQuery("#error").show();
				window.parent.jQuery("#error").fadeOut(11500);
				window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
				window.top.EOL.messageBoard.close();*/

			} else {
				$('cdrMessageErrorMsg').innerHTML = response.errorMsgs;
				$('cdrMessageErrorMsg').style.display = '';
				/*jQuery("#msgArea").val('');
				window.parent.jQuery("#error").show();
				window.parent.jQuery("#error").fadeOut(11500);
				window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;'+response.errorMsgs);
				window.top.EOL.messageBoard.close();*/
			}
		  };
		  var handleCdrMessageFailure = function(o) {
				showInfoDialog( 'cdrMessagefailuretitle', 'cdrMessagefailurebody', 'WARN' );
		  };

		  var handleSubmit = function() {

			window.location.reload();
			jQuery("#sendButton").show();
			jQuery("#loading").hide();

			$('cdrMessageDialogConfirm').style.display = 'none';
			$('cdrMessageDialogCancel').style.display = 'none';
			$('loading').style.display = '';

		  };
		  var handleSubmit_go_right_page = function() {

		  	window.parent.jQuery("#error").show();
			window.parent.jQuery("#error").fadeOut(11500);
			window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
			window.top.EOL.messageBoard.close();

		  };

			cdrMessageDialog = new EOL.dialog($('cdrMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'cdrMessageDialog' });

			cdrMessageDialog.afterShow = function() {
				$$('#cdrMessageDialog #cdrMessageDialogConfirm').addEvent('click',handleSubmit);
				$$('#cdrMessageDialog #cdrMessageDialogCancel').addEvent('click',handleSubmit_go_right_page);
			};


			cdrMessageDialog.show();
		}


		function messege_add_new()
		{
			if (!cdrMessageDialog) {
				initCdrMessageDialog();
			}
			cdrMessageDialog.show();
		}
		function reloadCurrentMessages()
		{
			window.location.reload();
		}
</script>
	<div  style=" width:100%; margin:auto">
        <form id="form" class="form" method="post" action="#">
        	<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input type="hidden" id="add_from_others_sts" value="" name="add_from_others_sts" value="0">
			<div class="formHeader" style="background-color:#185891;"><?php if($add_edit=="edit") echo "Edit Reference"; else echo "New Reference"; ?></div>
		    <br/>
			<table>
				<tr>
					<td>Reference Name <span style="color:red">*</span></td>
					<td><input name="name" type="text" class="text-input-big" id="name" value="<?=isset($result['reference_name'])?$result['reference_name']:''?>"/></td>
				</tr>
				<tr>
					<td>Add From Other's</td>
					<td><div name="add_from_others" id="add_from_others" style="float:left; margin: 3px 0px 0 0;"></div></td>
				</tr>
				<tr>
					<td>Remarks</td>
					<td><textarea name="ref_remarks" class="text-input-big" id="ref_remarks" style="height:35px !important"><?=isset($result['reference_remarks'])?$result['reference_remarks']:''?></textarea></td>
				</tr>
			</table>

			<table border="1" cellspacing="0" cellpadding="5" class="register-table" style="border-collapse: collapse;border-color:#c0c0c0">
			<thead>
				<tr>
					<th width="3%">D</th>
					<th width="14%">Caption</th>
					<th width="8%">Data Type</th>
					<th width="6%">Length</th>
					<th width="10%">Input Type</th>
					<th width="19%">Reference Name</th>
					<th width="10%">Ref. Value</th>
					<th width="10%">Display Name</th>
					<th width="5%">Mandatory</th>
					<th width="5%">Unique</th>
					<th width="4%">Order</th>
					<th width="6%">Alignment</th>
				</tr>
			</thead>
			<tbody>
			<?php
			if($add_edit == 'add')
			{
			?>
            	<tr id="tr1"  style="height:25px;">
					<td style="width:20px;">&nbsp;</td>
					<td align="left"><input type="text" name="inputcaption1" id="inputcaption1"  style="width:70px;" value="Name" readonly="" onBlur="alphaNumericOnly('inputcaption1')" />
					</td>
					<td width="10%"  align="left"><?=form_dropdown('fieldtype1',$fieldtype,0,'id="fieldtype1" onchange="changlength(1)" style="width:80px" ');?>
					</td>
					<td align="center"><input type="text" name="length1" id="length1" value="" style="width:25px;" disabled="disabled"  maxlength="4" title="For decimal type 20,4 for datetime No need to type" />
					</td>
					<td width="10%"  align="left"><?=form_dropdown('inputtype1',$inputtype,0,'id="inputtype1" onchange="checkselect(1)" style="width:90px" ');?>
					</td>
					<td width="10%"><span id="refid1"></span></td>
					<td width="10%"><span id="ref_value1"></span> </td>
					<td width="10%"><span id="ref_show1"></span> </td>
					<td align="center"><input type="checkbox" id="mandatory1" name="mandatory1" />  </td>
					<td align="center"><input type="checkbox" name="Unique1" id="Unique1"  /></td>
					<td align="right"><input type="text" name="inputorder1" id="inputorder1"  style="width:20px"  onkeypress="return numbersonly(event)" value="" maxlength="3" /></td>
               		<td align="center"><?=form_dropdown('align1',$align,'Left','id="align1"  style="width:60px" ');?></td>
				</tr><input type="hidden" name="delete1" id="delete1" value="0" />
			  		<input type="hidden" name="counter" id="counter" value="1" />
		<?php
			}
			else if($add_edit == 'edit')
			{			 
			  $cot=1;
			  //$count_edit = count($result_fields);
			  foreach($result_fields as $roy)
			  {
  			?>
			<tr id="tr<?=$cot?>"  style="height:25px;">
				<td align="left">
					<input type="hidden" name="delete<?=$cot?>" id="delete<?=$cot?>" value="0" />
					<input type="hidden" name="edittem<?=$cot?>" id="edittem<?=$cot?>" value="1" />
					<input type="hidden" name="editfield<?=$cot?>" id="editfield<?=$cot?>" value="<?=$roy->reference_field_name?>" />
					<input type="hidden" name="dropta<?=$cot?>" id="dropta<?=$cot?>" value="<?=$roy->id?>" />
				</td>
				<td align="left">
				<input type="text" name="inputcaption<?=$cot?>" id="inputcaption<?=$cot?>"  value="<?=$roy->reference_field_caption?>" style="width:90%"/>
				</td>
				<td align="left"><?=$roy->iname?></td>
				<td align="center"><input type="text" name="length<?=$cot?>" id="length<?=$cot?>"  value="<?=$roy->reference_input_length?>"  style="width:20px"  readonly />
				</td>
				<td width="10%" align="left"><?=$roy->fname?></td>
				<td width="10%"><span id="refid<?=$cot?>"><?=$roy->reftab?></span>
				</td>
				<td width="10%"><span id="ref_value<?=$cot?>"><?=$roy->reference_list_value_field_nam?></span> </td>
				<td width="10%"><span id="ref_show<?=$cot?>"><?=$roy->reference_list_show_field_name?></span></td>
				<td align="center"><?php if($roy->reference_mandatory_status==1){echo 'Mandatory';}?></td>
				<td align="center"><?php if($roy->reference_unique_status==1){echo 'Unique';}?></td>
				<td align="right">
				<input type="text" name="inputorder<?=$cot?>" id="inputorder<?=$cot?>" style="width:20px"  onkeypress="return numbersonly(event)" value="<?=$roy->sort_order?>" maxlength="3" />
				</td>
			  	<td align="center"><?=form_dropdown('align'.$cot,$align,$roy->reference_alignment,'id="align'.$cot.'"');?></td>
			</tr>
		  <?php
		  $cot++;
		  }
		  ?>
			<input type="hidden" name="counter" id="counter" value="<?=$cot-1?>" />
 <?php } 
 		?>
 		</tbody>
        <tfoot>
			<tr>
				<td colspan="12" style="text-align:right">
					<input class="addmore" name="button" type="button" onClick="addmore()" id="addmoreButton" /><br>
				</td>
			</tr>
	  </tfoot>
	</table>
	<center>
	   <br><input type="button" value="Save" id="sendButton" class="buttonStyle" />
		<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
	</center>
	</form>
    </div>
	
    <div id="cdrMessageDialogContent"  style="display:none">
		<div class="hd"><h2 class="conf">Data Successfully Inserted, Do you want to give entry again?</h2></div>
		<div class="bd">
		  <div class="inlineError" id="cdrMessageErrorMsg" style="display:none"></div>
		</div>
		<a class="btn-small btn-small-normal" id="cdrMessageDialogConfirm"><span>Yes</span></a>
		<a class="btn-small btn-small-secondary" id="cdrMessageDialogCancel"><span>No</span></a>
		<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
	</div>