<!--<div style=" margin: 5px auto;">&nbsp;&nbsp;&nbsp;</div>-->
<?
 $CI =& get_instance();
 $str = "Select * from project_info where id=1";
 $query = $CI->db->query($str)->row();
?>
</div><!--end content -->

<div id="footer" style="background-color: #ffffff;border:solid 1px #2a798c;color:#ffffff;height:30px;width:99.9%;z-index: 999;">
	<div style="float:left; font-size:16px; background-image: url('<?=base_url()?>home/get_file/xyzzzsdsbbbpngfol');background-repeat:no-repeat;height:40px;width:24%;padding-left:1%;padding-top:5px;">LMS v.<?=$query->project_version?></div>
	<div style="float:left;height:40px; width:50%;text-align: center;color: #000000;">
		<? if($this->session->userdata('ast_user'))
            {
                // print_r($this->session->userdata['ast_user']); exit;
        ?>
		<table class="usermenuinfo" border="0" style="margin:5px auto;">
			<tr>
				<td style="color:#000000">
					<?=$this->session->userdata['ast_user']['user_name']?>(
					<?=$this->session->userdata['ast_user']['user_full_id']?>)
				</td>				
				<td style="color:#000000"><?=date('d-M-Y l ')?><span id="autotimechange"></span></td>
				<td style="color:#000000">Group :<?=$this->session->userdata['ast_user']['group_name']?>, Region :
					<?=$this->session->userdata['ast_user']['region_name']?>
				</td>
			</tr>
		</table>
			<script src="<?=base_url()?>home/get_file/xyzzzsdsbbbjst" type="text/javascript" charset="utf-8"></script>
		<? }?>
	</div>
	<div style="float:left; font-size:16px; background-image: url('<?=base_url()?>home/get_file/xyzzzsdsbbbpngfor');background-repeat:no-repeat;height:40px;width:24%;background-position:100% 0;color:#ffffff;text-align:right;padding-right:1%;padding-top:5px;">Developed by <a style="color: #fcc55f;text-decoration: none;" href="https://www.mmtvbd.com/" target="_blank">MicroMac</a></div>
	
</div> <!--end wrapper -->

<script>

jQuery('#jqxGrid2').ready(function() {

    jQuery('#loding').fadeOut(); // will first fade out the loading animation 
    jQuery('#preloader').delay( 300 ).fadeOut( 'slow'); // will fade out the white DIV that covers the website. 
    jQuery('#footer_loader_body').css( { 'display': 'block' } );
    
});
</script>
</body>
</html>