                    <!---- Left Side Menu Start ------>
                    <style>
                        .active{
                            background: #93CDDD!important;
                            font-weight: bold;
                        }
                    </style>
                    <div id='navigationTitle' class='navigationTitle' >
                        <div style='float: left; ' class="widget-icon jqx-navigationbar-icon"></div>        
                        <a>High Court Matter</a>
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <li class='navigationItemContent <?php if($submenu=='hc_case_file' || $submenu==null){echo 'active';} ?>'><a href="<?php echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>hc_case_file">Case Filling</a></li>
                            <li class='navigationItemContent <?php if($submenu=='case_status_update'){echo 'active';} ?>'><a href="<?php echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>case_status_update">Case Status Update</a></li>
                            <!-- <li class='navigationItemContent <?php //if($submenu=='ad_case_file'){echo 'active';} ?>'><a href="<?php //echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>ad_case_file">Appellate Division Case File</a></li>
                            <li class='navigationItemContent <?php //if($submenu=='ad_case_status_update'){echo 'active';} ?>'><a href="<?php //echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>ad_case_status_update">Case Status Update (ADM)</a></li> -->
                            <li class='navigationItemContent <?php if($submenu=='billing'){echo 'active';} ?>'><a href="<?php echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>billing">Billing</a></li>
                            <!-- <li class='navigationItemContent <?php //if($submenu=='ad_billing'){echo 'active';} ?>'><a href="<?php //echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>ad_billing">Billing (ADM)</a></li> -->
                            <li class='navigationItemContent <?php if($submenu=='case_details'){echo 'active';} ?>'><a href="<?php echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>case_details">Case Details</a></li>
                            <li class='navigationItemContent <?php if($submenu=='bill_expense'){echo 'active';} ?>'><a href="<?php echo base_url('hc_matter/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>bill_expense">Bill Expenses</a></li>
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->