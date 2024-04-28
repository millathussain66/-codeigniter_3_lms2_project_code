<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
<body style="height:96%">
<style type="text/css">
	.ms-parent{ width: 320px !important;}
	.text-input-big{
		height: 23px !important;
	}
	#sendButton{
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
		cursor: pointer
	}
</style>
<?php //print_r($cma_mortgage); ?>
<script>
    jQuery(document).ready(function () {
    	var theme = getDemoTheme();
        var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var thana = [];
        var regoffice = [];
        var mouza = [];
        var typedeed = [<? $i=1; foreach($typedeed as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        
        // Create a jqxComboBox
    
        jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 250, height: 25});
        jQuery("#unitoffice").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Unit Office", source: regoffice, width: 250, height: 25});
        jQuery("#thana").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Thana", source: thana, width: 250, height: 25});
        jQuery("#mouza").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Mouza", source: mouza, width: 250, height: 25});
        jQuery("#typeofdeed").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Type of Deed", source: typedeed, width: 250, height: 25});

        jQuery('#unitoffice,#district,#mouza,#typeofdeed,#thana').focusout(function() {

            commbobox_check(jQuery(this).attr('id'));
        });

        <? if($add_edit=='edit'){ ?>
        	jQuery("#district").jqxComboBox('val', '<?=isset($results[0]->district)?$results[0]->district:''?>');
        	change_dropdown('district',<?=(isset($results[0]->sub_reg_office) && $results[0]->sub_reg_office!=0)?$results[0]->sub_reg_office:''?>,<?=(isset($results[0]->thana) && $results[0]->thana!=0)?$results[0]->thana:''?>,<?=(isset($results[0]->mouza) && $results[0]->mouza!=0)?$results[0]->mouza:''?>);
        	jQuery("#typeofdeed").jqxComboBox('val', '<?=isset($results[0]->deed_type)?$results[0]->deed_type:''?>');
        	
        <? } ?>
        jQuery("#in_req_button").click(function () {
        	var validationResult = function (isValid) {
				if (isValid ) {
					call_ajax_submit();
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);
   		 });
        jQuery('#district').bind('change', function (event) {
			change_dropdown('district');		
		});
        jQuery('#form').jqxValidator({
			rules: [
				{ input: '#deednumber', message: 'required!', action: 'blur,change', rule: function (input) {		if(jQuery("#deednumber").val()==''){
							jQuery("#deednumber").focus();
							return false;
						}else{
							return true;
						}
					}  
				},
				/*{ input: '#regdate', message: 'required!', action: 'blur,change', rule: function (input) {			
					if(jQuery("#regdate").val()==''){
							jQuery("#regdate").focus();
							return false;
						}else{
							return true;
						}
					}  
				},
				{ input: '#typeofdeed', message: 'required!', action: 'blur,change', rule: function (input) {		if(input.val() != ''){
						var item = jQuery("#typeofdeed").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='typeofdeed']").val(item.value);}
						return true;				
					}else{
						jQuery("#typeofdeed input").focus();
						return false;
					}
					}  
				},
				{ input: '#district', message: 'required!', action: 'blur,change', rule: function (input) {			
					if(input.val() != ''){
						var item = jQuery("#district").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='district']").val(item.value);}
						return true;				
					}else{
						jQuery("#district input").focus();
						return false;
					}
					}  
				},
				{ input: '#thana', message: 'required!', action: 'blur,change', rule: function (input) {			
					if(input.val() != ''){
						var item = jQuery("#thana").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='thana']").val(item.value);}
						return true;				
					}else{
						jQuery("#thana input").focus();
						return false;
					}
					}  
				},
				{ input: '#unitoffice', message: 'required!', action: 'blur,change', rule: function (input) {		if(input.val() != ''){
						var item = jQuery("#unitoffice").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='unitoffice']").val(item.value);}
						return true;				
					}else{
						jQuery("#unitoffice input").focus();
						return false;
					}
					}  
				},
				{ input: '#mouza', message: 'required!', action: 'blur,change', rule: function (input) {			
					if(input.val() != ''){
						var item = jQuery("#mouza").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='mouza']").val(item.value);}
						return true;				
					}else{
						jQuery("#mouza input").focus();
						return false;
					}
					}  
				},
				{ input: '#landarea', message: 'required!', action: 'blur,change', rule: function (input) {			
					if(jQuery("#landarea").val()==''){
							jQuery("#landarea").focus();
							return false;
						}else{
							return true;
						}
					}  
				},*/
			
			]
		});

    });

	function change_dropdown(operation,unitoffice_id=null,thana_id=null,mouza_id=null)
	{
		var id='';
		//check for add Region action
		id = jQuery("#"+operation).val();
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
        url: '<?php echo base_url(); ?>index.php/auction/get_dropdown_data',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,id : id,operation:operation},
        datatype: "json",
        success: function(response){
        	var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
					var str='';
					var theme = getDemoTheme();
					//alert('str');
					var unitoffice = [];
					jQuery.each(json['r_office'],function(key,obj){
						unitoffice.push({ value: obj.id, label: obj.name });
						//alert(obj.name);
					});
					jQuery("#unitoffice").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Unit Office", source: unitoffice, width: 250, height: 25});
					
					var thana = [];
					jQuery.each(json['thana'],function(key,obj){
						thana.push({ value: obj.id, label: obj.name });
						//alert(obj.name);
					});
					jQuery("#thana").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Thana", source: thana, width: 250, height: 25});

					var mouza = [];
					jQuery.each(json['mouza'],function(key,obj){
						mouza.push({ value: obj.id, label: obj.name });
						//alert(obj.name);
					});
					jQuery("#mouza").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Mouza", source: mouza, width: 250, height: 25});
					//For edit action
					if (unitoffice_id!=null) 
					{
						jQuery("#unitoffice").jqxComboBox('val', unitoffice_id);
					}
					if (thana_id!=null) 
					{
						jQuery("#thana").jqxComboBox('val', thana_id);
					}
					if (mouza_id!=null) 
					{
						jQuery("#mouza").jqxComboBox('val', mouza_id);
					}

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        	});

			return false;
	}
    function call_ajax_submit(){
    	jQuery("#in_req_button").hide();
		jQuery("#loading").show();
		
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postdata = jQuery('#form').serialize()+"&"+csrfName+"="+csrfHash;
			jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>auction/security_add_edit/<?=$add_edit?>/<?=$edit_id?>",
			data : postdata,
			datatype: "json",
			success: function(response){
			var json = jQuery.parseJSON(response);
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				if(json.Message!='OK')
				{
					jQuery("#in_req_button").show();
					jQuery("#loading").hide();
					alert(json.Message);
					return false;
				}
				else
				{
					jQuery("#in_req_button").show();
					jQuery("#loading").hide();
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');							
					window.parent.location = "<?=base_url()?>index.php/auction/from/<?=$add_edit?>/<?=$id?>/<?=$cma_id?>";
					window.parent.EOL.messageBoard.close();
				}
			}
		});
		
		
	}
</script>
 

    <div  style=" width:100%; margin:auto">
    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
       <form class="form" id="form" method="post" action="" enctype="multipart/form-data">
            <div class="formHeader" style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white"><?php echo $add_edit=='add'?'Add New Security':'Edit Security'; ?></div>
            <input type="hidden" name="cma_id" id="cma_id" value="<?php echo $cma_id; ?>" />
            <input type="hidden" name="mortgage_id" id="mortgage_id" value="<?php echo $mortgage_id; ?>" />
            <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>" />
            <table class="register-table" width="100%">
            	<tr>
            		<td width="50%">
            			<table style="width: 100%;">
            				<tr>
            					<td width="40%"><strong>Title deed number</strong> <span style="color:#FF0000">*</span></td>
								<td width="60%"><input name="deednumber" tabindex="1" style="width:250px" type="text" id="deednumber" maxlength="200" value="<?= isset($results[0])?$results[0]->title_deed_number:'' ?>"  class="text-input-big" style="text-transform:capitalize" /></td>
            				</tr>
            				<tr>
            					<td><strong>Date of registration</strong> </td>
								<td><input type="text" tabindex="2" name="regdate" style="width:250px"  placeholder="dd/mm/yyyy" style="width:317px;" id="regdate" value="<?=isset($results[0])?date_format(date_create($results[0]->reg_date),"d/m/Y"):''?>" ><script type="text/javascript" charset="utf-8">datePicker ("regdate");</script></td>
            				</tr>
            				<tr>
            					<td><strong>Type of Deed </strong> </td>
								<td><div id="typeofdeed" tabindex="3" name="typeofdeed" style="padding-left: 3px"></div></td>
            				</tr>
            				<tr>
            					<td><strong>District</strong> </td>
								<td><div id="district" tabindex="4" name="district" style="padding-left: 3px"></div></td>
            				</tr>
            				<tr>
            					<td><strong>Thana</strong></td>
								<td><div id="thana" name="thana" tabindex="5"  style="padding-left: 3px"></div></td>
            				</tr>
            				<tr>
            					<td><strong>Sub-registry Office </strong></td>
								<td><div id="unitoffice" tabindex="6" name="unitoffice" style="padding-left: 3px"></div></td>
            				</tr>
            				<tr>
            					<td><strong>Mouza</strong></td>
								<td><div id="mouza" name="mouza" tabindex="7" style="padding-left: 3px"></div></td>
            				</tr>
            				<tr>
            					<td><strong>Land Area </strong> </td>
								<td> <input name="landarea" tabindex="8" type="text" style="width:250px" id="landarea" value="<?= isset($results[0])?$results[0]->land_area:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>Plot Number</strong></td>
                    			<td><input name="plotnumber" tabindex="9" type="text" style="width:250px" id="plotnumber" value="<?= isset($results[0])?$results[0]->plot_number:'' ?>" class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>Holding number</strong> <span style="color:#FF0000"></span></td>
								<td> <input name="holdingnum" tabindex="10" type="text" style="width:250px" id="holdingnum" value="<?= isset($results[0])?$results[0]->holding_number:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>Jote  No.</strong></td>
                    			<td><input name="joteno" tabindex="11" type="text" style="width:250px" id="joteno" value="<?= isset($results[0])?$results[0]->jote_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>CS Khatian no.</strong></td>
                    			<td><input name="cskhatianno" tabindex="12" type="text" style="width:250px" id="cskhatianno" value="<?= isset($results[0])?$results[0]->cs_khatian_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            			</table>
            		</td>
            		<td width="50%">
            			<table style="width: 100%;">
            				<tr>
            					 <td><strong>SA/PS Khatian no.</strong></td>
                   				 <td><input name="sakhatianno" tabindex="13" type="text" style="width:250px" id="sakhatianno" value="<?= isset($results[0])?$results[0]->sa_khatian_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>RS /MRR Khatian no.</strong></td>
                    			<td><input name="rskhatianno" tabindex="14" type="text" style="width:250px" id="rskhatianno" value="<?= isset($results[0])?$results[0]->rs_khatian_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>BS/DP/ROR Khatian no.</strong></td>
                    			<td><input name="bskhatianno" tabindex="15" type="text" style="width:250px" id="bskhatianno" value="<?= isset($results[0])?$results[0]->bs_dp_khatian_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>City Jorip Khatian no.</strong></td>
                   				<td><input name="cityjoripkhatianno" tabindex="16" type="text" style="width:250px" id="cityjoripkhatianno" value="<?= isset($results[0])?$results[0]->city_jorip_khatian_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>Mutation Khatian no.</strong></td>
                   				<td><input name="mutationkhatianno" tabindex="17" type="text" style="width:250px" id="mutationkhatianno" value="<?= isset($results[0])?$results[0]->mutation_khatian_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>CS Dag no.</strong></td>
                    			<td><input name="csdagno" type="text" tabindex="18" style="width:250px" id="csdagno" value="<?= isset($results[0])?$results[0]->cs_dag_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>SA Dag no.</strong></td>
                    			<td><input name="sadagno" type="text" tabindex="19" style="width:250px" id="sadagno" value="<?= isset($results[0])?$results[0]->sa_dag_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					 <td><strong>RS Dag no.</strong></td>
		                    	<td><input name="rsdagno" type="text" tabindex="20" style="width:250px" id="rsdagno" value="<?= isset($results[0])?$results[0]->rs_dag_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>BS/DP Dag no.</strong></td>
		                    	<td><input name="bsdagno" type="text" tabindex="21" style="width:250px" id="bsdagno" value="<?= isset($results[0])?$results[0]->bs_dp_dag_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            				<tr>
            					<td><strong>City Jorip Dag no.</strong></td>
                   				<td><input name="cityjoripdagno" tabindex="22" type="text" style="width:250px" id="cityjoripdagno" value="<?= isset($results[0])?$results[0]->city_jorip_dag_no:'' ?>"  class="text-input-big" /></td>
            				</tr>
            			</table>
            		</td>
            	</tr>
				<tr>
					<td colspan="2" style="text-align: left;padding-left:500px"><br><input type="button" value="Save" id="in_req_button"  class="btn-small btn-small-normal enabledElem" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;"/> <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></td>
				</tr>

			</table>
        </form>
   </div>