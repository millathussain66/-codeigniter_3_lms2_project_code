                    <!---- Left Side Menu Start ------>
                    <style>
                        .active{
                            background: #e7e7e7!important;
                        }
                    </style>
                    <div id='navigationTitle' class='navigationTitle' >
                        <div style='float: left; margin-right: 4px;' class="widget-icon jqx-navigationbar-icon"></div>        
                        <a>Warrant Of Arrest Report</a>
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <li class='navigationItemContent <?php if($submenu=='pending' || $submenu==null){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>pending">Warrant Execution Report</a></li>
                            <li class='navigationItemContent <?php if($submenu=='executed'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>executed">Warrant Execution Incentive Report</a></li>
                            <li class='navigationItemContent <?php if($submenu=='month_region_rt'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>month_region_rt">Month and Region Wise WA Execution</a></li>
                            <li class='navigationItemContent <?php if($submenu=='month_type_rt'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>month_type_rt">Month Wise and Types Wise WA Exetion Report</a></li>
                            <li class='navigationItemContent <?php if($submenu=='master_case_status'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>master_case_status">Master Case Status</a></li>
                            <li class='navigationItemContent <?php if($submenu=='case_scenario'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>case_scenario">Total Case Scenario</a></li>
                            <li class='navigationItemContent <?php if($submenu=='month_wise_total_case'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>month_wise_total_case">Month Wise Total Case</a></li>
                            <li class='navigationItemContent <?php if($submenu=='total_existing_case'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>total_existing_case">Total Existing Case</a></li>
                            <!-- <li class='navigationItemContent <?php if($submenu=='findings_summary'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>findings_summary">Findings Summary</a></li>
                            <li class='navigationItemContent <?php if($submenu=='risk_issues_summaray'){echo 'active';} ?>'><a href="<?php echo base_url('wa_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>risk_issues_summaray">Risk Issues Summary</a></li> -->
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->