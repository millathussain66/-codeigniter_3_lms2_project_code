<div id="menu">
    <ul>
        <li><a 
			href="<?=base_url()?>">Home</a></li>
        <li><a <? if($option=='default_pass'){echo 'id="selected"';}?>
			href="<?=BASE_URL?>default_pass">Password & User ID Rules</a></li>
        <li><a <? if($option=='SIT'){echo 'id="selected"';}?>
			href="<?=BASE_URL?>sit">Session Idle Time</a></li>
		<li><a <? if($option=='APC'){echo 'id="selected"';}?>
			href="<?=BASE_URL?>apc">Api Config</a></li>
       <!-- <li><a <? //if($option=='IP_MAP'){echo 'id="selected"';}?>
			href="<?//BASE_URL?>ip_map.php">IP Mapping</a></li>-->
        <li><a <? if($option=='Act_r'){echo 'id="selected"';}?>
			href="<?=BASE_URL?>activities_report">User Activities Report</a></li>
        <li><a <? if($option=='list_r'){echo 'id="selected"';}?>
			href="<?=BASE_URL?>user_list_report">User List</a></li>
        <li><a <? if($option=='log_r'){echo 'id="selected"';}?>
			href="<?=BASE_URL?>user_log_report">User Log Report</a></li>
		<li><a <? if($option=='client'){echo 'id="selected"';}?>
			href="<?=BASE_URL?>client_info">Project Information</a></li>
    </ul>
</div>