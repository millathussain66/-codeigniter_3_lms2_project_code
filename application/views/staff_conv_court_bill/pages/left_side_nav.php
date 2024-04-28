<!---- Left Side Menu Start ------>
<style>
    #active{
        background: #93CDDD!important;
        font-weight: bold;
    }
    .navigationContent {

      border-bottom: 1px solid #e9e9e9;
   }
</style>
<div id='navigationTitle' class='navigationTitle' >
    <div style='float: left; margin-right: 4px;' class="widget-icon jqx-navigationbar-icon"></div>        
        <a>Staff Conv. & Court Bill</a>
</div>
<div class='navigationItem'>


     <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='staff_conv_court_bill'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/staff_conv_court_bill/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/staff_conv_court_bill">Conveyance Other's Cost</a>
         </li>
     </ul>




     <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='court_entertainment_cost'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/staff_conv_court_bill/court_entertainment_cost/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/court_entertainment_cost">Court Entertainment Cost</a>
         </li>
    </ul>



    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='type_wise_cost'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/staff_conv_court_bill/type_wise_cost/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/type_wise_cost">Conveyance & Other's Bill</a>
         </li>
    </ul>


</div>
<!----====== Left Side Menu End==========----->