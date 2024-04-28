<body style="height:98%">
<script type="text/javascript">
	jQuery(document).ready(function () {

		var theme = 'energyblue';
		var csrf_token='';
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
      

        
        

        var group_ddl_list = 
        [<? $i=1; 
            
        foreach($menu_group as $row)
        { 
            if($i!=1){echo ',';} 
            echo '{value:"'.$row->id.'", label:"'.$row->menu_name.'"}'; $i++;
        }
        ?>]; 

        jQuery("#group_ddl").jqxDropDownList({theme: theme, autoDropDownHeight:false, promptText: "---Select Group---", source: group_ddl_list, width: 321});
        //jQuery("#group_ddl").val(0);

        var catagory_ddl_list = 
        [<? $i=1; 
            
        foreach($menu_category as $row)
        { 
            if($i!=1){echo ',';} 
            echo '{value:"'.$row->id.'", label:"'.$row->menu_cate_name.'"}'; $i++;
        }
        ?>]; 

        jQuery("#catagory_ddl").jqxDropDownList({theme: theme, autoDropDownHeight:false, promptText: "---Select Catagory---", source: catagory_ddl_list, width: 321});
        
        var operation_ddl_list = 
        [<? $i=1; 
            
        foreach($menu_operation as $row)
        { 
            if($i!=1){echo ',';} 
            echo '{value:"'.$row->name.'", label:"'.$row->code.'"}'; $i++;
        }
        ?>]; 

        jQuery("#Operation_ddl").jqxDropDownList({theme: theme, autoDropDownHeight:false, promptText: "---Select Operation---", source: operation_ddl_list, width: 321});

        <?
        if($add_edit=='edit'){?>
            //alert(<? if(isset($result->menu_group_id)){ echo $result->menu_group_id; } else { echo ''; } ?>);
            jQuery("#group_ddl").jqxDropDownList('val', '<? if(isset($result->menu_group_id)){ echo $result->menu_group_id; } else { echo ''; } ?>');
            jQuery("#catagory_ddl").jqxDropDownList('val', '<? if(isset($result->menu_cate_id)){ echo $result->menu_cate_id; } else { echo ''; } ?>');
            jQuery("#Operation_ddl").jqxDropDownList('val', '<? if(isset($result->menu_operation)){ echo $result->menu_operation; } else { echo ''; } ?>');
        <? } ?>

		//jQuery("#sendButton").jqxButton({template:"primary",width:"100"});

		// initialize validator.
		jQuery('#form').jqxValidator({
			rules: [
            { input: '#group_ddl', message: 'Required!', action: 'blur, change', rule: function (input) {
                    if(input.val() != '')
                    {
                        var item = jQuery("#group_ddl").jqxDropDownList('getSelectedItem');
                        if(item != null) {  jQuery("input[name='group_ddl']").val(item.value); }
                        return true;
                    }
                    return false;
                }
            },    
			{ input: '#menu_link_name', message: 'Required', action: 'keyup, blur', rule: 'required' },
			{ input: '#menu_link_name', message: 'Number not accepted', action: 'keyup, blur', rule: 'notNumber' },
			{ input: '#menu_link_name', message: 'Duplicate', action: 'keyup, blur', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
					if(input.val()==''){
						commit(true);
						return true;
					}

					var ValOperation_ddl = jQuery("#Operation_ddl").jqxDropDownList('getSelectedItem').value;
					var Valgroup_ddl = jQuery("#group_ddl").jqxDropDownList('getSelectedItem').value;
					var Valcatagory_ddl= jQuery("#catagory_ddl").jqxDropDownList('getSelectedItem').value;
					var Vallink_name = jQuery("#menu_link_name").val();

					if(csrf_token == '')
					{
						csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';	
					}
					jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>index.php/Menu_subcategory/duplicate_ink_name/<?=$add_edit?>/<?=$id?>",
						data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_token,vallink_name: Vallink_name,valgroup: Valgroup_ddl,valcatagory:Valcatagory_ddl},
						datatype: "json",
						success: function(response)
						{
							var json = jQuery.parseJSON(response);
							if(json.csrf_token == csrf_token)
							{
								csrf_token = json.csrf_token;
							}else{
								window.location.replace('<?=base_url()?>index.php/home/logout');
							}
							if(json.Status=='ok')
							{
								commit(true);
                                return true;
							}
							else{
								commit(false);
                                return false;

							}
						}
					});

				}
			},
			{ input: '#url_prefix', message: 'Required', action: 'keyup, blur', rule: 'required' },					    
			{ input: '#sort_order', message: 'Character not accepted', action: 'keyup, blur', rule: 'number' },
			{ input: '#sort_order', message: 'Duplicate', action: 'keyup, blur', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
					if(input.val()==''){
						
						commit(true);
						return true
					}
					var ValOperation_ddl = jQuery("#Operation_ddl").jqxDropDownList('getSelectedItem').value;
					var Valgroup_ddl = jQuery("#group_ddl").jqxDropDownList('getSelectedItem').value;
					var Valcatagory_ddl= jQuery("#catagory_ddl").jqxDropDownList('getSelectedItem').value;
					var Valmenu_cate_name = jQuery("#menu_link_name").val();
					var Valsort_order = input.val();
					if(Valsort_order=='1'){
                      if(ValOperation_ddl!='view'){
						  alert('Sort Order 1  for  View Operation!');
						  commit(true);
                          return false;
					  }
					}
					if(ValOperation_ddl=='view'){
                      if(Valsort_order!='1'){
						  alert('Sort Order 1  for  View Operation!');
						  commit(true);
                          return true;
					  }
					}

					
					if(csrf_token == '')
					{
						csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';	
					}
					jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>index.php/Menu_subcategory/duplicate_sort_order/<?=$add_edit?>/<?=$id?>",
						data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_token,valSort: Valsort_order,valgroup: Valgroup_ddl,valcatagory:Valcatagory_ddl},
						datatype: "json",
						success: function(response)
						{
							var json = jQuery.parseJSON(response);
							if(json.csrf_token == csrf_token)
							{
								csrf_token = json.csrf_token;
							}else{
								window.location.replace('<?=base_url()?>index.php/home/logout');
							}
							if(json.Status == 'ok')
							{
								commit(true);
                                return true;
							}
							else{
								commit(false);
                                return false;

							}
						}
					});

				}
			}
			]
		});

		// validate form.
		jQuery("#sendButton").click(function () {
			var validationResult = function (isValid) {
				if (isValid) {
					call_ajax_submit();
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);
		});

        jQuery("#group_ddl").on('change',function(event){

			//alert('Hi');
			var args = event.args;
               if(args){
                if(csrf_token == '')
                {
                    csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';	
                }
				jQuery.ajax({
					type: "POST",
					cache: false,
					url: "<?=base_url()?>index.php/Menu_subcategory/get_cat_list",
					data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_token,catId: args.item.value},
					datatype: "json",
					success: function(response)
					{
						//alert (response);
						//var json = jQuery.parseJSON(response);

                        var json = jQuery.parseJSON(response);
							if(json.csrf_token == csrf_token)
							{
								csrf_token = json.csrf_token;
                            }
							// }else{
							// 	window.location.replace('<?=base_url()?>index.php/home/logout');
							// }
                        
						jQuery("#catagory_ddl").jqxDropDownList({ source: json,autoDropDownHeight:true});
					}
				});
			}
	    });

	});


	function call_ajax_submit()
	{
		jQuery("#sendButton").hide();
		jQuery("#loading").show();

		var postdata = jQuery('#form').serialize();

		jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?=base_url()?>index.php/Menu_subcategory/add_edit_action/<?=$add_edit?>/<?=$id?>",
				data : postdata,
				datatype: "json",
				success: function(response){
                    var json = jQuery.parseJSON(response);
                    if(json.Status!='00'){
                    var row = {};
                    var menu_name = jQuery("#group_ddl").jqxDropDownList('getSelectedItem');
                    var catagory_ddl = jQuery("#catagory_ddl").jqxDropDownList('getSelectedItem');
                    var Operation_ddl = jQuery("#Operation_ddl").jqxDropDownList('getSelectedItem');
                    row["id"] = json.Status;
                    row["menu_name"] = menu_name.label; 
					row["menu_cate_name"] = catagory_ddl.label; 
                    row["menu_operation"] = Operation_ddl.label;
                    row["menu_link_name"] = jQuery("#menu_link_name").val();
					row["url_prefix"] = jQuery("#url_prefix").val();
					row["sort_order"] = jQuery("#sort_order").val();


					window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
					<? if($add_edit=='add'){?>
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

				//	jQuery("#msgArea").val('');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
					window.top.EOL.messageBoard.close();
                    } 
                     else {
                        window.parent.jQuery("#error").show();
                        window.parent.jQuery("#error").fadeOut(11500);
                        window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Sort value 1 must be View Operation!');
                        window.top.EOL.messageBoard.close();
                     }
				}
			});
	}
    </script>

    <div  style=" width:99.9%; margin:auto">
       <form class="form" id="form" method="post" action="#">
       		<div class="formHeader">Menu Sub Catagory Information </div>
       			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	      		<table class="register-table">
                    <tr>
                        <td width="10%">Group Name <span style="color:#FF0000">*</span></td>
                        <td>
                        <div name="group_ddl" id="group_ddl">
                        </td>
                    </tr>
                    <tr>
                        <td width="10%">Catagory Name <span style="color:#FF0000">*</span></td>
                        <td>
                        <div name="catagory_ddl" id="catagory_ddl">
                        </td>
                    </tr>
                    <tr>
                        <td width="10%">Menu Operation<span style="color:#FF0000">*</span></td>
                        <td>
                        <div name="Operation_ddl" id="Operation_ddl">
                        </td>
                    </tr>					
                    <tr>
                        <td width="10%">Menu link Name <span style="color:#FF0000">*</span></td>
                        <td><input name="menu_link_name" type="text" id="menu_link_name" value="<?=isset($result->menu_link_name)?$result->menu_link_name:''?>"  class="text-input-big" /></td>
                    </tr>
                    <tr>
                        <td>URL Prefix</td>
                        <td><input name="url_prefix" type="text" id="url_prefix" value="<?=isset($result->url_prefix)?$result->url_prefix:''?>"  class="text-input-big" /></td>
                    </tr>
                    <tr>
                        <td>Sort Order <span style="color:#FF0000">*</span></td>
                       <td><input name="sort_order" type="text" id="sort_order" value="<?=isset($result->sort_order)?$result->sort_order:''?>"  class="text-input-big" /></td>
                    </tr>
					
                    <tr>
						<td>&nbsp;</td>
                        <td><br><input type="button" value="Save" id="sendButton" class="buttonStyle" /> <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></td>
                    </tr>
                </table>
        </form>

    </div>