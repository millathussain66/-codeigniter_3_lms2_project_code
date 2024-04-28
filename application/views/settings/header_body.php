<body>
<div id="wrapper">
<div id="header">
	<div style="width:100%;height:52px;margin:0;padding:0;background-color:#fff;text-align:left;font-family:calibri; font-size:13px;">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <?php
            $str = "Select * from project_info where id=1";
            $query = $this->db->query($str)->row();
        ?>
        <div style="width:30%;float:left;padding:0px;">
       <strong style=" color:#0b1562; font-size:26px">Litigation Management  System</strong>
		</div>
		
		

        <div style="float:left;text-align:center;padding-top: 5px;color:#000">
            <? if($this->session->userdata('ast_user'))
            {
                // print_r($this->session->userdata['ast_user']); exit;
            ?>
                <table class="usermenuinfo" border="0">
                    <tr><td style="color:#1CAD4A"><?=$this->session->userdata['ast_user']['user_name']?> (<?=$this->session->userdata['ast_user']['user_full_id']?>)</td><td><?=$this->session->userdata['ast_user']['group_name']?>, Dept: <?=$this->session->userdata['ast_user']['dept_name']?></td>
                    </tr>
                    <tr><td><?=$this->session->userdata['ast_user']['branch_name']?> (<?=$this->session->userdata['ast_user']['user_branch_code']?>)</td><td style="color:blue"><?=date('d-M-Y l ')?> <span id="autotimechange"></span></td>
                    <td></td>
                    </tr>
                </table>
            <?php    
            ?>
            <?php
            ?>
                <script src="<?=base_url()?>home/get_file/xyzzzsdsbbbjst" type="text/javascript" charset="utf-8"></script>
            <? }?>

			
		</div>
    
        <div style="float:right;padding-top:20px;padding-right:20px"><span style="font-weight:bold;">
            <? if($this->session->userdata('ast_user')){?>        		
				<a onClick="return deleteItem('Are you sure want to sign out?');" style="color:#000" href="<?=base_url()?>home/logout"> 
					<img  border="0" src="<?=base_url()?>home/get_file/xyzzzsdsbbbpnge" align="absmiddle" height="16" style="margin-right:2px;" title="Logout" alt="Logout"/>
					Logout
				</a>
			<? }?>
            </span>
		</div> 
        
       
	</div>
    
</div>