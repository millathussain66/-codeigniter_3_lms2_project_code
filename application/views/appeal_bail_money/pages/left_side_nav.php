                    <!---- Left Side Menu Start ------>
                    <style>
                        .active{
                            background: #e7e7e7!important;
                        }
                    </style>
                    
                    <div id="dd"></div>
                    <div id='navigationTitle' class='navigationTitle' style="text-align: center;">
                        <div style='float: left; margin-right: 4px;' class="widget-icon jqx-navigationbar-icon"></div>        
                        <a>Appeal and Bail Money</a>
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <li class='navigationItemContent <?php if($submenu=='pending' || $submenu==null){echo 'active';} ?>'><a href="<?php echo base_url('appeal_bail_money/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>pending">Pending</a></li>
                            <li class='navigationItemContent <?php if($submenu=='deposit'){echo 'active';} ?>'><a href="<?php echo base_url('appeal_bail_money/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>deposit">Deposit</a></li>
                            <li class='navigationItemContent <?php if($submenu=='withdrawn'){echo 'active';} ?>'><a href="<?php echo base_url('appeal_bail_money/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>withdrawn">Withdrawn</a></li>
                            <li class='navigationItemContent <?php if($submenu=='billing_pending'){echo 'active';} ?>'><a href="<?php echo base_url('appeal_bail_money/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>billing_pending">Pending Billing </a></li>
                            <li class='navigationItemContent <?php if($submenu=='billing_completed'){echo 'active';} ?>'><a href="<?php echo base_url('appeal_bail_money/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>billing_completed">Completed Billing </a></li>
                            <li class='navigationItemContent <?php if($submenu=='data_details'){echo 'active';} ?>'><a href="<?php echo base_url('appeal_bail_money/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>data_details">Data Details</a></li>
                           
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->
                    