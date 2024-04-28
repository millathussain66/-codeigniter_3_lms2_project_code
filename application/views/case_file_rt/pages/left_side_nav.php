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
        <a>Case Filing Report</a>
</div>
<div class='navigationItem'>
    <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='case_file_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/case_file_rt">Case Filing Report</a>
         </li>
        
    </ul>
     <ul class='navigationContent'>
        <li class='navigationItemContent' <?php if($operation=='iss_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/iss_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/iss_rt">Iss Report (BB)</a>
         </li>
    </ul>

  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='warrant_report'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/warrant_report/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/warrant_report">Warrant Report</a>
     </li>
  </ul>



  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='apv_bill_mony_recovery_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/apv_bill_mony_recovery_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/apv_bill_mony_recovery_rt">Appeal & Bail Money Recovery Report</a>
     </li>
  </ul>

 <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='waiting_fr_jr_case_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/waiting_fr_jr_case_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/waiting_fr_jr_case_rt">Waiting For Jari Case Report</a>
     </li>
  </ul>

   <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='case_sts_up_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/case_sts_up_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/case_sts_up_rt">Case Status Update Report </a>
     </li>
  </ul>

  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='first_legal_notice_report'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/first_legal_notice_report/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/first_legal_notice_report">1st Legal Notice Report</a>
     </li>
  </ul>

    <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='cma_apv__decline_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/cma_apv__decline_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/cma_apv__decline_rt">CMA Approved & Decline Report</a>
     </li>
  </ul>

  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='deliver_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/deliver_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/deliver_rt">File & Cheque Delivered Report</a>
     </li>
  </ul>

  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='after_fill_recovery_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/after_fill_recovery_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/after_fill_recovery_rt">After Filling Recovery Report</a>
     </li>
  </ul>

  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='case_aga_bank_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/case_aga_bank_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/case_aga_bank_rt">Case Against Bank Report</a>
     </li>
  </ul>

  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='legal_cost_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/legal_cost_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/legal_cost_rt">Yearly Legal Cost Report</a>
     </li>
  </ul>

  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='high_court_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/high_court_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/high_court_rt">High Court Report</a>
     </li>
  </ul>

  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='case_report_of_month_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/case_report_of_month_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/case_report_of_month_rt">Case Report End Of Month Report</a>
     </li>
  </ul>



  <ul class='navigationContent'>
    <li class='navigationItemContent' <?php if($operation=='auth_rt'){echo 'id="active"';} ?>><a href="<?=base_url()?>index.php/Case_file_rt/auth_rt/<?=$menu_group?>/<?=$menu_cat?>/<?=$sub_menue?>/auth_rt">Authorization Report</a>
     </li>
  </ul>

</div>
<!----====== Left Side Menu End==========----->