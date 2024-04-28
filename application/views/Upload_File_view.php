<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
	.buttonsendtochecker {
	   background-color: white; 
	  color: black; 
	  border: 2px solid #008CBA;
	  border-radius: 12px;
	  padding: 8px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  transition-duration: 0.4s;
	  cursor: pointer;
	}
	.buttonsendtochecker:hover {
	  background-color: #008CBA;
	  color: white;
	}
	.buttonclose {
	   background-color: white; 
	  color: black; 
	  border: 2px solid #555555;
	  border-radius: 12px;
	  padding: 8px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  transition-duration: 0.4s;
	  cursor: pointer;
	}
	.buttonclose:hover {
	  background-color: #555555;
	  color: white;
	}
</style>
<head>
		<title>Upload Files</title>
		<link rel="stylesheet" href="<?=base_url()?>css/fileultimate.css">
		<?php $this->load->view('includes/header');?>
        <style type="text/css">
	       	menubar, toolbar {
				display: none;
				img{border:none;}
			}
        </style>
		<link rel="stylesheet" href="<?=base_url()?>css/style_upload.css">
		<script language="javascript" type="text/javascript">
		jQuery(document).ready(function() {	
			uploadedfile('<?=$this->session->userdata["ast_user"]["user_id"];?>','<?=$module_name?>','<?=$data_field_name?>',1);
		});
		function fileValidation(name){
			//alert(name);
			var fileInput = document.getElementById(name);
		    var filePath = fileInput.value;
		    var allowedExtensions = /(\.pdf|\.docx|\.jpeg|\.png|\.jpg|\.xlsx|\.msg)$/i;
		    var fileSize = document.getElementById(name).files[0].size;
		    if(!allowedExtensions.exec(filePath)){
		        alert('Only pdf/docx/jpeg/png/jpg/xlsx file is allowed');
		        fileInput.value = '';
		        return false;
		    }
		   	return true;
		}
		function startUpload(){	
			if (jQuery("#hidden_count_val").val()>0) 
			{
				alert('Please Remove Previous File');
				return false;
			}
			if (jQuery("#myfile").val()=='') 
			{
				alert('Please Select File');
				return false;
			}
			jQuery("#f1_upload_form").hide();
			jQuery("#in_req_loading").show();
			return true;
			  	
		}
		function uploadedfile(sessionid,module_name,data_field_name,loop=null){
		//alert(jQuery('.txt_csrfname').val());
		if (loop==1)
		{
			var csrfName = window.opener.jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = window.opener.jQuery('.txt_csrfname').val(); // CSRF hash
		}
		else
		{
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		}
		jQuery.ajax({
        url: '<?php echo base_url(); ?>index.php/home/ajaxloadfile/'+sessionid+'/'+module_name+'/'+data_field_name+'/'+csrfHash,
        type: "post",
        async:false,
        cache: false,
        data: {[csrfName]: csrfHash},
        datatype: "json",
        success: function(response){
			
				var ds=response.split('####');		
				
				jQuery("#divGrid").empty();
				jQuery("#divGrid").html(ds[1]);	
				jQuery("#hidden_count_val").val(ds[2]);	
				jQuery("#f1_upload_form").show();
				jQuery("#in_req_loading").hide();
				jQuery("#myfile").val('');
				jQuery("#hidden_closed_value").val(ds[0]);
				jQuery('.txt_csrfname').val(ds[3]);
				//window.opener.document.getElementById('hidden_<?=$data_field_name?>').innerHTML = jQuery("#hidden_closed_value").val();
				window.opener.jQuery('.txt_csrfname').val(ds[3]);
				//alert(ds[3]);
				window.opener.document.getElementById('hidden_<?=$data_field_name?>').innerHTML = jQuery("#hidden_closed_value").val();	
				window.opener.document.getElementById('hidden_<?=$data_field_name?>_select').value = jQuery("#hidden_count_val").val();	
            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        	});
		}
		
		
		function remove_file(Id, filename){
			 if(deleteItem('Are you sure want to remove?')==true){		
				var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				jQuery.ajax({
		        url: '<?php echo base_url(); ?>index.php/home/remove_file/'+Id+'/'+filename,
		        async:false,
		        type: "post",
		        data: { [csrfName]: csrfHash,},
		        datatype: "json",
		        success: function(response){
		        	var ds=response.split('####');
		        	jQuery('.txt_csrfname').val(ds[1]);
					window.opener.jQuery('.txt_csrfname').val(ds[1]);
						stopUpload(ds[0]);
		            },
		            error:   function(model, xhr, options){
		                alert('failed');
		            },
		        	});
			}	
		}
		
		
		function stopUpload(success){	
			uploadedfile('<?=$this->session->userdata["ast_user"]["user_id"];?>','<?=$module_name?>','<?=$data_field_name?>');		 
			 var result = '';
			  if (success==1){
				 result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
			  	set_return();
			  }
			  else if (success == 2){
				 result = '<span class="msg">The file size should be less than or equal to 1 MB!<\/span><br/><br/>';
			  }
			  else if (success == 3){
				 result = '<span class="msg">The file was removed successfully!<\/span><br/><br/>';
			  }
			  else {
				 result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
			  }
			  document.getElementById('f1_upload_form').innerHTML = result + '<label style="margin-left:80px">File: <input name="myfile" id="myfile" type="file" size="9" /><br/><\/label><label><input type="submit" class="buttonsendtochecker" id="sendtochecker" value="Upload" /><\/label><label><input type="button" class="buttonclose" id="SendTocheckercancel" onclick="set_return();" value="Close" /><\/label>';
		}
		function set_return() {		
			window.opener.document.getElementById('hidden_<?=$data_field_name?>').innerHTML = jQuery("#hidden_closed_value").val();	
			window.opener.document.getElementById('hidden_<?=$data_field_name?>_select').value = jQuery("#hidden_count_val").val();	
			window.close();		
		}
		//-->
		</script>   		
	</head>
	<body class="dialog"  style="overflow-x:hidden;overflow-y:hidden;">
	 	<div class="nonSelectableText" style="position: absolute; top: 5px; left: 10px; width: 480px;">
			<table cellspacing="0" cellpadding="0" border="0" class="generalText" style="width: 100%; height: 100%;">
				<tbody><tr style="height: 50px; cursor:pointer">
					<td style="width: 50px"><img height="48" width="48" alt="" src="<?=base_url()?>images/uploadfolder.png" style="border: none"></td>
					<td  align="left" style="white-space: nowrap">&nbsp;</td>
				</tr>
				<tr><td style="height: 5px; border-top: #d6d2c2 2px solid; " colspan="2">&nbsp;</td></tr>
			</tbody></table>
		</div> 
		<div class="nonSelectableText" style="position: absolute; top: 65px; left: 10px; width: 480px; height: 150px;" id="divUpload">           
		    <div style="width: 100%; height:100px; overflow:auto; background-color: white; border: #d4d0c8 1px solid; border-top: none; margin-bottom: 10px;" id="divGrid">
			
			</div>
			
			 <div id="content">
                <form id="submit_form" action="<?=base_url()?>index.php/home/upload_by_ajax/<?=$module_name?>/<?=$data_field_name?>" method="post" enctype="multipart/form-data" target="upload_target" onSubmit="return startUpload();" >
                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                     <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
					 <p id="f1_upload_form" align="center"><br/>
                         <label style="margin-left:80px">File:  
                              <input name="myfile"  id="myfile" type="file" size="9" onchange="fileValidation('myfile')" />
                         </label><br/>
                         <label>
                         	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="Upload" />
                         </label>
						 <label>
			      			<input type="button" class="buttonclose" id="SendTocheckercancel" onclick="set_return();" value="Close" />
                         </label>
                     </p>
                     <input type="hidden" name="hidden_closed_value" id="hidden_closed_value" value=""  />
					<input type="hidden" name="hidden_count_val" id="hidden_count_val" value="0"  />
                     <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                 </form>
				 <br /><br />
             </div>
			
		</div>
			

</body></html>
<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
<script type="text/javascript">
	var options = { 
			complete: function(response) 
			{
				var json = jQuery.parseJSON(response.responseText); 
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				if(json.Message!='OK')
				{
					jQuery("#f1_upload_form").show();
					jQuery("#in_req_loading").hide();
					alert(json.Message);
					return false;
				}
				else
				{
	   				uploadedfile('<?=$this->session->userdata["ast_user"]["user_id"];?>','<?=$module_name?>','<?=$data_field_name?>');	
					set_return();
				}
							
			}  
		}; 
		jQuery("#submit_form").ajaxForm(options);
		jQuery("#sendtochecker").click(	function() {
			if (startUpload()==true) {
				jQuery("#f1_upload_form").hide();
				jQuery("#in_req_loading").show();
				jQuery("#submit_form").submit();
			}		
		});
		
		
		
</script>