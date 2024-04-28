                    <!---- Left Side Menu Start ------>
                    <style>
                        #active{
                            background: #93CDDD!important;
                            font-weight: bold;
                        }
                    </style>
                    <div id='navigationTitle' class='navigationTitle' >
                        <div style='float: left; ' class="widget-icon jqx-navigationbar-icon"></div>        
                        <a>Edit Bill Data</a>
                    </div>
                    <div class='navigationItem'>
                        <ul class='navigationContent'>
                            <li class='navigationItemContent' <?php if($operation=='bill_data_edit/view'){echo 'id="active"';} ?> ><a href="<?=base_url()?>index.php/bill_data_edit/view/3/61/422">Lawyer Bill</a>
                            </li>
                        </ul>

                        <ul class='navigationContent'>
                            <li class='navigationItemContent' <?php if($operation=='bill_data_edit/court_fee'){echo 'id="active"';} ?> ><a href="<?=base_url()?>index.php/bill_data_edit/court_fee/3/61/424">Court Fee</a>
                            </li>
                        </ul>

                        <ul class='navigationContent'>
                            <li class='navigationItemContent' <?php if($operation=='bill_data_edit/paper_vendor'){echo 'id="active"';} ?> ><a href="<?=base_url()?>index.php/bill_data_edit/paper_vendor/3/61/426">Paper Vendor</a>
                            </li>
                        </ul>


                        <ul class='navigationContent'>
                            <li class='navigationItemContent' <?php if($operation=='bill_data_edit/staff_conveyance'){echo 'id="active"';} ?> ><a href="<?=base_url()?>index.php/bill_data_edit/staff_conveyance/3/61/428">Staff Conveyance</a>
                            </li>
                        </ul>

                        <ul class='navigationContent'>
                            <li class='navigationItemContent' <?php if($operation=='bill_data_edit/court_entertainment'){echo 'id="active"';} ?> ><a href="<?=base_url()?>index.php/bill_data_edit/court_entertainment/3/61/430">Court Entertainment</a>
                            </li>
                        </ul>


                        
                        <ul class='navigationContent'>
                            <li class='navigationItemContent' <?php if($operation=='bill_data_edit/others'){echo 'id="active"';} ?> ><a href="<?=base_url()?>index.php/bill_data_edit/others/3/61/432">Other/Miscellaneous</a>
                            </li>
                        </ul>




                    </div>
                    <!----====== Left Side Menu End==========----->