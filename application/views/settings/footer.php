<!--<div style=" margin: 5px auto;">&nbsp;&nbsp;&nbsp;</div>-->
<?
 $str = "SELECT * from project_info where id=1";
 $query = $this->db->query($str)->row();
?>
</div><!--end content -->
<div id="footer" style="background-color:#008F40;font-family:calibri">
<p class="footer" >
<span style="float:left;color:#ffffff;font-size:13px">LMS v.<?=$query->project_version?></span>
<span style="float:right;color:#ffffff;font-size:13px">Developed by <a href="http://www.mmtvbd.com" title="MicroMac Techno Vally Ltd." style="color:#7FFFD4	" target="_blank"><strong>MicroMac</strong></a></span></div>
</div> <!--end wrapper -->
</body>
</html>