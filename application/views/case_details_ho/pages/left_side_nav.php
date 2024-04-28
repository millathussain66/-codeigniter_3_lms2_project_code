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
                            <li class='navigationItemContent' <?php if($submenu=='case_details' || $submenu==NULL){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/case_details_ho/view/10/43/298/case_details">Case Details Info</a>
                            </li>
                        </ul>
                    </div>
                    <!----====== Left Side Menu End==========----->