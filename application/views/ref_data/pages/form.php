<body style="height:96%">
<link rel="stylesheet" href="<?=base_url()?>css/multiple-select.css" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.multiple.select.js"></script>
<script type="text/javascript">
	var csrf_token='';
	var csrf_tokens='';
	jQuery(document).ready(function () {
		
		var theme = 'energyblue';
		jQuery("#sendButton").jqxButton({template:"primary",width:"100"});
		jQuery('.text-input-big').jqxInput({  });

		// jQuery('.text-input-small').addClass('jqx-input');
		// jQuery('.text-input-small').addClass('jqx-rc-all');
		jQuery('.text-input-big').addClass('jqx-input');
		jQuery('.text-input-big').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input-small').addClass('jqx-input-' + theme);
			jQuery('.text-input-small').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input-small').addClass('jqx-rc-all-' + theme);
			jQuery('.text-input-big').addClass('jqx-input-' + theme);
			jQuery('.text-input-big').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input-big').addClass('jqx-rc-all-' + theme);
			jQuery('.text-input-big').css('height', '25px');
		}

		<?=$jqx?>
		 <?php if($add_edit=="edit"){
	    	echo $val;
	    } ?>
		<? if($rules!=''){ ?>// initialize validator.
		jQuery('#form').jqxValidator({
			rules: [
			<?=$rules?>
			]
		});
		<? } ?> 
		

		/*// validate form.
		jQuery("#sendButton").click(function () {
			<? if($rules!=''){ ?>
			var validationResult = function (isValid) {
				if (isValid) {
					call_ajax_submit();
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);
			<? }else{?>
			call_ajax_submit();
			<? } ?>
		});*/
		
	});
	function setDatePicker(id) {
            jQuery("#" + id).datepicker({ dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true });
            //jQuery("#" + id).datepicker("option", "dateFormat", "dd/mm/yy", "changeMonth": true, changeYear: true);
        }
	function checkDuplicate(tabname,value,fieldname,editid)
	{
		var rslt = true;
		if(value != '')
		{
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			jQuery.ajax({
					type: "POST",
					cache: false,
					url: '<?=base_url()?>index.php/ref_data/checkDuplicateFieldName/'+tabname+'/'+value+'/'+fieldname+'/'+editid,
					async : false,
					data : {[csrfName]: csrfHash},
					datatype: "html",
					success: function(response){
						var fields = response.split(':::');

						var table = fields[0];
						jQuery('.txt_csrfname').val(fields[1]);
						if(table > '0'){ rslt = false; }
					}
				});
		}
		return rslt;
	}

	function call_ajax_submit()
	{
		jQuery("#sendButton").hide();
		jQuery("#loading").show();

		var postdata = jQuery('#form').serialize();

		jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?=base_url()?>index.php/ref_data/add_edit_action/<?=$add_edit?>/<?=$ref_id?>",
				data : postdata,
				datatype: "json",
				success: function(response){
					var json = jQuery.parseJSON(response);
					window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
					jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.Message!='OK')
					{
						jQuery("#sendButton").show();
						jQuery("#loading").hide();
						alert(json.Message);
						return false;
					}
					else
					{
						if(json.row_info != '')
						{
							window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
							
							<? if($add_edit=='add'){?>									
							window.parent.jQuery('#jqxgrid').jqxGrid('updatebounddata');
							window.parent.jQuery("#error").show();
							window.parent.jQuery("#error").fadeOut(11500);
							window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
							jQuery("#loading").hide();
							messege_add_new();
							
							<? }else{?>
										
							window.parent.jQuery('#jqxgrid').jqxGrid('updatebounddata');
							window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?=$rowindex?>);
							window.parent.jQuery("#error").show();
							window.parent.jQuery("#error").fadeOut(11500);
							window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Updated');
							window.top.EOL.messageBoard.close();
							<? }?>
						} 
						else
						{
							window.parent.jQuery("#error").show();
							window.parent.jQuery("#error").fadeOut(11500);
							window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
							window.top.EOL.messageBoard.close();
						}
					}
				}
			});
	}

	function fileValidation(name){
		//alert(name);
		var fileInput = document.getElementById(name);
	    var filePath = fileInput.value;
	    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
	    var fileSize = document.getElementById(name).files[0].size;
	    if(!allowedExtensions.exec(filePath)){
	        alert('Only jpeg/jpg/png file is allowed');
	        fileInput.value = '';
	        return false;
	    }
	    else if(fileSize>50000)
	    {
	    	alert('File size will be maximum 50KB');
	        fileInput.value = '';
	        return false;
	    }
	    else{
	        if (fileInput.files && fileInput.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                document.getElementById('imagePreview_'+name).innerHTML = '<img src="'+e.target.result+'"/>';
	            };
	            reader.readAsDataURL(fileInput.files[0]);
	        }
	    }
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


		} else {
			$('cdrMessageErrorMsg').innerHTML = response.errorMsgs;
			$('cdrMessageErrorMsg').style.display = '';
		}
	  };
	  var handleCdrMessageFailure = function(o) {
			showInfoDialog( 'cdrMessagefailuretitle', 'cdrMessagefailurebody', 'WARN' );
	  };

	  var handleSubmit = function() {

		window.location.reload(true);
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
   <form class="form" id="form" method="post" action="<?=base_url()?>index.php/ref_data/add_edit_action/<?=$add_edit?>/<?=$ref_id?>" enctype="multipart/form-data">
        <div class="formHeader" style="background-color:#185891;">Reference Data Entry</div>
        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <table  class="register-table">
        	<?=$html?>
            <tr>
			<td>&nbsp;</td>
            	<td  style="text-align: left">
					<br><input type="button" value="Save" id="sendButton" class="buttonStyleAdd" style="cursor:pointer"/>
					<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
            	</td>
            </tr>
        </table>
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

<script type="text/javascript">
	function popup(url) {
		var winl = (screen.width - 900) / 2;
		var wint = 40;
		newwindow=window.open(url,'name','height=600, width=900,top='+wint+', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left='+winl);
		if (window.focus) {newwindow.focus()}
		return false;
	}
	var options = { 
			complete: function(response) 
			{
				var json = jQuery.parseJSON(response.responseText); 
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				if(json.Message!='OK')
				{
					jQuery("#sendButton").show();
					jQuery("#loading").hide();
					alert(json.Message);
					return false;
				}
				else
				{
					<?php if ($op_from_others==0): ?>
						if(json.row_info != '')
						{
							window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
							
							<? if($add_edit=='add'){?>									
							window.parent.jQuery('#jqxgrid').jqxGrid('updatebounddata');
							window.parent.jQuery("#error").show();
							window.parent.jQuery("#error").fadeOut(11500);
							window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
							jQuery("#loading").hide();
							messege_add_new();
							
							<? }else{?>
										
							window.parent.jQuery('#jqxgrid').jqxGrid('updatebounddata');
							window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?=$rowindex?>);
							window.parent.jQuery("#error").show();
							window.parent.jQuery("#error").fadeOut(11500);
							window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Updated');
							window.top.EOL.messageBoard.close();
							<? }?>
						} 
						else
						{
							window.parent.jQuery("#error").show();
							window.parent.jQuery("#error").fadeOut(11500);
							window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
							window.top.EOL.messageBoard.close();
						}
					<?php else: ?>//when requst comes from others
						window.opener.location.reload();
						window.close();
					<?php endif ?>
				}
							
			}  
		}; 
		jQuery("#form").ajaxForm(options);
		jQuery("#sendButton").click(function() {
			var validationResult = function (isValid) {
				if (isValid) {
					jQuery("#sendButton").hide();
					jQuery("#loading").show();
					jQuery("#form").submit();
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);		
		});
</script>