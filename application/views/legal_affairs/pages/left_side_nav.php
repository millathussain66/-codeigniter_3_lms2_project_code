                    <!---- Left Side Menu Start ------>
                    <style>
                        .active{
                            background: #93CDDD!important;
                            font-weight: bold;
                        }
                    </style>
                    <div id='navigationTitle' class='navigationTitle' >
                        <div style='float: left; ' class="widget-icon jqx-navigationbar-icon"></div>        
                        <a>Legal Affairs</a>
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <li class='navigationItemContent <?php if($submenu=='case_file' || $submenu==null){echo 'active';} ?>'><a href="<?php echo base_url('legal_affairs/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>case_file">Case File</a></li>
                            <li class='navigationItemContent <?php if($submenu=='case_status_update'){echo 'active';} ?>'><a href="<?php echo base_url('legal_affairs/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>case_status_update">Case Status Update</a></li>
                            <!-- <li class='navigationItemContent <?php if($submenu=='billing'){echo 'active';} ?>'><a href="<?php echo base_url('legal_affairs/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>billing">Billing</a></li> -->
                            <li class='navigationItemContent <?php if($submenu=='case_details'){echo 'active';} ?>'><a href="<?php echo base_url('legal_affairs/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>case_details">Case Details</a></li>
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->