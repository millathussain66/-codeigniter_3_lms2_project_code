                    <!---- Left Side Menu Start ------>
                    <style>
                        #active{
                            background: #93CDDD!important;
                            font-weight: bold;
                        }
                    </style>
                    <div id='navigationTitle' class='navigationTitle' >
                        <div style='float: left; margin-right: 4px;' class="widget-icon jqx-navigationbar-icon"></div>        
                            <a>Bill Processing</a>
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <? if(VIEWCOURTFEE==1){?>
                                <li class='navigationItemContent' <?php if($operation_name=='court_fee'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/court_fee">Court Fee</a>
                                </li>
                            <?php } ?>
                            <? if(VIEWCOURTFEERETURN==1){?>
                                <li class='navigationItemContent' <?php if($operation_name=='court_return'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/court_return">Court Fee Return</a>
                                </li>
                            <?php } ?>
                            <? if(VIEWCOURTFEEADJUST==1){?>
                                <li class='navigationItemContent' <?php if($operation_name=='court_adjust'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/court_adjust">Court Fee Adjustment</a>
                                </li>
                            <?php } ?>
                            <? if(VIEWLAWYERBILL==1){?>
                                 <li class='navigationItemContent' <?php if($operation_name=='lawyer_bill'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/lawyer_bill">Lawyer Bill</a>
                                </li>
                            <?php } ?>
                           <? if(VIEWCOURTENTER==1){?>
                            <li class='navigationItemContent' <?php if($operation_name=='court_enter'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/court_enter">Court Entertainment</a>
                                </li>
                            <?php } ?>
                            <? if(VIEWSTAFFCONV==1){?>
                                <li class='navigationItemContent' <?php if($operation_name=='staff_con'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/staff_con">Staff Conveyance</a>
                                </li>
                            <?php } ?>
                            <? if(VIEWPAPER==1){?>
                                <li class='navigationItemContent' <?php if($operation_name=='paper_bill'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/paper_bill">Paper Bill</a>
                                </li>
                            <?php } ?>
                            <? if(VIEWOTHERS==1){?>
                                <li class='navigationItemContent' <?php if($operation_name=='other'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/other">Other/Miscellaneous</a>
                                </li>
                            <?php } ?>
                            <? if(VIEWLAWYERBILLHC==1){?>
                                 <li class='navigationItemContent' <?php if($operation_name=='lawyer_bill_hc'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Bill_ho/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/lawyer_bill_hc">Lawyer Bill HC</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->