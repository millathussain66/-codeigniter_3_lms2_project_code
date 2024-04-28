                    <!---- Left Side Menu Start ------>
                    <style>
                        .active{
                            background: #e7e7e7!important;
                        }
                    </style>
                    <div id='navigationTitle' class='navigationTitle' >
                        <div style='float: left; margin-right: 4px;' class="widget-icon jqx-navigationbar-icon"></div>        
                        <a>Warrant Of Arrest</a>
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <li class='navigationItemContent <?php if($submenu=='pending' || $submenu==null){echo 'active';} ?>'><a href="<?php echo base_url('warrant_arrest/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>pending">Pending</a></li>
                            <li class='navigationItemContent <?php if($submenu=='executed'){echo 'active';} ?>'><a href="<?php echo base_url('warrant_arrest/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>executed">Executed</a></li>
                            <li class='navigationItemContent <?php if($submenu=='settled'){echo 'active';} ?>'><a href="<?php echo base_url('warrant_arrest/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>settled">Settled</a></li>
                            <li class='navigationItemContent <?php if($submenu=='pending_incentive'){echo 'active';} ?>'><a href="<?php echo base_url('warrant_arrest/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>pending_incentive">Pending Incentive</a></li>
                            <li class='navigationItemContent <?php if($submenu=='executed_incentive'){echo 'active';} ?>'><a href="<?php echo base_url('warrant_arrest/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>executed_incentive">Executed Incentive</a></li>
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->