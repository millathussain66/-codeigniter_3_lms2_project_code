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
        <a>Lawyer Bill & Publication Bill</a>
</div>
<div class='navigationItem'>


    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='lawyer_bill_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/lawyer_bill_rt/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/lawyer_bill_rt">Acc Wise Lawyer's Bill</a>
         </li>
    </ul>

    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='lawyer_bill_summery'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/lawyer_bill_rt/lawyer_bill_summery/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/lawyer_bill_summery">Lawyer's Bill Summery</a>
         </li>
    </ul>

    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='ac_wise_publication_bill'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/lawyer_bill_rt/ac_wise_publication_bill/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/ac_wise_publication_bill">Acc Wise Publication Bill</a>
         </li>
    </ul>


    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='paper_publication_summery'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/lawyer_bill_rt/paper_publication_summery/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/paper_publication_summery">Publication Summery</a>
         </li>
    </ul>

    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='region_wise_report'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/lawyer_bill_rt/region_wise_report/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/region_wise_report">Region Wise Report</a>
         </li>
    </ul>

   <!--  <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='particular_activitie_wise_report'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/lawyer_bill_rt/particular_activitie_wise_report/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/particular_activitie_wise_report">Particular Activitie Wise Report</a>
         </li>
    </ul> -->


    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='particular_activities'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/lawyer_bill_rt/particular_activities/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/particular_activities">Particulers Activities</a>
         </li>
    </ul>



    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='at_a_galance_report'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/lawyer_bill_rt/at_a_galance_report/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/at_a_galance_report">Glance Total Report</a>
         </li>
    </ul>






</div>
<!----====== Left Side Menu End==========----->