<?
require_once('common.php');
if(isset($_REQUEST['User_Id'])){$User_Id=$_REQUEST['User_Id'];}else{$User_Id=0;}
$sql = ("update `usr_log_histry` set Last_activities = '".time()."' where UserId = '".$User_Id."' order by Id DESC LIMIT 1");
mysql_query($sql);


?>