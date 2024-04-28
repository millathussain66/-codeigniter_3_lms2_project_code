                    <!---- Left Side Menu Start ------>
                    <style>
                        .active{
                            background: #93CDDD!important;
                            font-weight: bold;
                        }
                        @font-face {
                            font-family: 'sutonnymjregular';
                            src: url('<?=base_url()?>css/SutonnyMJ-Regular.woff') format('woff');
                            font-weight: normal;
                            font-style: normal;

                        }
                    </style>
                    <div id='navigationTitle' class='navigationTitle' >
                        <div style='float: left; ' class="widget-icon jqx-navigationbar-icon"></div>        
                        <a>BB Report</a>
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <?php if (STATEMENTRT==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='statement_rt' || $submenu==null){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>statement_rt">Statement of Cases filed & Settled Branch Wise</a></li>
                            <?php endif ?>
                            <?php if (STATEMENTRTCOURT==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='statement_rt_court'){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>statement_rt_court">Statement of Cases filed & Settled By Court Wise</a></li>
                            <?php endif ?>
                            <?php if (STATEMENTCLASSIFIED==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='statement_classified'){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>statement_classified">Statement of Classified Loans Branch Wise</a></li>
                            <?php endif ?>
                            <?php if (CASEFILEDSETTLED==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='case_filed_settled'){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>case_filed_settled">Case Filed & Settled Court & Segment Wise quarterly </a></li>
                            <?php endif ?>
                            <?php if (CASEFILEDSETTLEDSEG==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='case_filed_settled_seg'){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>case_filed_settled_seg">Case Filed & Settled Segment Wise quarterly </a></li>
                            <?php endif ?>
                            <?php if (INTERNALREPORT==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='internal_report'){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>internal_report">Yearly Internal Report</a></li>
                            <?php endif ?>
                            <?php if (STATEMENTRT==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='statement_rt_bangla'){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>statement_rt_bangla">Statement of Cases filed & Settled Branch Wise ( <span style="font-family: sutonnymjregular;font-size: 14px;">evsjv</span>)</a></li>
                            <?php endif ?>
                            <?php if (QUARTERLYSTATEMENTRT==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='quarterly_statement_rt'){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>quarterly_statement_rt">Quarterly Statement of Cases filed & Settled under Arthorin Adalat( <span style="font-family: sutonnymjregular;font-size: 14px;">evsjv</span>)</a></li>
                            <?php endif ?>
                            <?php if (TOTALCASES==1): ?>
                                <li class='navigationItemContent <?php if($submenu=='total_cases'){echo 'active';} ?>'><a href="<?php echo base_url('bb_rt/view/'.$menu_group.'/'.$menu_cat.'/'.$menu_link.'/'); ?>total_cases"><span style="font-family: sutonnymjregular;font-size: 16px;">gvgjvaxb F‡Yi weeiYx</span></a></li>
                            <?php endif ?>
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->