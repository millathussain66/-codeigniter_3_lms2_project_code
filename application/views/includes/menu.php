 <style>
 .mgrpSelected{
	background: none repeat scroll 0 0  #cfdde9;
    border-color: #5e8cb3;
	color:#000000;
 }
 .mcatSelected{
	background: none repeat scroll 0 0 #96b4cf;
    border-color: #999999;
 }
 .topmenu {
	padding:3px!important;background-color: rgb(0, 114, 188)!important;background-image: linear-gradient(141deg, #05286e 0%, #0072c4 51%, #05286e 75%)!important;	border: solid transparent;
 }
	 .abc {background-color:transparent!important;}
 </style>
 <script type="text/javascript">
    jQuery(document).ready(function () {

        var theme ='energyblue';

        //alert(theme);

        jQuery("#jqxMenu").jqxMenu({ height: '30px',  showTopLevelArrows: false, theme: theme });

        jQuery("#jqxMenu").css({"visibility": "visible"});

    	//width: (jQuery(window).width())+'px',

		<? 	if(!empty($menu_group)){?>

		jQuery('#jqxMenuUl li#mgrp_<?=$menu_group?>').addClass('mgrpSelected');

		<? 	}else{?>

		jQuery('#jqxMenuUl li:first').addClass('mgrpSelected');

		<? 	}

			if(!empty($menu_cat)){?>

		jQuery('#mcat_<?=$menu_group?>_<?=$menu_cat?>').addClass('mcatSelected');

		<? 	}?>



    });
</script>
            <div id="jqxMenu" style="width:99.25%;margin:4px auto 0;visibility: hidden;">
                <ul id="jqxMenuUl" class="topmenu">
                   	<li class="abc" style="border:1px solid #043077"><a href="<?=base_url()?>home/home_wc"><img src="<?=base_url()?>images/home-icon.png" style="width: auto;height: 18px;" /></a></li>
                    		<!--<li id="mgrp_1"><a href="#Home">Home</a></li>-->

                     <?	$sub1_sl_operations_bar_ary_cnt=0; $links_arrow_gName='Home';	$links_arrow_gcName='';
					 	$sub1_sl_operations='';	$sub1_sl_operations_link_ids='';
					 	$sub1_sl_orders='';	$sub1_sl_names='';$opp='';
						$CI =& get_instance();
						$CI->load->model('User_model', '', true);
						$result=$CI->User_model->get_link_group($CI->session->userdata['ast_user']['user_id']);

						foreach($result as $row)
						{?>
							<li id="mgrp_<?=$row->id?>">
							 	<? $g_ancr=''; if($row->has_child==0){echo '<a href="'.base_url().'index.php/'.$row->url_prefix.'/'.$row->id.'">'; $g_ancr='</a>';} echo $row->name.$g_ancr;
								$sub1_slc_Names_ary=explode("#",$row->sub1_slc_names);
								$sub1_nav_sts_ary=explode("#",$row->sub1_grid_nav_sts);
								$sub1_slc_url_prefixs_ary=explode("#",$row->sub1_slc_url_prefixs);
								$sub1_slc_has_childs_ary=explode("#",$row->sub1_slc_has_childs);

								$lnk_cat_id_ary=explode("#",$row->sub1_slc_ids);
								$lnk_cat_id_ary_cnt=count($lnk_cat_id_ary);

								$sub1_sl_operations_ary=explode("#",$row->sub1_sl_operations);
								$sub1_sl_ids_ary=explode("#",$row->sub1_sl_ids);

								if($row->has_child==1 && $lnk_cat_id_ary_cnt>0){?>
                                <ul style='width: 188px;'>                                	
                                	<? for($cat_l_i=0; $cat_l_i<$lnk_cat_id_ary_cnt; $cat_l_i++){
											if($lnk_cat_id_ary[$cat_l_i]==$menu_cat)
											{

												$sub1_sl_operations=$sub1_sl_operations_ary[$cat_l_i];
												$sub1_sl_operations_link_ids=$sub1_sl_ids_ary[$cat_l_i];
												$links_arrow_gName=$row->name;
												$links_arrow_gcName=$sub1_slc_Names_ary[$cat_l_i];
											}
											$sub1_sl_names_ary=explode("#",$row->sub1_sl_names);
											$sub1_sl_names=$sub1_sl_names_ary[$cat_l_i];

											$sub1_sl_orders_array=explode("#",$row->sub1_sl_orders);
											$sub1_sl_orders=$sub1_sl_orders_array[$cat_l_i];

											$sub1_sl_url_prefixs_array=explode("#",$row->sub1_sl_url_prefixs);
											$sub1_sl_url_prefixs=$sub1_sl_url_prefixs_array[$cat_l_i];

											$sys_lik_ids=$sub1_sl_ids_ary[$cat_l_i];
											$sys_lik_ids_ary=explode("|",$sys_lik_ids);
										?>

										<?php if ($sub1_nav_sts_ary[$cat_l_i]==0): ?>
											<? if($sub1_slc_has_childs_ary[$cat_l_i]==2){?>
		                                    	<li type='separator'></li>
		                                        <li id="mcat_<?=$row->id.'_'.$lnk_cat_id_ary[$cat_l_i]?>"><?=$sub1_slc_Names_ary[$cat_l_i]?>
		                                            <ul style='width: 220px;'>
		                                                <?
														$sub1_sl_orders_bar_ary=explode("|",$sub1_sl_orders);
														$sub1_sl_names_bar_ary=explode("|",$sub1_sl_names);
														$sub1_sl_url_prefixs_bar_ary=explode("|",$sub1_sl_url_prefixs);
														for($op_links=0; $op_links<count($sub1_sl_names_bar_ary); $op_links++){ if($sub1_sl_orders_bar_ary[$op_links]!=0){?>
		                                                <li ><a href="<?=base_url().$sub1_sl_url_prefixs_bar_ary[$op_links].'/'.$row->id.'/'.$lnk_cat_id_ary[$cat_l_i].'/'.$sys_lik_ids_ary[0]?>"><?=$sub1_sl_names_bar_ary[$op_links]?></a></li>

		                                                <? }}?>
		                                            </ul>
		                                        </li>


		                                    <? }else{?>
		                                     <li id="mcat_<?=$row->id.'_'.$lnk_cat_id_ary[$cat_l_i]?>"><a href="<?=base_url().$sub1_slc_url_prefixs_ary[$cat_l_i].'/'.$row->id.'/'.$lnk_cat_id_ary[$cat_l_i].'/'.$sys_lik_ids_ary[0]?>"><?=$sub1_slc_Names_ary[$cat_l_i]?></a></li>
		                                    <? }?>
										<?php endif ?>
	                                    
                                    <? }?>
                                </ul>
                              <? }?>
                           </li>

					 <? }?>
                     <? if($this->session->userdata['ast_user']['login_status'])
					 {?>
					 <li><a href="<?=base_url()?>LMS_User_Manual v1.pdf" target="blank">User Manual</a></li> 
                     <? }?>
                </ul>
            </div>


 	<?
		$DELETE=0;
		$RESET=0;
		$VIEWID=0;

		$ADD=0;
		$EDIT=0;
		$VIEW=0;
		$BLOCK=0;
		$UNBLOCK=0;
		$SETRIGHT=0;
		$RESETPASS=0;
		$VERIFY=0;
		$PRINT=0;
		$APPROVE=0;
		$AUCTIONSTS=0;
		$SENDTOCHECKER=0;
		$DOWNLOADXML=0;
		$DOWNLOADEXCEL=0;
		$FILOCK=0;
		$RMLOCK=0;
		$TSDLOCK=0;
		$SENDTOACKOWLEDGMENT=0;
		$DOWNLOADLEGALNOTICE=0;
		$DOWNLOADLEGALNOTICEPDF=0;
		$ACKOWLEDGMENTREQUEST=0;
		$LEGALNOTICESENT=0;
		$UPDATEFILEUPLOAD=0;
		$SRTOCORRESPONDINGBANK=0;
		$CORRBANKREPLY=0;
		$RESPONSEREQUEST=0;
		$RMCONFIRM=0;
		$LCISSUE=0;
		$LCCONFIRM=0;
		$BILLENTRY=0;
		$FITOTSD=0;
		$TSDRETURN=0;
		$PAYCONFIRM=0;
		$AMMREMAKE=0;
		$AMMRECHECK=0;
		$LCCLOSE=0;
		$LCCANCEL=0;
		$RMRETURN=0;
		$RECOMMEND=0;
		$PREPAREPAPERNOTICE=0;
		$AUCTIONVERIFY=0;
		$BIDDERUPDATE=0;
		$AUCTIONMEMO=0;
		$PAPERNOTICE=0;
		$SENDTOLEGAL=0;
		$RESPONSE=0;
		$PAPERINFO=0;
		$UPDATEBIDDERINFO=0;
		$SENDTOHOOPS=0;
		$FILEPROCESSING=0;
		$ADDITIONALINPUT=0;
		$LAWYERNOTIFICATIONSENT=0;
		$SUITFILLING=0;
		$SENDFORAUTHORIZATION=0;
		$APPROVEAUTHORIZATION=0;
		$SAVE=0;
		$DOWNLOAD=0;
		$PRINTSTATEMENT=0;
		$UPLOADRECOVERY=0;
		$UPDATERECOVERY=0;
		$SUPERVISORAPPROVAL=0;
		$SUITFILECONFIRM=0;
		$REASSIGN=0;
		$CLOSEACCOUNT=0;
		$BULKRECOMMEND=0;
		$SENDTOFINANCE=0;
		$WITHDRAWN=0;
		$SUITFILEEDIT=0;
		$SUITFILEDELETE=0;
		$RECASEFILEADD=0;
		$RECASEFILEEDIT=0;
		$RECASEFILEDELETE=0;
		$RECASEFILECONFIRM=0;
		$CASEDETAILSVIEW=0;
		$CASESTSADD=0;
		$CASESTSEDIT=0;
		$CASESTSDELETE=0;
		$CASESTSSENDTOCHECKER=0;
		$CASESTSVERIFY=0;
		$STATEMENTRT=0;
		$STATEMENTRTCOURT=0;
		$STATEMENTCLASSIFIED=0;
		$CASEFILEDSETTLED=0;
		$CASEFILEDSETTLEDSEG=0;
		$INTERNALREPORT=0;
		$QUARTERLYSTATEMENTRT=0;
		$TOTALCASES=0;
		$AUCTIONCONFIRM=0;
		$REIMBURSMENT=0;
		$APPROVEREASSIGN=0;
		$VERIFYFINANCE=0;
		$UPDATENEXTDATE=0;
		$CERTIFICATEUPLOAD=0;
		$VIEWCOURTFEERETURN=0;
		$VIEWCOURTENTER=0;
		$VIEWSTAFFCONV=0;
		$VIEWPAPER=0;
		$VIEWOTHERS=0;
		$VIEWCOURTFEE=0;
		$VIEWLAWYERBILL=0;
		$VIEWLAWYERBILLHC=0;
		$VIEWCOURTFEEADJUST=0;
		$PUTUP=0;
		$PUTUPAPPROVE=0;
		$ENHANCEENABLE=0;
		$ENHANCE=0;
		$VIEWMEMO=0;
		$HOLD=0;
		$EDITCOURTFEE=0;
		$EDITPAPERVENDOR=0;
		$EDITSTAFF=0;
		$EDITCOURT_ENT=0;
		$OTHERSEDIT=0;
		
		
		
		$sub1_sl_operations_bar_ary=explode("|",$sub1_sl_operations);$unreconciled_stld=0;
		$sub1_sl_operations_bar_ary_cnt=count($sub1_sl_operations_bar_ary);
		$sub1_sl_operations_link_ids_ary=explode("|",$sub1_sl_operations_link_ids);
		// echo "<pre>";
		// print_r($sub1_sl_operations_bar_ary);
		// die();
		for($op_links=0; $op_links<$sub1_sl_operations_bar_ary_cnt; $op_links++){

			if($sub1_sl_operations_bar_ary[$op_links]=='sendtoacknowledgement'){
				$SENDTOACKOWLEDGMENT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='acknowledgementRequest'){
				$ACKOWLEDGMENTREQUEST=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='delete'){
				$DELETE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='add'){
				 $ADD=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='edit'){
				 $EDIT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='view'){
				 $VIEW=1;
				 $VIEWID=$sub1_sl_operations_link_ids_ary[$op_links];
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='block'){
				 $BLOCK=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='reset'){
				 $RESET=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='unblock'){
				 $UNBLOCK=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='set_right'){
				 $SETRIGHT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='reset_pass'){
				 $RESETPASS=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='verify'){
				 $VERIFY=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='delete_verify'){
				 $DELVERIFY=1;
			}			
			if($sub1_sl_operations_bar_ary[$op_links]=='print'){
				 $PRINT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='approve'){
				 $APPROVE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='sendtochecker'){
				 $SENDTOCHECKER=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='legalnoticesent'){
				 $LEGALNOTICESENT=1;
			}		
			if($sub1_sl_operations_bar_ary[$op_links]=='updatefileupload'){
				 $UPDATEFILEUPLOAD=1;
			}	
			if($sub1_sl_operations_bar_ary[$op_links]=='rmlock'){
				 $RMLOCK=1;
			}
			
			if($sub1_sl_operations_bar_ary[$op_links]=='halt'){
				 $HALT=1;
			}			
			if($sub1_sl_operations_bar_ary[$op_links]=='responserequest'){
				 $RESPONSEREQUEST=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='rmconfirm'){
				 $RMCONFIRM=1;
			}
			
			if($sub1_sl_operations_bar_ary[$op_links]=='billentry'){
				 $BILLENTRY=1;
			}			
			if($sub1_sl_operations_bar_ary[$op_links]=='ammremake'){
				 $AMMREMAKE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='ammrecheck'){
				 $AMMRECHECK=1;
			}			
			if($sub1_sl_operations_bar_ary[$op_links]=='recommend'){
				 $RECOMMEND=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='auctionsts'){
				 $AUCTIONSTS=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='preparepapernotice'){
				 $PREPAREPAPERNOTICE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='auctionverify'){
				 $AUCTIONVERIFY=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='bidderupdate'){
				 $BIDDERUPDATE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='downloadlegalnotice'){
				 $DOWNLOADLEGALNOTICE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='downloadlegalnoticepdf'){
				 $DOWNLOADLEGALNOTICEPDF=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='papernotice'){
				 $PAPERNOTICE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='auctionmemo'){
				 $AUCTIONMEMO=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='sendtolegal'){
				 $SENDTOLEGAL=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='response'){
				 $RESPONSE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='paperinfo'){
				 $PAPERINFO=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='updatebidderinfo'){
				 $UPDATEBIDDERINFO=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='sendtohoops'){
				 $SENDTOHOOPS=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='fileprocessing'){
				 $FILEPROCESSING=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='additionalinput'){
				 $ADDITIONALINPUT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='lawyernotificationsent'){
				 $LAWYERNOTIFICATIONSENT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='suitfilling'){
				 $SUITFILLING=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='sendforauthorization'){
				 $SENDFORAUTHORIZATION=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='approveauthorization'){
				 $APPROVEAUTHORIZATION=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='save'){
				 $SAVE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='download'){
				 $DOWNLOAD=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='printstatement'){
				 $PRINTSTATEMENT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='updaterecovery'){
				 $UPDATERECOVERY=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='uploadrecovery'){
				 $UPLOADRECOVERY=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='supervisorapproval'){
				 $SUPERVISORAPPROVAL=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='suitfileconfirm'){
				 $SUITFILECONFIRM=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='reassign'){
				 $REASSIGN=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='closeaccount'){
				 $CLOSEACCOUNT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='bulkrecommend'){
				 $BULKRECOMMEND=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='sendtofinance'){
				 $SENDTOFINANCE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='withdrawn'){
				 $WITHDRAWN=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='suitfileedit'){
				 $SUITFILEEDIT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='suitfiledelete'){
				 $SUITFILEDELETE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='recasefileadd'){
				 $RECASEFILEADD=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='recasefileedit'){
				 $RECASEFILEEDIT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='recasefiledelete'){
				 $RECASEFILEDELETE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='recasefileconfirm'){
				 $RECASEFILECONFIRM=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='casedetailsview'){
				 $CASEDETAILSVIEW=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='casestsadd'){
				 $CASESTSADD=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='casestsedit'){
				 $CASESTSEDIT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='casestsdelete'){
				 $CASESTSDELETE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='casestssendtochecker'){
				 $CASESTSSENDTOCHECKER=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='casestsverify'){
				 $CASESTSVERIFY=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='statement_rt'){
				 $STATEMENTRT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='statement_rt_court'){
				 $STATEMENTRTCOURT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='statement_classified'){
				 $STATEMENTCLASSIFIED=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='case_filed_settled'){
				 $CASEFILEDSETTLED=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='case_filed_settled_segment'){
				 $CASEFILEDSETTLEDSEG=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='internal_repport'){
				 $INTERNALREPORT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='quarterly_statement_rt'){
				 $QUARTERLYSTATEMENTRT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='total_cases'){
				 $TOTALCASES=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='auctionconfirm'){
				 $AUCTIONCONFIRM=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='reimbursement'){
				 $REIMBURSMENT=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='approvereassign'){
				 $APPROVEREASSIGN=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='verifyfinance'){
				 $VERIFYFINANCE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='updatenextdate'){
				 $UPDATENEXTDATE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='certificateupload'){
				 $CERTIFICATEUPLOAD=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewcourtfeereturn'){
				 $VIEWCOURTFEERETURN=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewcourtenter'){
				 $VIEWCOURTENTER=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewstaffconv'){
				 $VIEWSTAFFCONV=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewpaper'){
				 $VIEWPAPER=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewothers'){
				 $VIEWOTHERS=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewcourtfee'){
				 $VIEWCOURTFEE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewlawyerbill'){
				 $VIEWLAWYERBILL=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewlawyerbillhc'){
				 $VIEWLAWYERBILLHC=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewcourtfeeadjust'){
				 $VIEWCOURTFEEADJUST=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='putup'){
				 $PUTUP=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='putupapprove'){
				 $PUTUPAPPROVE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='enhanceenable'){
				 $ENHANCEENABLE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='enhance'){
				 $ENHANCE=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='viewmemo'){
				 $VIEWMEMO=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='hold'){
				 $HOLD=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='editcourtfee'){
				$EDITCOURTFEE=1;
		    }
			if($sub1_sl_operations_bar_ary[$op_links]=='editpapervendor'){
				$EDITPAPERVENDOR=1;
			}
			if($sub1_sl_operations_bar_ary[$op_links]=='editstaff'){
				$EDITSTAFF=1;
			}

			if($sub1_sl_operations_bar_ary[$op_links]=='editcourt_ent'){
				$EDITCOURT_ENT=1;
			}

			if($sub1_sl_operations_bar_ary[$op_links]=='othersedit'){
				$OTHERSEDIT=1;
			}


			

		}


		define('DELETE',$DELETE);
		define('ADD',$ADD);
		define('EDIT',$EDIT);
		define('VIEW',$VIEW);
		define('VIEWID',$VIEWID);
		define('BLOCK',$BLOCK);
		define('RESET',$RESET);
		define('UNBLOCK',$UNBLOCK);
		define('SETRIGHT',$SETRIGHT);
		define('RESETPASS',$RESETPASS);
		define('VERIFY',$VERIFY);
		define('LEGALNOTICESENT',$LEGALNOTICESENT);
		define('UPDATEFILEUPLOAD',$UPDATEFILEUPLOAD);
		define('PRINTS',$PRINT);
		define('APPROVE',$APPROVE);
		define('SENDTOCHECKER',$SENDTOCHECKER);
		define('SENDTOACKOWLEDGMENT',$SENDTOACKOWLEDGMENT);
		define('ACKOWLEDGMENTREQUEST',$ACKOWLEDGMENTREQUEST);
		define('RESPONSEREQUEST',$RESPONSEREQUEST);
		define('RMCONFIRM',$RMCONFIRM);
		define('BILLENTRY',$BILLENTRY);
		define('AMMREMAKE',$AMMREMAKE);
		define('AMMRECHECK',$AMMRECHECK);
		define('RECOMMEND',$RECOMMEND);
		define('AUCTIONSTS',$AUCTIONSTS);
		define('PREPAREPAPERNOTICE',$PREPAREPAPERNOTICE);
		define('AUCTIONVERIFY',$AUCTIONVERIFY);
		define('BIDDERUPDATE',$BIDDERUPDATE);
		define('DOWNLOADLEGALNOTICE',$DOWNLOADLEGALNOTICE);
		define('DOWNLOADLEGALNOTICEPDF',$DOWNLOADLEGALNOTICEPDF);
		define('PAPERNOTICE',$PAPERNOTICE);
		define('AUCTIONMEMO',$AUCTIONMEMO);
		define('SENDTOLEGAL',$SENDTOLEGAL);
		define('RESPONSE',$RESPONSE);
		define('PAPERINFO',$PAPERINFO);
		define('UPDATEBIDDERINFO',$UPDATEBIDDERINFO);
		define('SENDTOHOOPS',$SENDTOHOOPS);
		define('FILEPROCESSING',$FILEPROCESSING);
		define('ADDITIONALINPUT',$ADDITIONALINPUT);
		define('LAWYERNOTIFICATIONSENT',$LAWYERNOTIFICATIONSENT);
		define('SUITFILLING',$SUITFILLING);
		define('SENDFORAUTHORIZATION',$SENDFORAUTHORIZATION);
		define('APPROVEAUTHORIZATION',$APPROVEAUTHORIZATION);
		define('SAVE',$SAVE);
		define('DOWNLOAD',$DOWNLOAD);
		define('PRINTSTATEMENT',$PRINTSTATEMENT);
		define('UPLOADRECOVERY',$UPLOADRECOVERY);
		define('UPDATERECOVERY',$UPDATERECOVERY);
		define('SUPERVISORAPPROVAL',$SUPERVISORAPPROVAL);
		define('SUITFILECONFIRM',$SUITFILECONFIRM);
		define('REASSIGN',$REASSIGN);
		define('CLOSEACCOUNT',$CLOSEACCOUNT);
		define('BULKRECOMMEND',$BULKRECOMMEND);
		define('SENDTOFINANCE',$SENDTOFINANCE);
		define('WITHDRAWN',$WITHDRAWN);
		define('SUITFILEEDIT',$SUITFILEEDIT);
		define('SUITFILEDELETE',$SUITFILEDELETE);
		define('RECASEFILEADD',$RECASEFILEADD);
		define('RECASEFILEEDIT',$RECASEFILEEDIT);
		define('RECASEFILEDELETE',$RECASEFILEDELETE);
		define('RECASEFILECONFIRM',$RECASEFILECONFIRM);
		define('CASEDETAILSVIEW',$CASEDETAILSVIEW);
		define('CASESTSADD',$CASESTSADD);
		define('CASESTSEDIT',$CASESTSEDIT);
		define('CASESTSDELETE',$CASESTSDELETE);
		define('CASESTSSENDTOCHECKER',$CASESTSSENDTOCHECKER);
		define('CASESTSVERIFY',$CASESTSVERIFY);
		define('STATEMENTRT',$STATEMENTRT);
		define('STATEMENTRTCOURT',$STATEMENTRTCOURT);
		define('STATEMENTCLASSIFIED',$STATEMENTCLASSIFIED);
		define('CASEFILEDSETTLED',$CASEFILEDSETTLED);
		define('CASEFILEDSETTLEDSEG',$CASEFILEDSETTLEDSEG);
		define('INTERNALREPORT',$INTERNALREPORT);
		define('QUARTERLYSTATEMENTRT',$QUARTERLYSTATEMENTRT);
		define('TOTALCASES',$TOTALCASES);
		define('AUCTIONCONFIRM',$AUCTIONCONFIRM);
		define('REIMBURSMENT',$REIMBURSMENT);
		define('APPROVEREASSIGN',$APPROVEREASSIGN);
		define('VERIFYFINANCE',$VERIFYFINANCE);
		define('UPDATENEXTDATE',$UPDATENEXTDATE);
		define('CERTIFICATEUPLOAD',$CERTIFICATEUPLOAD);
		define('VIEWCOURTFEERETURN',$VIEWCOURTFEERETURN);
		define('VIEWCOURTENTER',$VIEWCOURTENTER);
		define('VIEWSTAFFCONV',$VIEWSTAFFCONV);
		define('VIEWPAPER',$VIEWPAPER);
		define('VIEWOTHERS',$VIEWOTHERS);
		define('VIEWCOURTFEE',$VIEWCOURTFEE);
		define('VIEWLAWYERBILL',$VIEWLAWYERBILL);
		define('VIEWLAWYERBILLHC',$VIEWLAWYERBILLHC);
		define('VIEWCOURTFEEADJUST',$VIEWCOURTFEEADJUST);
		define('PUTUP',$PUTUP);
		define('PUTUPAPPROVE',$PUTUPAPPROVE);
		define('ENHANCEENABLE',$ENHANCEENABLE);
		define('ENHANCE',$ENHANCE);
		define('VIEWMEMO',$VIEWMEMO);
		define('HOLD',$HOLD);
		define('EDITCOURTFEE',$EDITCOURTFEE);
		define('EDITPAPERVENDOR',$EDITPAPERVENDOR);
		define('EDITSTAFF',$EDITSTAFF);
		define('EDITCOURT_ENT',$EDITCOURT_ENT);

		define('OTHERSEDIT',$OTHERSEDIT);

?>

<div  style="width:100%; padding:0px; height:auto">
	<?php if ($links_arrow_gName!='Home'): ?>
		<div id="examplePath" class="examplePath" style="margin-left: 5px; margin-top:3px;color:#002596; float: left; font-family:arial; font-size:12px">
			<div id="pathElement">
				<div class="jqx-icon-arrow-right" style="color:#002596; float: left; width: 15px; height: 15px;"></div>
				<span style="margin-left: 2px; float: left;"><?=$links_arrow_gName?></span>
				<?php if ($links_arrow_gcName!=''): ?>
					<div class="jqx-icon-arrow-right" style="float: left; width: 16px; height: 16px;"></div>
					<span style="margin-left: 2px; float: left;"><?=$links_arrow_gcName?></span>
					<div class="jqx-icon-arrow-right" style="float: left; width: 16px; height: 16px;"></div>
				<?php endif ?>
			</div>
		</div>
	<?php endif ?>
	<div id="error" style="margin-left: 50px;margin-right:3px; padding:0 80px 0 80px; float: right;  height:20px;display:none;" align="center"></div>
</div>
<div style="clear:both"></div>