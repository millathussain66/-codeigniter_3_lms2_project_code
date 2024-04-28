<?php
//session_start();
date_default_timezone_set('Asia/Dhaka');
define('BASE_URL',base_url().'settings/');
define('BASE_URL_CSS',base_url().'setting/assets/');
define('BASE_URL_IMAGE',base_url().'setting/assets/');
if(!isset($_SESSION['pop_user_id']))
{
?>
	<script>
		window.top.close();
    </script>

<?php 
	exit;
}

define('USER_TB_NAME',				'users_info' 	);
define('USER_NAME',					'name' 	);
define('USER_ID_NAME',				'user_id' 	);
define('USER_LOCK_STS',				'lock_status' 	);
define('USER_BLOCK_STS',			'block_status' 	);
define('USER_ID',					'id' 			);
define('USER_TB_STS_NAME',			'data_status' 	);
define('USER_TB_BRANCH_ID',			'branch_code' 	);
define('BRANCH_TB_NAME',			'ref_branch_sol' 	);
define('BRANCH_NAME',				'name' 	);
define('BRANCH_CODE',				'code' 	);
define('BRANCH_ID',					'id' 			);
define('BRANCH_STS',				'data_status' 	);
?>