                    <!---- Left Side Menu Start ------>
                    <style>
                        #active{
                            background: #93CDDD!important;
                            font-weight: bold;
                        }
                    </style>
                    <div id='navigationTitle' class='navigationTitle' >
                        <!-- <div style='float: left; ' class="widget-icon jqx-navigationbar-icon"></div>        
                        <a>High Court Matter</a> -->
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <li class='navigationItemContent' <?php if($submenu=='case_menagement' || $submenu==NULL){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/legal_file_process/view/9/32/226/case_menagement">Case Management</a>
                            </li>
                            <li class='navigationItemContent' <?php if($submenu=='suit_file'){echo 'id="active"';} ?> ><a href="<?=base_url()?>index.php/legal_file_process/suit_file_view/9/32/226/suit_file">Suit Filing Information</a>
                            </li>
                            <li class='navigationItemContent' <?php if($submenu=='re_case'){echo 'id="active"';} ?> ><a href="<?=base_url()?>index.php/legal_file_process/recase_file_view/9/32/226/re_case">Arising From Original Case</a>
                            </li>
                            <li class='navigationItemContent' <?php if($submenu=='case_sts'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/legal_status_expense/view/<?=$menu_group?>/35/240/case_sts">Case Status Update</a>
                            </li>
                            <li class='navigationItemContent' <?php if($submenu=='case_details'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/legal_file_process/case_details_view/9/32/226/case_details">Case Details Info</a>
                            </li>
                            <li class='navigationItemContent' <?php if($submenu=='auth_request'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/authorization_request/view/9/34/236/auth_request">Authorization Request</a>
                            </li>
                            <li class='navigationItemContent' <?php if($submenu=='ait_vat'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/ait_vat/view/9/22/184/ait_vat">AIT & VAT</a>
                            </li>
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->