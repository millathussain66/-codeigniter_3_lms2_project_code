<style type="text/css">
	.bcont {
		width:100%;
		height:45px;
		margin:0;
		padding:0;
		background-color:#ffffff;/*background-color:#185891;*/
		text-align:left;
		font-family:calibri; 
		font-size:13px;
	}
    #notification_icon {
      color: #333333;
      background: #dddddd;
      border: none;
      outline: none;
      border-radius: 20%;
    }

    #notification_icon:hover {
      cursor: pointer;
    }

    #notification_icon::active {
      background: #cccccc;
    }
    #icont_text{
		position: absolute;
		width: 15px;
		height: 15px;
		background: red;
		color: #ffffff;
		display: flex;
		justify-content: center;
		align-items: center;
		border-radius: 52%;
		margin-left:21px;
		margin-top:-10px;
    }
    .button {
	  background-color: #4CAF50; /* Green */
	  border: none;
	  color: white;
	  padding: 16px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  transition-duration: 0.4s;
	  cursor: pointer;
	}

	#ext {
        border-collapse: separate;
        border-spacing: 0 15px;
      }
.button6 {
  background-color: #555555; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;;
  border-radius: 12px;
}
.buttonclose {
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
.button_delete {
  background-color: #00ffff; /* Green */
  border: none;
  color: white;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button3 {
  background-color: #4CAF50;
  color: black;
}
table {
        border-collapse: collapse;
    }
table#preview_table td {
        border: 1px solid #c7c7c7;
    }
table.preview_table2 td, table.preview_table2 th{
        border: 1px solid #c7c7c7;
        word-wrap:break-word;
        padding:5px;
    }
.button4 {
  background-color: #00ffff;
  color: black;
}

.button3,.button4:hover {
  background-color: #f44336;
  color: white;
}
.center {
  margin: 0;
  position: absolute;
  top: 90%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
/* .center {
  margin: auto;
  width: 20%;
  padding: 10px;
} */
   .text-input
	{
		height: 23px;
		width: 350px;
	}


	.required
	{
		vertical-align: baseline;
		color: red;
		font-size: 10px;
	}

    #notify_details {
     font-family: Arial, Helvetica, sans-serif;
     border-collapse: collapse;
     width: 100%;
   }
    b {
       font-size: 14px;
    }


	#notify_details td, #notify_details th {
	  border: 1px solid #ddd;
	  padding: 8px;
	}
	#notify_details  th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: center;
	  background-color: #4CAF50;
	  color: white;
	}
    .buttonclose {
       background-color: white; 
      color: black; 
      border: 2px solid #555555;
      border-radius: 12px;
      padding: 10px 15px;
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
    .wrapper {
    text-align: center;
    }

    .button {
        position: absolute;
        top: 50%;
    }
    #gurantor_table {
        border-collapse: collapse;
	}
	#gurantor_table td {
		border: 1px solid rgba(0,0,0,.20); 
	}
</style>
<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>

<div id="wrapper">
    <div id="header">
    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <script>
            var csrf_token = '';
            var csrf_tokens='';
            var theme = 'energyblue';
            var ref_rules = [];
            function popup_setting(url) {
                var heightReduc = 100;
                var widthReduce = 140;

                var pwidth = screen.width - 140;
                var pheight = screen.height - 100;
                var wint = 140/2;
                var winl = 100/2;

                newwindow=window.open(url,'name',"height="+pheight+", width="+pwidth+",top="+wint+", toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left="+winl);
                if (window.focus) {newwindow.focus()}
                return false;
            }
            <? if($this->session->userdata('ast_user')){?>
            jQuery(document).ready(function() {
                callAjax();
                jQuery("#notification_data").jqxWindow({ theme: theme,  width: '50%', height:'50%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#n_ok") });
                jQuery("#notify_details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOKn") });
                jQuery("#add_more_ref_div").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#okref") });
            });
            function add_more_ref_data(ref_table)
            {
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery("#ref_form_result").html('');
                jQuery.ajax({
                url: '<?=base_url()?>index.php/Ref_data/get_ref_data_form',
                async:false,
                type: "post",
                data: { [csrfName]: csrfHash,ref_table : ref_table},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str='';
                        if(json.Message!='ok')
                        {
                            alert(json.Message);
                        }
                        else
                        {
                            window.open('<?=base_url()?>index.php/ref_data/from/add/'+json.ref_id+'/1','popup','width=600,height=600,scrollbars=no,resizable=no');
                        }
                    },
                    error:   function(model, xhr, options){
                        alert('failed');
                    },
                });

            }
            // set your delay here, 30 seconds as an example...
            var my_delay = 30000;

            
            function callAjax()
            {
                jQuery.ajax({
                cache    : false,
                url      : '<?=base_url()?>index.php/user_info/listactivity', 
                data     : 'User_Id=<?=$this->session->userdata['ast_user']['user_id']?>',
                type  : 'get',
                dataType : 'html',
                success  : function(response){
                var data = response.split("::");
                jQuery('.txt_csrfname').val(data[1]);
                      if(data[0]=='1'){
                          setTimeout(callAjax, my_delay);
                      }

                  else if(data[0]=='2'){
					           window.location.replace('<?=base_url()?>home/logout');
                  }
                  else if(data[0]=='3'){
                        window.location.replace("<?=base_url()?>home/logout");
                    } 
                  else {
                      window.location.replace('<?=base_url()?>home/logout');
                  }
                }
                });


            }
            function view_notification_data()
            {
                jQuery.ajax({
                    type: "POST",
                    cache: false,
                    url: "<?=base_url()?>Home/get_notification_data",
                    data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_token},
                    datatype: "json",
                    success: function(response){
                        var json = jQuery.parseJSON(response);
                            if(json['row_info'])
                            {
                                document.getElementById("notification_data").style.visibility='visible';
                                jQuery("#notification_data_details").empty();
                                var html='';
                                jQuery.each(json['row_info'],function(key,obj){
                                    html+='<tr>';
                                        html+='<td align="center"><div style="text-align:center;cursor:pointer" onclick="notification_details(\''+obj.url+'\',\''+obj.table_id+'\')" ><img align="center" src="<?=base_url()?>home/get_file/xyzzzsdsbbbpngvd"></div></td>';
                                        html+='<td align="left">'+obj.notification_type+'</td>';
                                        html+='<td align="left">'+obj.notification_date+'</td>';
                                        html+='<td align="left"><div style="text-align:center;cursor:pointer" onclick="delete_notification('+obj.id+')" ><img align="center" src="<?=base_url()?>images/deletenew.png"></div></td>';
                                    html+='</tr>';
                                });
                                jQuery("#notification_data_details").append(html);
                                if(json['row_info'].length>0)
                                {
                                    jQuery("#notification_data").jqxWindow('open');
                                }
                                else
                                {
                                    jQuery("#notification_data").jqxWindow('close');
                                }
                            }
                            else {
                                alert("Something went wrong, please refresh the page.")
                            }

                    }
                });
            }
            function delete_notification(id)
            {
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    type: "POST",
                    cache: false,
                    url: "<?=base_url()?>Home/delete_notification",
                    data : {[csrfName]: csrfHash,id: id},
                    datatype: "json",
                    success: function(response){
                        //console.log(response);
                        var json = jQuery.parseJSON(response);
                            if(json['status']=='success')
                            {
                                jQuery('.txt_csrfname').val(json['csrf_token']);
                                get_notify_data();
                                view_notification_data();
                            }
                            else {
                                alert("Something went wrong, please refresh the page.")
                            }

                    }
                });
            }
            function get_notify_data()
            {
                jQuery.ajax({
                    type: "POST",
                    cache: false,
                    url: "<?=base_url()?>Home/get_total_notification",
                    data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_token},
                    datatype: "json",
                    success: function(response){
                        //console.log(response);
                        var json = jQuery.parseJSON(response);
                            if(json['row_info'])
                            {
                                if (json['row_info']!='0')
                                {
                                  jQuery("#notification_div").show();
                                  jQuery("#icont_text").html(json['row_info']);
                                }
                                else
                                {
                                  jQuery("#notification_div").hide();
                                  jQuery("#icont_text").html('');
                                }
                            }
                            else {
                                alert("Something went wrong, please refresh the page.")
                            }

                    }
                });
            }
            function notification_details(details_url,id)
            {
                if(details_url=='' || details_url==null)
                {
                    return false;
                }
                jQuery('#loading_preview_n').show();
                jQuery('#loading_p_n').show();
                jQuery('#details_table_n').hide();
                jQuery("#notify_details").jqxWindow('open');
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    type: "POST",
                    cache: false,
                    url: details_url,
                    data : {[csrfName]: csrfHash,id: id},
                    datatype: "json",
                    success: function(response){
                    //alert(response);
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                            if(json.str)
                            {
                                document.getElementById("notify_details").style.visibility='visible';
                                jQuery("#main_body_notify").html(json['str']);
                                    jQuery('#loading_preview_n').hide();
                                    jQuery('#loading_p_n').hide();
                                    jQuery('#details_table_n').show();
                                    jQuery("#notify_details").jqxWindow('open');
                            }
                            else {
                                alert("Something went wrong, please refresh the page.")
                            }

                    }
                });
            }
            <? }?>
        </script>
        <? if($this->session->userdata('ast_user')){
            $data['new_expiration'] = round($this->session->userdata['ast_user']['SESSION_idle_time']*60);
            $this->session->sess_expiration = $data['new_expiration'];
            $this->session->set_userdata($data);
            // session_start();
            $_SESSION['pop_user_id']=$this->session->userdata['ast_user']['user_id'];

        }
        ?>

        <div class="bcont">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <?php
			$CI =& get_instance();
            $str = "Select * from project_info where id=1";
            $query = $CI->db->query($str)->row();
        ?>
        <div style="width:35%;float:left;padding:0px;">         
        	<img src="<?=base_url()?>home/get_file/xyzzzsdsbbbpngclient" style="height:32px;width:auto;padding:9px 0 0 10px;" />    
		</div>

        <div style="float:left;text-align:center;padding-top: 6px!important;padding-bottom: 6px!important;font-size:24px;color:#0B1562;font-family: Times New Roman;">            
			
          Litigation Management  System
		</div>
    <div style="float:left;text-align:center;padding-top: 9px;">            
        <script type="text/javascript">
          get_notify_data();
        </script>
        <div id="notification_div" style="float:left;margin-left:300px;display:none"><img onclick="view_notification_data()" id="notification_icon" width="30px" height="30px" style="" src="<?=base_url()?>home/get_file/xyzzzsdsbbbpngn"><span id="icont_text"></span>
        </div>     
    </div>
        
        <div style="float:right;padding-top:15px;padding-right:20px"><span style="font-weight:bold;">
            <? if($this->session->userdata('ast_user')){?>  
                <a href="<?=base_url()?>user_info/change_pass" target="_self" style="margin-right: 15px;"><img  border="0" src="<?=base_url()?>home/get_file/xyzzzsdsbbbpngsn" height="16" title="Change Password" alt="Change Password" style=" padding-bottom:0;vertical-align: bottom" /></a>
                <a onClick="return deleteItem('Are you sure want to sign out?');" style="color:#000" href="<?=base_url()?>home/logout"> 
					<img  border="0" src="<?=base_url()?>home/get_file/xyzzzsdsbbbpnge" align="absmiddle" height="16" style="margin-right:2px;" title="Logout" alt="Logout"/>
					Logout
				</a>
			<? }?>
            </span>
		</div>
            
          <!--   For Notification History -->
            <div id="notification_data" style="visibility:hidden;">
            <div style="padding-left: 17px"><strong>Notification</strong></div>
                <div style="" id="details_table_n">
                    <table style="width: 100%;" class="preview_table2">
                        <thead>
                            <th width="5%" align="center"><strong>P</strong></th>
                            <th width="50%" align="left"><strong>Subject</strong></th>
                            <td width="10%" align="center"><strong>Date</strong></td>
                            <td width="10%" align="center"><strong>Delete</strong></td>
                        </thead>
                        <tbody id="notification_data_details">
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" align="center"><input type="button" class="button1" id="n_ok" value="Close" /></td>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add_more_ref_div" style="visibility:hidden;">
    <div><strong>Add More Refference Data</strong></div>
        <form class="form" id="ref_data_add_form" method="post" action="" enctype="multipart/form-data">
            <div class="formHeader" style="background-color:#185891;">Reference Data Entry</div>
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <table  class="register-table">
                <span id="ref_form_result"></span>
                <tr>
                <td>&nbsp;</td>
                    <td  style="text-align: left">
                        <br>
                        <input type="button" value="Save" id="sendButton_ref_data" class="buttonStyleAdd" style="cursor:pointer"/>
                        <input type="button" align="center" class="" style="background-color:#87c540;width:100px;height: 30px;font-weight: bold;font-family: arial;cursor:pointer" id="okref" value="Cancel" />
                        <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
<script type="text/javascript">
    function popup(url) {
        window.open(url, "_blank")
        //window.location = url; // redirect
        return false;
        if(url.endsWith(".msg"))
        {
            window.location = url; // redirect
            return false;
        }
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
                    jQuery("#sendButton_ref_data").show();
                    jQuery("#loading").hide();
                    alert(json.Message);
                    return false;
                }
                else
                {
                    if(json.row_info != '')
                        {
                            
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
        }; 
        jQuery("#ref_data_add_form").ajaxForm(options);
        jQuery("#sendButton_ref_data").click(function() {
            console.log(ref_rules);
            jQuery('#ref_data_add_form').jqxValidator({
                    rules: ref_rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    jQuery("#sendButton_ref_data").hide();
                    jQuery("#loading").show();
                    jQuery("#ref_data_add_form").submit();
                }
            }
            jQuery('#ref_data_add_form').jqxValidator('validate', validationResult);     
        });
</script>
<div id="notify_details" style="visibility:hidden;">
    <div><strong>Notification Details</strong></div>
        <form method="POST" name="" id=""  style="margin:0px;">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div id="loading_preview_n" style="text-align:center">
                <span id="loading_p_n" style="display:none">Please wait... <img src="<?=base_url()?>home/get_file/xyzzzsdsbbbgifl" align="bottom"></span>
            </div>
                <span id="main_body_notify"></span>
                <br/>
                <div id="close_btn_row_n" style="text-align:center;margin-bottom:30px;width:100%;">
                    <input type="button" align="center" class="buttonclose" id="codeOKn" value="Close" />
                </div>
            
        </form>
    </div>
<div id="content" style="margin-bottom: 40px;">


