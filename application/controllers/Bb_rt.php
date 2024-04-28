<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bb_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

    		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
    		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
    		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
    		$this->output->set_header('Pragma: no-cache');
    		$this->load->model('Bb_rt_model', '', TRUE);
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group,$menu_cat,$menu_link=null,$submenu=null){
		$data = array(
                'submenu' => $submenu,
                'menu_link' => $menu_link,
                'menu_group'=> $menu_group,
                'menu_cat'=> $menu_cat,
                'quarter' => $this->User_model->get_parameter_data('ref_quarter','segment','sts = 1'),
                'per_page' => $this->config->item('per_pagess')
            );
      if($submenu=='statement_rt_court'){
        $data['pages']='bb_rt/pages/statement_rt_court';
      }elseif($submenu=='statement_classified'){
        $data['pages']='bb_rt/pages/statement_classified';
      }elseif($submenu=='case_filed_settled'){
        $data['pages']='bb_rt/pages/case_file_settled';
      }elseif($submenu=='case_filed_settled_seg'){
        $data['pages']='bb_rt/pages/case_filed_settled_seg';
      }elseif($submenu=='quarterly_statement_rt'){
        $data['pages']='bb_rt/pages/quarterly_statement_rt';
      }elseif($submenu=='internal_report'){
        $data['pages']='bb_rt/pages/internal_report';
      }elseif($submenu=='statement_rt_bangla'){
        $data['pages']='bb_rt/pages/statement_rt_bangla';
      }elseif($submenu=='total_cases'){
        $data['pages']='bb_rt/pages/total_cases';
      }else{
        $data['pages']='bb_rt/pages/grid';
      }
      $this->load->view('grid_layout',$data);

	}	
  function get_internal_report()
  {
  
    $csrf_token=$this->security->get_csrf_hash();
    $year = $this->input->post('year');
    $result = $this->Bb_rt_model->get_internal_report($year);
    $str_html="";
    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word' colspan='17'><strong>Data Requirement  of ".$year."</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word' colspan='4'><strong>At galance-".$year."</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word' rowspan='3'><strong>Month</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word' colspan='6'><strong>Filing</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word' colspan='6'><strong>Disposal/Case Withdrawal</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word' colspan='4'><strong>Appeal/Bail Money recovery</strong></td>
      <td bgcolor='#C5D9F1' style='text-align:center;border:1px solid black;word-wrap:break-word' colspan='2'><strong>Total </strong></td>
      <td bgcolor='#C5D9F1' style='text-align:center;border:1px solid black;word-wrap:break-word' colspan='2'><strong>Total </strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' colspan='2'><strong>ARA-2003</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' colspan='2'><strong>NI Act-138</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' colspan='2'><strong>Penal Code</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' colspan='2'><strong>ARA-2003</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' colspan='2'><strong>NI Act-138</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' colspan='2'><strong>Penal Code</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' colspan='2'><strong>From Jari Suit</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' colspan='2'><strong>From NI Act Appeal</strong></td>
      <td bgcolor='#C5D9F1' style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' rowspan='2'><strong>Filing</strong></td>
      <td bgcolor='#C5D9F1' style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' rowspan='2'><strong>CC AMT</strong></td>
      <td bgcolor='#C5D9F1' style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' rowspan='2'><strong>Disposal</strong></td>
      <td bgcolor='#C5D9F1' style='text-align:center;border:1px solid black;word-wrap:break-word;color:red' rowspan='2'><strong>Rec</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>No. of Case</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>CC AMT</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>No. of Case</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>CC AMT</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>No. of Case</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>CC AMT</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>No. of Case</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>Rec</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>No. of Case</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>Rec</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>No. of Case</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>Rec</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>Acc</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>Rec</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>Acc</strong></td>
      <td style='text-align:center;border:1px solid black;word-wrap:break-word;color:red'><strong>Rec</strong></td>
      </tr>"; 
      $total_c_ar = 0;
      $total_am_ar = 0;
      $total_c_ni= 0;
      $total_am_ni = 0;
      $total_c_pi = 0;
      $total_am_pi = 0;
      $total_c_d_ar = 0;
      $total_am_d_ar = 0;
      $total_c_d_ni = 0;
      $total_am_d_ni = 0;
      $total_c_d_pi = 0;
      $total_am_d_pi = 0;
      $total_rec_c_ara = 0;
      $total_rec_c_ni = 0;
      $total_rec_am_ara = 0;
      $total_rec_am_ni = 0;
      $total_fil = 0;
      $total_amount = 0;
      $total_desposal = 0;
      $total_recovery = 0;
    if(!empty($result))
    {
      foreach ($result as $key) 
      {
        $req_type = explode("##",$key->req_type);
        $no_of_setteled = explode("##",$key->no_of_setteled);
        $no_case_filed = explode("##",$key->no_case_filed);
        $no_case_claim_amount = explode("##",$key->no_case_claim_amount);
        $no_case_claim_amount_settled = explode("##",$key->no_case_claim_amount_settled);
        $recovery_amount = explode("##",$key->recovery_amount);
        $total_recovered = explode("##",$key->total_recovered);
        $index = array_search('2', $req_type); // For ARA-SEARCH
        $index2 = array_search('1', $req_type); //For Ni Act Search

        $ara_t_case = ($index>=0) ? $no_case_filed[$index] : 0;
        $ara_t_amount = ($index>=0) ? $no_case_claim_amount[$index] : 0;

        $ni_t_case = ($index2>=0) ? $no_case_filed[$index2] : 0;
        $ni_t_amount = ($index2>=0) ? $no_case_claim_amount[$index2] : 0;

        $pi_t_case = 0;
        $pi_t_amount = 0;

        $ara_t_d_case = ($index>=0) ? $no_of_setteled[$index] : 0;
        $ara_t_d_amount = ($index>=0) ? $no_case_claim_amount_settled[$index] : 0;

        $ni_t_d_case = ($index2>=0) ? $no_of_setteled[$index2] : 0;
        $ni_t_d_amount = ($index2>=0) ? $no_case_claim_amount_settled[$index2] : 0;

        $pi_t_d_case = 0;
        $pi_t_d_amount = 0;
        
        $ara_t_r_case = ($index>=0) ? $total_recovered[$index] : 0;
        $ara_t_r_amount = ($index>=0) ? $recovery_amount[$index] : 0;

        $ni_t_r_case = ($index2>=0) ? $total_recovered[$index2] : 0;
        $ni_t_r_amount = ($index2>=0) ? $recovery_amount[$index2] : 0;

        $total_filling = ($ara_t_case+$ni_t_case+$pi_t_case);
        $total_cc_amount = ($ara_t_amount+$ni_t_amount+$pi_t_amount);
        $total_disposal = ($ara_t_d_case+$ni_t_d_case+$pi_t_d_case);
        $total_rec = ($ara_t_r_case+$ni_t_r_case);
        //For Grand Total
        $total_c_ar = ($total_c_ar+$ara_t_case);
        $total_am_ar =($total_am_ar+$ara_t_amount);
        $total_c_ni= ($total_c_ni+$ni_t_case);
        $total_am_ni = ($total_am_ni+$ni_t_amount);
        $total_c_pi =($total_c_pi+$pi_t_case);
        $total_am_pi = ($total_am_pi+$pi_t_amount);
        $total_c_d_ar = ($total_c_d_ar+$ara_t_d_case);
        $total_am_d_ar = ($total_am_d_ar+$ara_t_d_amount);
        $total_c_d_ni = ($total_c_d_ni+$ni_t_d_case);
        $total_am_d_ni = ($total_am_d_ni+$ni_t_d_amount);
        $total_c_d_pi = ($total_c_d_pi+$pi_t_d_case);
        $total_am_d_pi = ($total_am_d_pi+$pi_t_d_amount);
        $total_rec_c_ara = ($total_rec_c_ara+$ara_t_r_case);
        $total_rec_c_ni = ($total_rec_c_ni+$ni_t_r_case);
        $total_rec_am_ara = ($total_rec_am_ara+$ara_t_r_amount);
        $total_rec_am_ni = ($total_rec_am_ni+$ni_t_r_amount);
        $total_fil = ($total_fil+$total_filling);
        $total_amount = ($total_amount+$total_cc_amount);
        $total_desposal = ($total_desposal+$total_disposal);
        $total_recovery = ($total_recovery+$total_rec);
        $str_html.="
          <tr bgcolor='#F1E6DC'>
          <td bgcolor='#D9D9D9' style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$key->month_name."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ara_t_case."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ara_t_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ni_t_case."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ni_t_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$pi_t_case."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$pi_t_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ara_t_d_case."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ara_t_d_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ni_t_d_case."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ni_t_d_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$pi_t_d_case."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$pi_t_d_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ara_t_r_case."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ara_t_r_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ni_t_r_case."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$ni_t_r_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_filling."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_cc_amount."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_disposal."</td>
          <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_rec."</td>
          </tr>"; 
      }
      $str_html.="
        <tr bgcolor='#F1E6DC'>
        <td bgcolor='#D9D9D9' style='text-align:center;border:1px solid black;word-wrap:break-word;'>Grand Total</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_c_ar."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_am_ar."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_c_ni."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_am_ni."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_c_pi."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_am_pi."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_c_d_ar."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_am_d_ar."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_c_d_ni."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_am_d_ni."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_c_d_pi."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_am_d_pi."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_rec_c_ara."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_rec_c_ni."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_rec_am_ara."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_rec_am_ni."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_fil."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_amount."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_desposal."</td>
        <td style='text-align:center;border:1px solid black;word-wrap:break-word;'>".$total_recovery."</td>
        </tr>"; 
    }
    else
    {
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' colspan='21'>Sorry No Data</td>
      </tr>";
    }
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function get_statement_result()
  {
    $month =  date('m');
    $present_month = (int)$month;
    //For The Present Quarter Segemnt
    $str="SELECT q.* FROM ref_quarter q
    WHERE FIND_IN_SET($present_month, q.value) LIMIT 1";
    $query=$this->db->query($str);
    $present_quarter = $query->row();

    $present_quarter_months = $present_quarter->segment_text;

    

    $csrf_token=$this->security->get_csrf_hash();
    $branch = $this->input->post('branch');
    $str="SELECT q.* FROM ref_branch_sol q
    WHERE q.code=".$this->db->escape($branch)." LIMIT 1";
    $query=$this->db->query($str);
    $branch_data = $query->row();
    $result = $this->Bb_rt_model->get_statement_result($branch);
    $str_html="";
    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Name of the Bank : BRAC Bank PLC.</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Statement of Cases filed & Settled in Artho Rin & Dewlia Adalat</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Branch Name: ".$branch_data->name."</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:center;border:0px solid black;color:red;' colspan='2'><strong>As on (".$present_quarter_months.'-'.date('y').")</strong></td>
      <td style='text-align:center;border:0px solid black' colspan='7'></td>
      <td style='text-align:center;border:0px solid black;color:red;text-align:right'><strong>In Lac</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' rowspan='2'><strong>S.L</strong></td>
      <td style='text-align:center;border:1px solid black;' rowspan='2'><strong>Type of Case </strong></td>
      <td style='text-align:center;border:1px solid black;' colspan='2'><strong>Number & Amount of Case Filed (Last Quarter)</strong></td>
      <td style='text-align:center;border:1px solid black;' colspan='2'><strong>Number & Amount of Case Filed (Present Quarter)</strong></td>
      <td style='text-align:center;border:1px solid black;' colspan='2'><strong>Number & Amount of Case Settled (Present Quarter)</strong></td>
      <td style='text-align:center;border:1px solid black;' colspan='2'><strong>Number & Amount of Case Unsettled (Present Quarter)</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;'><strong>No. of Cases</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Claimed Amount </strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>No. of Cases</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Claimed Amount </strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>No. of Cases</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Amount Claimed</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>No. of Cases </strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Amount Claimed</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>1</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>2</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>3</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>4</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>5</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>6</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>7</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>8</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>9</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>10</strong></td>
      </tr>";

    if(!empty($result))
    {
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:10%;text-align:center;border:1px solid black;'>2</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>Certificate Case/NI ACT</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$result->ni_last_total."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round(($result->ni_last_amount/100000),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$result->ni_present_total."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round(($result->ni_present_amount/100000),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$result->ni_settled_total."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round(($result->ni_settled_amount/100000),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$result->ni_unsettled_total."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round(($result->ni_unsettled_amount/100000),3)."</td>
      </tr>";

      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:10%;text-align:center;border:1px solid black;'>3</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>Arthorin Adalat Ain-2003</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$result->ara_last_total."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round(($result->ara_last_amount/100000),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$result->ara_present_total."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round(($result->ara_present_amount/100000),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$result->ara_settled_total."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round(($result->ara_settled_amount/100000),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$result->ara_unsettled_total."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round(($result->ara_unsettled_amount/100000),3)."</td>
      </tr>";
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:10%;text-align:center;border:1px solid black;' colspan='2'><strong>Total</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".($result->ara_last_total+$result->ni_last_total)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round((($result->ara_last_amount/100000)+($result->ni_last_amount/100000)),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".($result->ara_present_total+$result->ni_present_total)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round((($result->ara_present_amount/100000)+($result->ni_present_amount/100000)),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".($result->ara_settled_total+$result->ni_settled_total)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round((($result->ara_settled_amount/100000)+($result->ni_settled_amount/100000)),3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".($result->ara_unsettled_total+$result->ni_unsettled_total)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round((($result->ara_unsettled_amount/100000)+($result->ara_unsettled_amount/100000)),3)."</td>
      </tr>";
    }
    else
    {
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' colspan='10'>Sorry No Data</td>
      </tr>";
    }
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function get_statement_result_bangla()
  {
    $csrf_token=$this->security->get_csrf_hash();
    $branch = $this->input->post('branch');
    $str="SELECT q.* FROM ref_branch_sol q
    WHERE q.code=".$this->db->escape($branch)." LIMIT 1";
    $query=$this->db->query($str);
    $branch_data = $query->row();
    $result = $this->Bb_rt_model->get_statement_result_court($branch);
    $str_html="";
    $total_c=0;
    $total_a=0;
    $total_s_c=0;
    $total_s_a=0;
    $total_u_c=0;
    $total_u_a=0;
    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Name of the Bank : BRAC Bank PLC.</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Statement of Cases filed & Settled in Artho Rin & Dewlia Adalat</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Branch Name: ".$branch_data->name."</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:center;border:0px solid black;color:red;' colspan='2'><strong>As on (".date('d-M-Y').")</strong></td>
      <td style='text-align:center;border:0px solid black' colspan='7'></td>
      <td style='text-align:center;border:0px solid black;color:red;text-align:right'><strong>In Lac</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='2'><strong>µwgK bs</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='2'><strong>Av`vj‡Zi bvg</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' colspan='2'><strong>`v‡qiK„Z gvgjv (K«g cyÄxfyZ)</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' colspan='3'><strong>wb®cwËK„Z gvgjv (K«g cyÄxfyZ)</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' colspan='3'><strong>wePvivaxb gvgjv</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>msL¨v</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>`vexK„Z A‡_©i cwigvY</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>msL¨v</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>`vexK„Z A‡_©i cwigvY</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>c«K„Z Av`vq</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>msL¨v</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>`vexK„Z A‡_©i cwigvY</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>wePvivaxb gvgjvi `vexK„Z A‡_©i wecix†Z Av`vqK„Z A‡_©i cwigvY</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>1</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>2</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>3</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>4</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>5</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>6</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>7</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>8</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>9</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>10</strong></td>
      </tr>";

    if(!empty($result))
    {
      $sl=1;
      foreach ($result as $key) 
      {
        $sl++;
        $total_c=($total_c+$key->total_counter);
        $total_a=($total_a+($key->total_amount/100000));
        $total_s_c=($total_s_c+$key->settled_total);
        $total_s_a=($total_s_a+($key->settled_amount/100000));
        $total_u_c=($total_u_c+$key->unsettled_total);
        $total_u_a=($total_u_a+($key->unsettled_amount/100000));
        $str_html.="
        <tr bgcolor='#F1E6DC'>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".$sl."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'>".$key->name."</td>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".$key->total_counter."</td>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".round(($key->total_amount/100000),3)."</td>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".$key->settled_total."</td>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".round(($key->settled_amount/100000),3)."</td>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'></td>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".$key->unsettled_total."</td>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".round(($key->unsettled_amount/100000),3)."</td>
        <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'></td>
        </tr>";
      }

      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;' colspan='2'><strong>‡gvU</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".$total_c."</td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".round($total_a,3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".$total_s_c."</td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".round($total_s_a,3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'></td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".$total_u_c."</td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'>".round($total_u_a,3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;font-family: sutonnymjregular;'></td>
      </tr>";
      
    }
    else
    {
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' colspan='10'>Sorry No Data</td>
      </tr>";
    }
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function get_statement_result_court()
  {
    $csrf_token=$this->security->get_csrf_hash();
    $branch = $this->input->post('branch');
    $str="SELECT q.* FROM ref_branch_sol q
    WHERE q.code=".$this->db->escape($branch)." LIMIT 1";
    $query=$this->db->query($str);
    $branch_data = $query->row();
    $result = $this->Bb_rt_model->get_statement_result_court($branch);
    $str_html="";
    $total_c=0;
    $total_a=0;
    $total_s_c=0;
    $total_s_a=0;
    $total_u_c=0;
    $total_u_a=0;
    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Name of the Bank : BRAC Bank PLC.</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Statement of Cases filed & Settled in Artho Rin & Dewlia Adalat</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='10'><strong>Branch Name: ".$branch_data->name."</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:center;border:0px solid black;color:red;' colspan='2'><strong>As on (".date('d-M-Y').")</strong></td>
      <td style='text-align:center;border:0px solid black' colspan='7'></td>
      <td style='text-align:center;border:0px solid black;color:red;text-align:right'><strong>In Lac</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' rowspan='2'><strong>S.L</strong></td>
      <td style='text-align:center;border:1px solid black;' rowspan='2'><strong>Name of Court</strong></td>
      <td style='text-align:center;border:1px solid black;' colspan='2'><strong>Number & Amount of Case Filed (Cumulative)</strong></td>
      <td style='text-align:center;border:1px solid black;' colspan='3'><strong>Number & Amount of Case Settled/Decree</strong></td>
      <td style='text-align:center;border:1px solid black;' colspan='3'><strong>Number & Amount of Case Unsettled </strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;'><strong>No. of Cases</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Claimed Amount </strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>No. of Cases</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Claimed Amount</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Actual Realization</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>No. of Cases </strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Amount Claimed</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Actual Realization on pending case</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>1</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>2</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>3</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>4</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>5</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>6</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>7</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>8</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>9</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>10</strong></td>
      </tr>";

    if(!empty($result))
    {
      $sl=1;
      foreach ($result as $key) 
      {
        $sl++;
        $total_c=($total_c+$key->total_counter);
        $total_a=($total_a+($key->total_amount/100000));
        $total_s_c=($total_s_c+$key->settled_total);
        $total_s_a=($total_s_a+($key->settled_amount/100000));
        $total_u_c=($total_u_c+$key->unsettled_total);
        $total_u_a=($total_u_a+($key->unsettled_amount/100000));
        $str_html.="
        <tr bgcolor='#F1E6DC'>
        <td style='width:10%;text-align:center;border:1px solid black;'>".$sl."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'>".$key->name."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'>".$key->total_counter."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'>".round(($key->total_amount/100000),3)."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'>".$key->settled_total."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'>".round(($key->settled_amount/100000),3)."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'></td>
        <td style='width:10%;text-align:center;border:1px solid black;'>".$key->unsettled_total."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'>".round(($key->unsettled_amount/100000),3)."</td>
        <td style='width:10%;text-align:center;border:1px solid black;'></td>
        </tr>";
      }

      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:10%;text-align:center;border:1px solid black;' colspan='2'><strong>Total</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$total_c."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round($total_a,3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$total_s_c."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round($total_s_a,3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'></td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".$total_u_c."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'>".round($total_u_a,3)."</td>
      <td style='width:10%;text-align:center;border:1px solid black;'></td>
      </tr>";
      
    }
    else
    {
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' colspan='10'>Sorry No Data</td>
      </tr>";
    }
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function get_statement_result_classified()
  {
    $csrf_token=$this->security->get_csrf_hash();
    $branch = $this->input->post('branch');
    $str="SELECT q.* FROM ref_branch_sol q
    WHERE q.code=".$this->db->escape($branch)." LIMIT 1";
    $query=$this->db->query($str);
    $branch_data = $query->row();
    $result = $this->Bb_rt_model->get_statement_result_classified($branch);

    $month =  date('m');
    $present_month = (int)$month;
    //For The Present Quarter Segemnt
    $str="SELECT q.* FROM ref_quarter q
    WHERE FIND_IN_SET($present_month, q.value) LIMIT 1";
    $query=$this->db->query($str);
    $present_quarter = $query->row();

    $present_quarter_months = $present_quarter->segment_text;
    $present_quarter_segment = $present_quarter->segment;

    //For Previous Quarter Segment
    $previous_quarter_segement = ($present_quarter_segment-1);

    if($previous_quarter_segement<0)
    {
      $previous_quarter_segement = 4;
    }

    $str="SELECT q.* FROM ref_quarter q
    WHERE q.segment=".$this->db->escape($previous_quarter_segement)." LIMIT 1";
    $query=$this->db->query($str);
    $previous_quarter = $query->row();
    $previous_quarter_months = $previous_quarter->segment_text;

    $str_html="";
    $total_pre_un=0;
    $total_prest_un=0;
    $total_prest_s=0;
    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='5'><strong>Statement of Classified Loans & Advance and Other Information's</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='5'><strong>for the Quarter ended ".date('M').", ".date('Y')."</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='5'><strong>of ".$branch_data->name." (Excluding Brahamanbaria District)</strong></td>
      </tr>"; 
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='5'><strong>Name of the Branch: ".$branch_data->name."</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>Total Deposit at the end of Present quarter</strong></td>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>Total no. of suits pending at the end of previous quarter</strong></td>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>Total no. of suits settled during the  present quarter</strong></td>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>Total no. of suits pending at the end of present quarter</strong></td>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>Foreign inward remittance during previous quarter</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>10</strong></td>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>11</strong></td>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>12</strong></td>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>13</strong></td>
      <td style='width:20%;text-align:center;border:1px solid black;word-wrap:break-word'><strong>14</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' rowspan='2'><strong>".$branch_data->name."</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>".$previous_quarter_months."'".date('y')."</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>".$present_quarter_months."'".date('y')."</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>As on ".date('M')."'".date('y')."</strong></td>
      <td style='text-align:center;border:1px solid black;' rowspan='2'><strong>New Case</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;'><strong>Sl # 13</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Sl # 12</strong></td>
      <td style='text-align:center;border:1px solid black;'><strong>Sl # 13</strong></td>
      </tr>";
    if(!empty($result))
    {
      $sl=1;
      foreach ($result as $key) 
      {
        $sl++;
        $total_pre_un=($total_pre_un+$key->pre_unsettled_total);
        $total_prest_un=($total_prest_un+$key->prest_settled_total);
        $total_prest_s=($total_prest_s+$key->prest_unsettled_total);
        $str_html.="
        <tr bgcolor='#F1E6DC'>
        <td style='text-align:center;border:1px solid black;'>".$key->name."</td>
        <td style='text-align:center;border:1px solid black;'>".$key->pre_unsettled_total."</td>
        <td style='text-align:center;border:1px solid black;'>".$key->prest_settled_total."</td>
        <td style='text-align:center;border:1px solid black;'>".$key->prest_unsettled_total."</td>
        <td style='text-align:center;border:1px solid black;'>0</td>
        </tr>";
      }

      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;'><strong>Total</strong></td>
      <td style='text-align:center;border:1px solid black;'>".$total_pre_un."</td>
      <td style='text-align:center;border:1px solid black;'>".$total_prest_un."</td>
      <td style='text-align:center;border:1px solid black;'>".$total_prest_s."</td>
      <td style='text-align:center;border:1px solid black;'>0</td>
      </tr>";
      
    }
    else
    {
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' colspan='5'>Sorry No Data</td>
      </tr>";
    }
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function get_case_filed_quarterly()
  {
    $quarter = $this->input->post('quarter');

    $csrf_token=$this->security->get_csrf_hash();
    
    $result = $this->Bb_rt_model->get_case_filed_quarterly($quarter);
    $str_html="";
    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white' colspan='10'><strong>BRAC Bank PLC.</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white' colspan='10'><strong>CASE FILED & SETTLED IN ARTHARIN ADALAT & OTHER COURT</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white' colspan='10'><strong>Quarterly Report ".date('M-d-Y')."</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:center;border:1px solid black;color:white' colspan='10'></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:right;border:1px solid black;' colspan='10'><strong>BDT-Lac</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white' rowspan='2'><strong>Sl No</strong></td>
      <td style='text-align:center;border:1px solid black;color:white' rowspan='2'><strong>Name of the Court</strong></td>
      <td style='text-align:center;border:1px solid black;color:white' colspan='2'><strong>No of Case Filed</strong></td>
      <td style='text-align:center;border:1px solid black;color:white' colspan='3'><strong>No of Settled Case</strong></td>
      <td style='text-align:center;border:1px solid black;color:white' colspan='3'><strong>No of Case Running</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white'><strong>No</strong></td>
      <td style='text-align:center;border:1px solid black;color:white'><strong>Case Claim Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white'><strong>No</strong></td>
      <td style='text-align:center;border:1px solid black;color:white'><strong>Claimed Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white'><strong>Recovery Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white'><strong>No</strong></td>
      <td style='text-align:center;border:1px solid black;color:white'><strong>Amount Claimed</strong></td>
      <td style='text-align:center;border:1px solid black;color:white'><strong>Recovery Amount</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='white'>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>1</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>2</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>3</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>4</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>5</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>6</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>7</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>8</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>9</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>10</strong></td>
      </tr>";

    if(!empty($result))
    {
      $sl=0;
      foreach ($result as $key) 
      {
        $sl++;
        $segment = explode("##",$key->loan_segment);
        $no_case_filed = explode("##",$key->no_case_filed);
        $no_case_claim_amount = explode("##",$key->no_case_claim_amount);
        $no_of_setteled = explode("##",$key->no_of_setteled);
        $no_of_setteled_amount = explode("##",$key->no_of_setteled_amount);
        $no_of_case_running = explode("##",$key->no_of_case_running);
        $no_of_case_running_amount = explode("##",$key->no_of_case_running_amount);
        $rowspan = count($segment)+1;
        $str_html.="
        <tr bgcolor='white'>
        <td style='width:10%;text-align:center;border:1px solid black;' rowspan=".$rowspan."><strong>".$sl."</strong></td>
        <td bgcolor='#538DD5' style='width:10%;text-align:center;border:1px solid black;color:white'><strong>".$key->court_name."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$key->total_no_case_filed."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".round(($key->total_no_case_claim_amount/100000),3)."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$key->total_no_of_setteled."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".round(($key->total_no_of_setteled_amount/100000),3)."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>0</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$key->total_no_of_case_running."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".round(($key->total_no_of_case_running_amount/100000),3)."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>0</strong></td>
        </tr>";
        for ($i=0; $i < count($segment); $i++) 
        { 
          $str_html.="
          <tr bgcolor='white'>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$segment[$i]."</strong></td>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$no_case_filed[$i]."</strong></td>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>".round(($no_case_claim_amount[$i]/100000),3)."</strong></td>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$no_of_setteled[$i]."</strong></td>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>".round(($no_of_setteled_amount[$i]/100000),3)."</strong></td>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>0</strong></td>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$no_of_case_running[$i]."</strong></td>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>".round(($no_of_case_running_amount[$i]/100000),3)."</strong></td>
          <td style='width:10%;text-align:center;border:1px solid black;'><strong>0</strong></td>
          </tr>";
        }
        
      }
    }
    else
    {
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' colspan='10'>Sorry No Data</td>
      </tr>";
    }
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function get_case_filed_quarterly_seg()
  {
    $quarter = $this->input->post('quarter');

    $csrf_token=$this->security->get_csrf_hash();
    $total_c = 0;
    $total_am = 0;
    $total_c_p = 0;
    $total_c_a = 0;
    $total_c_cp = 0;
    $total_a_pa = 0;
    $total_s_c = 0;
    $total_s_a = 0;
    $total_un_c = 0;
    $total_un_a = 0;
    $result = $this->Bb_rt_model->get_case_filed_quarterly_seg($quarter);
    $str_html="";

    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white' colspan='12'><strong>BRAC Bank PLC.</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white' colspan='12'><strong>CASE FILED & SETTLED IN ARTHARIN ADALAT & OTHER COURT</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white' colspan='12'><strong>Quarterly Report ".date('M-d-Y')."</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:center;border:1px solid black;color:white' colspan='12'></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:right;border:1px solid black;' colspan='12'><strong>BDT-Lac</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white' rowspan='2'><strong>Type</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word' colspan='2'><strong>No of Case Filed & Case Claim Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word' colspan='2'><strong>No of Case Filed in Present Quarter </strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word' colspan='2'><strong>Total No of Case Filed & Case Claim Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word' colspan='2'><strong>No of Case Settled & Case Claim Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word' colspan='2'><strong>No of Case Unsettled & Case Claim Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word' rowspan='2'><strong>Remarks</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#538DD5'>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>No</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>Claim Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>No</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>Claimed Amount</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>No (2 + 4)</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>Case Claim Amount (3 + 5)</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>No</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>Amount Claimed</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>No</strong></td>
      <td style='text-align:center;border:1px solid black;color:white;word-wrap:break-word'><strong>Amount Claimed</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='white'>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>1</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>2</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>3</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>4</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>5</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>6</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>7</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>8</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>9</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>10</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>11</strong></td>
      <td style='width:10%;text-align:center;border:1px solid black;'><strong>12</strong></td>
      </tr>";

    if(!empty($result))
    {
      $sl=0;
      foreach ($result as $key) 
      {
        $sl++;
        $total_c = ($total_c+$key->no_case_filed);
        $total_am = ($total_am+round(($key->no_case_claim_amount/100000),3));
        $total_c_p = ($total_c_p+$key->no_case_filed_prest);
        $total_c_a = ($total_c_a+round(($key->no_case_claim_amount_prest/100000),3));
        $total_c_cp = ($total_c_cp+$key->no_case_filed+$key->no_case_filed_prest);
        $total_a_pa = ($total_a_pa+round(($key->no_case_claim_amount/100000),3)+round(($key->no_case_claim_amount_prest/100000),3));
        $total_s_c = ($total_s_c+$key->no_of_setteled);
        $total_s_a = ($total_s_a+round(($key->no_of_setteled_amount/100000),3));
        $total_un_c = ($total_un_c+$key->no_of_case_running);
        $total_un_a = ($total_un_a+round(($key->no_of_case_running_amount/100000),3));
        $str_html.="
        <tr bgcolor='white'>
        <td style='text-align:center;border:1px solid black;'><strong>".$key->name."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".$key->no_case_filed."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".round(($key->no_case_claim_amount/100000),3)."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".$key->no_case_filed_prest."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".round(($key->no_case_claim_amount_prest/100000),3)."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".($key->no_case_filed+$key->no_case_filed_prest)."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".round((round(($key->no_case_claim_amount/100000),3)+round(($key->no_case_claim_amount_prest/100000),3)),3)."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".$key->no_of_setteled."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".round(($key->no_of_setteled_amount/100000),3)."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".$key->no_of_case_running."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong>".round(($key->no_of_case_running_amount/100000),3)."</strong></td>
        <td style='text-align:center;border:1px solid black;'><strong></strong></td>
        </tr>";
      }
      $str_html.="
        <tr bgcolor='white'>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>Total</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_c."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_am."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_c_p."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_c_a."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_c_cp."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_a_pa."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_s_c."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_s_a."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_un_c."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong>".$total_un_a."</strong></td>
        <td style='width:10%;text-align:center;border:1px solid black;'><strong></strong></td>
        </tr>";
    }
    else
    {
      $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;' colspan='12'>Sorry No Data</td>
      </tr>";
    }
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function get_quarterly_statement_rt()
  {
    $csrf_token=$this->security->get_csrf_hash();
    $quarter = $this->input->post('quarter');
    $str="SELECT q.* FROM ref_quarter q
    WHERE q.id=".$this->db->escape($quarter)." LIMIT 1";
    $query=$this->db->query($str);
    $present_quarter = $query->row();
    $quaerter_segment = $present_quarter->segment_text;
    $result = array();//$this->Bb_rt_model->get_statement_result_court($branch);
    $str_html="";
    
    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='6'><strong>Name of the Bank : BRAC Bank PLC.</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='6'><strong>Quarterly Statement of Cases filed & Settled under Arthorin Adalat</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='6'><strong>Quarter Report ".$quaerter_segment." (".date('Y').")</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:left;border:0px solid black;color:red;' colspan='5'><strong>As on (".date('d-M-Y').")</strong></td>
      <td style='text-align:center;border:0px solid black;font-family: sutonnymjregular;color:red'>(‡KvwU UvKvq)</td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>K«wgK bs</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' colspan='2'><strong>weeib</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' ><strong>weMZ eQ‡ii GKB mg‡qi w¯’wZ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' ><strong>we‡eP¨ ‰Ggvwm‡Ki c~‡e©i ‰GgvwmKv‡bÍ w¯’wZ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>we‡eP¨ ‰GgvwmKv‡bÍÍ w¯’wZ</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='4'><strong>9</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='4'><strong>FY/ wewb‡qvM Av`v‡q `v‡qiK„Z gvgjvi msL¨v</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>A_© FY Av`vjZ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>wcwWAvi G¨v±</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>Ab¨vb¨</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>†gvU</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='4'><strong>10</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='4'><strong>gvgjvaxb FY/ wewb‡qv†M weRwoZ A‡_©i cwigvY</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>A_© FY Av`vjZ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>wcwWAvi G¨v±</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>Ab¨vb¨</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>†gvU</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='2'><strong>11</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='2'><strong>MªvnK KZ©„K Av`vj‡Z wiUK„Z FY/ wewb‡qvM</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>msL¨v</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>A‡_©i cwigvY</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";

    
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function get_total_cases()
  {
    $csrf_token=$this->security->get_csrf_hash();
    $quarter = $this->input->post('quarter');
    $str="SELECT q.* FROM ref_quarter q
    WHERE q.id=".$this->db->escape($quarter)." LIMIT 1";
    $query=$this->db->query($str);
    $present_quarter = $query->row();
    $quaerter_segment = $present_quarter->segment_text;
    $result = array();//$this->Bb_rt_model->get_statement_result_court($branch);
    $str_html="";
    
    $str_html.="<table cellpadding='5' cellspacing='0' style='width:99%;border-collapse: collapse;border-color:#c0c0c0;border:1px solid black' >
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black' colspan='5'><strong>Name of the Bank : BRAC Bank PLC.</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular' colspan='5'><strong>gvgjvaxb F‡Yi weeiYx</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular' colspan='5'><strong> e¨vsK KZ©„K `v‡qiK„Z gvgjvi weeiYx t</strong></td>
      </tr>"; 
    $str_html.="
      <tr bgcolor='white'>
      <td style='text-align:left;border:0px solid black;color:red;' colspan='4'><strong>As on (".date('d-M-Y').")</strong></td>
      <td style='text-align:right;border:0px solid black;font-family: sutonnymjregular;color:red'>(‡KvwU UvKvq)</td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' rowspan='2'><strong>gvgjvi cÖK„wZ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' colspan='2'><strong>gvgjv msL¨v</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;' colspan='2'><strong>gvgjvaxb F‡Yi cwigvY</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>5 eQi ch©šÍ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>5 eQ‡ii E‡aŸ©</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>5 eQi ch©šÍ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>5 eQ‡ii E‡aŸ©</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>A_© FY Av`vjZ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>‡dŠR`vix Av`vjZ</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>Ab¨vb¨</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
     $str_html.="
      <tr bgcolor='#F1E6DC'>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>‡gvU</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      <td style='text-align:center;border:1px solid black;font-family: sutonnymjregular;'><strong>0</strong></td>
      </tr>";
    $str_html.="
      </table>";
    $var['csrf_token']=$csrf_token;
    $var['str_html']=$str_html;
    $var['result']=$result;
    echo json_encode($var);
  }
  function make_statement_xl($branch=NULL)
  {
    if(empty($branch))
    {
      redirect('/e404');
    }
    $month =  date('m');
    $present_month = (int)$month;
    //For The Present Quarter Segemnt
    $str="SELECT q.* FROM ref_quarter q
    WHERE FIND_IN_SET($present_month, q.value) LIMIT 1";
    $query=$this->db->query($str);
    $present_quarter = $query->row();

    $present_quarter_months = $present_quarter->segment_text;

    $csrf_token=$this->security->get_csrf_hash();
    $str="SELECT q.* FROM ref_branch_sol q
    WHERE q.code=".$this->db->escape($branch)." LIMIT 1";
    $query=$this->db->query($str);
    $branch_data = $query->row();
    $result = $this->Bb_rt_model->get_statement_result($branch);

    date_default_timezone_set('Asia/Dhaka');    
    require_once('./application/Classes/PHPExcel.php'); 
    
    global $objPHPExcel;
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
      'font' => array(
      'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
      )
    );
    function cellColor($cells,$color){
          global $objPHPExcel;
          $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
          ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
          'startcolor' => array('rgb' => $color)
          ));
      }
    $styleArray_border = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      );
    $cyan_style = array(
                  'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          'color' => array('rgb'=>'F1E6DC'),
                  )
                  
          );
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $rowNumber = 1;
    $headings1 = array('Name of the Bank : BRAC Bank PLC.');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;
    $headings1 = array('Statement of Cases filed & Settled in Artho Rin & Dewlia Adalat');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('Branch Name: '.$branch_data->name);
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('As on ('.$present_quarter_months.'-'.date('y').')','','','','','','','','','In Lac');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':I'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('SL','Type of Case','Number & Amount of Case Filed (Last Quarter)','','Number & Amount of Case Filed (Present Quarter)','','Number & Amount of Case Settled (Present Quarter)','','Number & Amount of Case Unsettled (Present Quarter)','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':D'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(35);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('','','No. of Cases','Claimed Amount ','No. of Cases','Claimed Amount','No. of Cases','Amount Claimed','No. of Cases','Amount Claimed');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('1','2','3','4','5','6','7','8','9','10');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;

    $headings1 = array('2','Certificate Case/NI ACT',$result->ni_last_total,round(($result->ni_last_amount/100000),3),$result->ni_present_total,round(($result->ni_present_amount/100000),3),$result->ni_settled_total,round(($result->ni_settled_amount/100000),3),$result->ni_unsettled_total,round(($result->ni_unsettled_amount/100000),3));
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;

    $headings1 = array('3','Arthorin Adalat Ain-2003',$result->ara_last_total,round(($result->ara_last_amount/100000),3),$result->ara_present_total,round(($result->ara_present_amount/100000),3),$result->ara_settled_total,round(($result->ara_settled_amount/100000),3),$result->ara_unsettled_total,round(($result->ara_unsettled_amount/100000),3));
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;
    
    $headings1 = array('Total','',($result->ara_last_total+$result->ni_last_total),round((($result->ara_last_amount/100000)+($result->ni_last_amount/100000)),3),($result->ara_present_total+$result->ni_present_total),round((($result->ara_present_amount/100000)+($result->ni_present_amount/100000)),3),($result->ara_settled_total+$result->ni_settled_total),round((($result->ara_settled_amount/100000)+($result->ni_settled_amount/100000)),3),($result->ara_unsettled_total+$result->ni_unsettled_total),round((($result->ara_unsettled_amount/100000)+($result->ara_unsettled_amount/100000)),3));
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;

    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    
    $objPHPExcel->getActiveSheet()->setTitle('Statement Report');
    
    //end
    
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    /** PHPExcel_IOFactory */
    require_once './application/Classes/PHPExcel/IOFactory.php';
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="statementReport-'.date('d-M-Y').'.xls"');   
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');   
    exit(); 
    

  }
  function make_statement_xl_court($branch)
  {
   
    $csrf_token=$this->security->get_csrf_hash();
    $str="SELECT q.* FROM ref_branch_sol q
    WHERE q.code=".$this->db->escape($branch)." LIMIT 1";
    $query=$this->db->query($str);
    $branch_data = $query->row();
    $result = $this->Bb_rt_model->get_statement_result_court($branch);

    date_default_timezone_set('Asia/Dhaka');    
    require_once('./application/Classes/PHPExcel.php'); 
    
    global $objPHPExcel;
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
      'font' => array(
      'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
      )
    );
    function cellColor($cells,$color){
          global $objPHPExcel;
          $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
          ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
          'startcolor' => array('rgb' => $color)
          ));
      }
    $styleArray_border = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      );
    $cyan_style = array(
                  'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          'color' => array('rgb'=>'F1E6DC'),
                  )
                  
          );
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $rowNumber = 1;
    $headings1 = array('Name of the Bank : BRAC Bank PLC.');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;
    $headings1 = array('Statement of Cases filed & Settled in Artho Rin & Dewlia Adalat');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('Branch Name: '.$branch_data->name);
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('As on ('.date('d-M-Y').')','','','','','','','','','In Lac');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':I'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('SL','Name of Court','Number & Amount of Case Filed (Cumulative)','','Number & Amount of Case Settled/Decree','','','Number & Amount of Case Unsettled ','','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':D'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':G'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowNumber.':J'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(35);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('','','No. of Cases','Claimed Amount ','No. of Cases','Claimed Amount','Actual Realization','No. of Cases ','Amount Claimed','Actual Realization on pending case');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('1','2','3','4','5','6','7','8','9','10');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;
    $total_c=0;
    $total_a=0;
    $total_s_c=0;
    $total_s_a=0;
    $total_u_c=0;
    $total_u_a=0;
     $sl=1;
    foreach ($result as $key) 
    {
        $sl++;
        $total_c=($total_c+$key->total_counter);
        $total_a=($total_a+($key->total_amount/100000));
        $total_s_c=($total_s_c+$key->settled_total);
        $total_s_a=($total_s_a+($key->settled_amount/100000));
        $total_u_c=($total_u_c+$key->unsettled_total);
        $total_u_a=($total_u_a+($key->unsettled_amount/100000));
        $headings1 = array($sl,$key->name,$key->total_counter,round(($key->total_amount/100000),3),$key->settled_total,round(($key->settled_amount/100000),3),'',$key->unsettled_total,round(($key->unsettled_amount/100000),3),'');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
    }
    
    $headings1 = array('Total','',$total_c,round($total_a,3),$total_s_c,round($total_s_a,3),'',$total_u_c,round($total_u_a,3),'');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;

    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    
    $objPHPExcel->getActiveSheet()->setTitle('Statement Report Court');
    
    //end
    
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    /** PHPExcel_IOFactory */
    require_once './application/Classes/PHPExcel/IOFactory.php';
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="statementReportcourt-'.date('d-M-Y').'.xls"');   
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');   
    exit(); 
    

  }
  function make_statement_xl_bangla($branch)
  {
   
    $csrf_token=$this->security->get_csrf_hash();
    $str="SELECT q.* FROM ref_branch_sol q
    WHERE q.code=".$this->db->escape($branch)." LIMIT 1";
    $query=$this->db->query($str);
    $branch_data = $query->row();
    $result = $this->Bb_rt_model->get_statement_result_court($branch);

    date_default_timezone_set('Asia/Dhaka');    
    require_once('./application/Classes/PHPExcel.php'); 
    
    global $objPHPExcel;
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
      'font' => array(
      'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE,
      'name'  =>  'SutonnyMJ'
      )
    );
    function cellColor($cells,$color){
          global $objPHPExcel;
          $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
          ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
          'startcolor' => array('rgb' => $color)
          ));
      }
    $styleArray_border = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      );
    $styleArray2 = [
        'font' => [
            'name'  =>  'SutonnyMJ'
        ]
    ];
    $cyan_style = array(
                  'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          'color' => array('rgb'=>'F1E6DC'),
                  )
                  
          );
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $rowNumber = 1;
    $headings1 = array('Name of the Bank : BRAC Bank PLC.');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;
    $headings1 = array('Statement of Cases filed & Settled in Artho Rin & Dewlia Adalat');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('Branch Name: '.$branch_data->name);
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('As on ('.date('d-M-Y').')','','','','','','','','','In Lac');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':I'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('µwgK bs','Av`vj‡Zi bvg','`v‡qiK„Z gvgjv (K«g cyÄxfyZ)','','wb®cwËK„Z gvgjv (K«g cyÄxfyZ)','','','wePvivaxb gvgjv','','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':D'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':G'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowNumber.':J'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(35);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray2);
    $rowNumber++;

    $headings1 = array('','','msL¨v','`vexK„Z A‡_©i cwigvY','msL¨v','`vexK„Z A‡_©i cwigvY','c«K„Z Av`vq','msL¨v','`vexK„Z A‡_©i cwigvY','wePvivaxb gvgjvi `vexK„Z A‡_©i wecix†Z Av`vqK„Z A‡_©i cwigvY');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray2);
    $rowNumber++;

    $headings1 = array('1','2','3','4','5','6','7','8','9','10');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray2);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;
    $total_c=0;
    $total_a=0;
    $total_s_c=0;
    $total_s_a=0;
    $total_u_c=0;
    $total_u_a=0;
     $sl=1;
    foreach ($result as $key) 
    {
        $sl++;
        $total_c=($total_c+$key->total_counter);
        $total_a=($total_a+($key->total_amount/100000));
        $total_s_c=($total_s_c+$key->settled_total);
        $total_s_a=($total_s_a+($key->settled_amount/100000));
        $total_u_c=($total_u_c+$key->unsettled_total);
        $total_u_a=($total_u_a+($key->unsettled_amount/100000));
        $headings1 = array($sl,$key->name,$key->total_counter,round(($key->total_amount/100000),3),$key->settled_total,round(($key->settled_amount/100000),3),'',$key->unsettled_total,round(($key->unsettled_amount/100000),3),'');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleArray2);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray2);
        $rowNumber++;
    }
    
    $headings1 = array('‡gvU','',$total_c,round($total_a,3),$total_s_c,round($total_s_a,3),'',$total_u_c,round($total_u_a,3),'');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray2);
    $rowNumber++;

    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    
    $objPHPExcel->getActiveSheet()->setTitle('Statement Report Court');
    
    //end
    
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    /** PHPExcel_IOFactory */
    require_once './application/Classes/PHPExcel/IOFactory.php';
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="statementReportcourt-'.date('d-M-Y').'.xls"');   
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');   
    exit(); 
    

  }
  function make_statement_xl_classified($branch)
  {
   
    $csrf_token=$this->security->get_csrf_hash();
    $str="SELECT q.* FROM ref_branch_sol q
    WHERE q.code=".$this->db->escape($branch)." LIMIT 1";
    $query=$this->db->query($str);
    $branch_data = $query->row();
    $result = $this->Bb_rt_model->get_statement_result_classified($branch);

    $month =  date('m');
    $present_month = (int)$month;
    //For The Present Quarter Segemnt
    $str="SELECT q.* FROM ref_quarter q
    WHERE FIND_IN_SET($present_month, q.value) LIMIT 1";
    $query=$this->db->query($str);
    $present_quarter = $query->row();

    $present_quarter_months = $present_quarter->segment_text;
    $present_quarter_segment = $present_quarter->segment;

    //For Previous Quarter Segment
    $previous_quarter_segement = ($present_quarter_segment-1);

    if($previous_quarter_segement<0)
    {
      $previous_quarter_segement = 4;
    }

    $str="SELECT q.* FROM ref_quarter q
    WHERE q.segment='".$previous_quarter_segement."' LIMIT 1";
    $query=$this->db->query($str);
    $previous_quarter = $query->row();
    $previous_quarter_months = $previous_quarter->segment_text;

    $str_html="";
    $total_pre_un=0;
    $total_prest_un=0;
    $total_prest_s=0;

    date_default_timezone_set('Asia/Dhaka');    
    require_once('./application/Classes/PHPExcel.php'); 
    
    global $objPHPExcel;
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
      'font' => array(
      'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
      )
    );
    function cellColor($cells,$color){
          global $objPHPExcel;
          $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
          ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
          'startcolor' => array('rgb' => $color)
          ));
      }
    $styleArray_border = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      );
    $cyan_style = array(
                  'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          'color' => array('rgb'=>'F1E6DC'),
                  )
                  
          );
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $rowNumber = 2;
    $headings1 = array('Statement of Classified Loans & Advance and Other Information\'s');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':F'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;
    $headings1 = array('for the Quarter ended '.date('M').', '.date('Y'));
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':F'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber.':F'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('of '.$branch_data->name.' (Excluding Brahamanbaria District)');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':F'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber.':F'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('Branch Name: '.$branch_data->name);
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':F'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber.':F'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('Total Deposit at the end of Present quarter','Total no. of suits pending at the end of previous quarter','Total no. of suits settled during the  present quarter','Total no. of suits pending at the end of present quarter','Foreign inward remittance during previous quarter');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(40);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;

    $headings1 = array('10','11','12','13','14');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;
    $headings1 = array('','','','','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;
    $headings1 = array($branch_data->name,$previous_quarter_months.'\''.date('y'),$present_quarter_months.'\''.date('y'),'As on'.date('M').'\''.date('y'),'New Cases');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':F'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(35);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;
    $headings1 = array('','Sl # 13','Sl # 12','Sl # 13','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($cyan_style);
    $rowNumber++;
    $total_c=0;
    $total_a=0;
    $total_s_c=0;
    $total_s_a=0;
    $total_u_c=0;
    $total_u_a=0;
    $sl=1;
    foreach ($result as $key) 
    {
        $sl++;
        $total_pre_un=($total_pre_un+$key->pre_unsettled_total);
        $total_prest_un=($total_prest_un+$key->prest_settled_total);
        $total_prest_s=($total_prest_s+$key->prest_unsettled_total);
        $headings1 = array($key->name,$key->pre_unsettled_total,$key->prest_settled_total,$key->prest_unsettled_total,'0');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
    }
    
    $headings1 = array('Total',$total_pre_un,$total_prest_un,$total_prest_s,'0');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;

    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    
    $objPHPExcel->getActiveSheet()->setTitle('Statement Report Classified');
    
    //end
    
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    /** PHPExcel_IOFactory */
    require_once './application/Classes/PHPExcel/IOFactory.php';
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="statementReportclassified-'.date('d-M-Y').'.xls"');   
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');   
    exit(); 
    

  }
  function make_case_filed_xl_quarterly($quarter)
  {

    $csrf_token=$this->security->get_csrf_hash();
    
    $result = $this->Bb_rt_model->get_case_filed_quarterly($quarter);

    date_default_timezone_set('Asia/Dhaka');    
    require_once('./application/Classes/PHPExcel.php'); 
    
    global $objPHPExcel;
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
      'font' => array(
      'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
      )
    );
    function cellColor($cells,$color){
          global $objPHPExcel;
          $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
          ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
          'startcolor' => array('rgb' => $color)
          ));
      }
    $styleArray_border = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      );
    $cyan_style = array(
                  'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          'color' => array('rgb'=>'538DD5'),
                  )
                  
          );
    $styleArray = array(
    'font'  => array(
        'color' => array('rgb'=>'FFFFFF'),
        'name'  => 'Verdana'
    ));
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $rowNumber = 1;
    $headings1 = array('BRAC Bank PLC.');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('CASE FILED & SETTLED IN ARTHARIN ADALAT & OTHER COURT ');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('Quarterly Report '.date('d-M-Y'));
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;

    $headings1 = array('');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('BDT-Lac','','','','','','','','','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;

    $headings1 = array('Sl No','Name of the Court','No of Case Filed','','No of Settled Case','','','No of Case Running','','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1)); 
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1)); 
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':D'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':G'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowNumber.':J'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;

    $headings1 = array('','','No','Case Claim Amount','No','Claim Amount','Recovery Amount','No','Claim Amount','Recovery Amount');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('1','2','3','4','5','6','7','8','9','10');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;

    if (!empty($result)) 
    {
      $sl=0;
      foreach ($result as $key) 
      {
        $sl++;
        $segment = explode("##",$key->loan_segment);
        $no_case_filed = explode("##",$key->no_case_filed);
        $no_case_claim_amount = explode("##",$key->no_case_claim_amount);
        $no_of_setteled = explode("##",$key->no_of_setteled);
        $no_of_setteled_amount = explode("##",$key->no_of_setteled_amount);
        $no_of_case_running = explode("##",$key->no_of_case_running);
        $no_of_case_running_amount = explode("##",$key->no_of_case_running_amount);
        $rowspan = count($segment);

        $headings1 = array($sl,$key->court_name,$key->total_no_case_filed,round(($key->total_no_case_claim_amount/100000),3),$key->total_no_of_setteled,round(($key->total_no_of_setteled_amount/100000),3),'0',$key->total_no_of_case_running,round(($key->total_no_of_case_running_amount/100000),3),'0');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+$rowspan)); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleArray_border);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($cyan_style);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        for ($i=0; $i < count($segment); $i++) 
        {
          $headings1 = array('',$segment[$i],$no_case_filed[$i],round(($no_case_claim_amount[$i]/100000),3),$no_of_setteled[$i],round(($no_of_setteled_amount[$i]/100000),3),'0',$no_of_case_running[$i],round(($no_of_case_running_amount[$i]/100000),3),'0');
          $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
          $rowNumber++;
        }
      }
    }

    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    
    $objPHPExcel->getActiveSheet()->setTitle('Quarterly Report');
    
    //end
    
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    /** PHPExcel_IOFactory */
    require_once './application/Classes/PHPExcel/IOFactory.php';
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="quarterlyreport-'.date('d-M-Y').'.xls"');   
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');   
    exit(); 
    

  }
  function make_case_filed_xl_quarterly_seg($quarter)
  {

    $csrf_token=$this->security->get_csrf_hash();
    $total_c = 0;
    $total_am = 0;
    $total_c_p = 0;
    $total_c_a = 0;
    $total_c_cp = 0;
    $total_a_pa = 0;
    $total_s_c = 0;
    $total_s_a = 0;
    $total_un_c = 0;
    $total_un_a = 0;
    $result = $this->Bb_rt_model->get_case_filed_quarterly_seg($quarter);

    date_default_timezone_set('Asia/Dhaka');    
    require_once('./application/Classes/PHPExcel.php'); 
    
    global $objPHPExcel;
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
      'font' => array(
      'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
      )
    );
    function cellColor($cells,$color){
          global $objPHPExcel;
          $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
          ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
          'startcolor' => array('rgb' => $color)
          ));
      }
    $styleArray_border = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      );
    $cyan_style = array(
                  'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          'color' => array('rgb'=>'538DD5'),
                  )
                  
          );
    $styleArray = array(
    'font'  => array(
        'color' => array('rgb'=>'FFFFFF'),
        'name'  => 'Verdana'
    ));
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
    $rowNumber = 1;
    $headings1 = array('BRAC Bank PLC.');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':M'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('CASE FILED & SETTLED IN ARTHARIN ADALAT');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':M'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('Quarterly Report '.date('d-M-Y'));
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':M'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;

    $headings1 = array('');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':M'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('BDT-Lac','','','','','','','','','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':M'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;

    $headings1 = array('Type','No of Case Filed & Case Claim Amount','','No of Case Filed in Present Quarter ','','Total No of Case Filed & Case Claim Amount','','No of Case Settled & Case Claim Amount','','No of Case Unsettled & Case Claim Amount','','Remarks');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1)); 
    $objPHPExcel->getActiveSheet()->mergeCells('M'.$rowNumber.':M'.($rowNumber+1)); 
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$rowNumber.':D'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowNumber.':J'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('K'.$rowNumber.':L'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(30);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;

    $headings1 = array('','No','Claim Amount','No','Claim Amount','No (2 + 4)','Case Claim Amount (3 + 5)','No','Claim Amount','No','Claim Amount');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('1','2','3','4','5','6','7','8','9','10','11','12');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
    $rowNumber++;

    if (!empty($result)) 
    {
      $sl=0;
      foreach ($result as $key) 
      {
        $sl++;
        $total_c = ($total_c+$key->no_case_filed);
        $total_am = ($total_am+round(($key->no_case_claim_amount/100000),3));
        $total_c_p = ($total_c_p+$key->no_case_filed_prest);
        $total_c_a = ($total_c_a+round(($key->no_case_claim_amount_prest/100000),3));
        $total_c_cp = ($total_c_cp+$key->no_case_filed+$key->no_case_filed_prest);
        $total_a_pa = ($total_a_pa+round(($key->no_case_claim_amount/100000),3)+round(($key->no_case_claim_amount_prest/100000),3));
        $total_s_c = ($total_s_c+$key->no_of_setteled);
        $total_s_a = ($total_s_a+round(($key->no_of_setteled_amount/100000),3));
        $total_un_c = ($total_un_c+$key->no_of_case_running);
        $total_un_a = ($total_un_a+round(($key->no_of_case_running_amount/100000),3));

        $headings1 = array($key->name,$key->no_case_filed,round(($key->no_case_claim_amount/100000),3),$key->no_case_filed_prest,round(($key->no_case_claim_amount_prest/100000),3),($key->no_case_filed+$key->no_case_filed_prest),round((round(($key->no_case_claim_amount/100000),3)+round(($key->no_case_claim_amount_prest/100000),3)),3),$key->no_of_setteled,round(($key->no_of_setteled_amount/100000),3),$key->no_of_case_running,round(($key->no_of_case_running_amount/100000),3),'');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleArray_border);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
      }

      $headings1 = array('Total',$total_c,$total_am,$total_c_p,$total_c_a,$total_c_cp,$total_a_pa,$total_s_c,$total_s_a,$total_un_c,$total_un_a,'');
      $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'B'.$rowNumber);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setWrapText(true);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(10);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleArray_border);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
      $rowNumber++;
    }

    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    
    $objPHPExcel->getActiveSheet()->setTitle('Quarterly Report');
    
    //end
    
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    /** PHPExcel_IOFactory */
    require_once './application/Classes/PHPExcel/IOFactory.php';
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="quarterlyreport-'.date('d-M-Y').'.xls"');   
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');   
    exit(); 
    

  }
  function make_case_filed_xl_internal($year)
  {

    $csrf_token=$this->security->get_csrf_hash();
    $result = $this->Bb_rt_model->get_internal_report($year);
    $total_c_ar = 0;
      $total_am_ar = 0;
      $total_c_ni= 0;
      $total_am_ni = 0;
      $total_c_pi = 0;
      $total_am_pi = 0;
      $total_c_d_ar = 0;
      $total_am_d_ar = 0;
      $total_c_d_ni = 0;
      $total_am_d_ni = 0;
      $total_c_d_pi = 0;
      $total_am_d_pi = 0;
      $total_rec_c_ara = 0;
      $total_rec_c_ni = 0;
      $total_rec_am_ara = 0;
      $total_rec_am_ni = 0;
      $total_fil = 0;
      $total_amount = 0;
      $total_desposal = 0;
      $total_recovery = 0;

    date_default_timezone_set('Asia/Dhaka');    
    require_once('./application/Classes/PHPExcel.php'); 
    
    global $objPHPExcel;
    $objPHPExcel = new PHPExcel();
    $styleArray = array(
      'font' => array(
      'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
      )
    );
    function cellColor($cells,$color){
          global $objPHPExcel;
          $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
          ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
          'startcolor' => array('rgb' => $color)
          ));
      }
    $styleArray_border = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
      );
    $cyan_style = array(
                  'fill' => array(
                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
                          'color' => array('rgb'=>'538DD5'),
                  )
                  
          );
    $styleArray = array(
    'font'  => array(
        'color' => array('rgb'=>'FFFFFF'),
        'name'  => 'Verdana'
    ));
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
    $rowNumber = 1;
    $headings1 = array('Data Requirement  of'.$year,'','','','','','','','','','','','','','','','','At galance-'.$year,'','','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':Q'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('R'.$rowNumber.':U'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('Month','Filing','','','','','','Disposal/Case Withdrawal','','','','','','Appeal/Bail Money recovery','','','','Total','','Total ','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+2)); 
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':G'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowNumber.':M'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('N'.$rowNumber.':Q'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('R'.$rowNumber.':S'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('T'.$rowNumber.':U'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('','ARA-2003','','NI Act-138','','Penal Code','','ARA-2003','','NI Act-138','','Penal Code','','From Jari Suit','','From NI Act Appeal','',' Filing','CC AMT','Disposal ','Rec');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':E'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':G'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('H'.$rowNumber.':I'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('J'.$rowNumber.':K'.$rowNumber); 
    $objPHPExcel->getActiveSheet()->mergeCells('L'.$rowNumber.':M'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('N'.$rowNumber.':O'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('P'.$rowNumber.':Q'.$rowNumber);
    $objPHPExcel->getActiveSheet()->mergeCells('R'.$rowNumber.':R'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('S'.$rowNumber.':S'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('T'.$rowNumber.':T'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->mergeCells('U'.$rowNumber.':U'.($rowNumber+1));
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    $headings1 = array('','No. of Case','CC AMT','No. of Case','CC AMT','No. of Case','CC AMT','No. of Case','Rec','No. of Case','Rec','No. of Case','Rec','Acc','Rec','Acc','Rec','','','','');
    $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getFont()->setSize(10);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray_border);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($cyan_style);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray);
    $rowNumber++;
    if (!empty($result)) 
    {
      foreach ($result as $key) 
      {
        $req_type = explode("##",$key->req_type);
        $no_of_setteled = explode("##",$key->no_of_setteled);
        $no_case_filed = explode("##",$key->no_case_filed);
        $no_case_claim_amount = explode("##",$key->no_case_claim_amount);
        $no_case_claim_amount_settled = explode("##",$key->no_case_claim_amount_settled);
        $recovery_amount = explode("##",$key->recovery_amount);
        $total_recovered = explode("##",$key->total_recovered);
        $index = array_search('2', $req_type); // For ARA-SEARCH
        $index2 = array_search('1', $req_type); //For Ni Act Search

        $ara_t_case = ($index>=0) ? $no_case_filed[$index] : 0;
        $ara_t_amount = ($index>=0) ? $no_case_claim_amount[$index] : 0;

        $ni_t_case = ($index2>=0) ? $no_case_filed[$index2] : 0;
        $ni_t_amount = ($index2>=0) ? $no_case_claim_amount[$index2] : 0;

        $pi_t_case = 0;
        $pi_t_amount = 0;

        $ara_t_d_case = ($index>=0) ? $no_of_setteled[$index] : 0;
        $ara_t_d_amount = ($index>=0) ? $no_case_claim_amount_settled[$index] : 0;

        $ni_t_d_case = ($index2>=0) ? $no_of_setteled[$index2] : 0;
        $ni_t_d_amount = ($index2>=0) ? $no_case_claim_amount_settled[$index2] : 0;

        $pi_t_d_case = 0;
        $pi_t_d_amount = 0;
        
        $ara_t_r_case = ($index>=0) ? $total_recovered[$index] : 0;
        $ara_t_r_amount = ($index>=0) ? $recovery_amount[$index] : 0;

        $ni_t_r_case = ($index2>=0) ? $total_recovered[$index2] : 0;
        $ni_t_r_amount = ($index2>=0) ? $recovery_amount[$index2] : 0;

        $total_filling = ($ara_t_case+$ni_t_case+$pi_t_case);
        $total_cc_amount = ($ara_t_amount+$ni_t_amount+$pi_t_amount);
        $total_disposal = ($ara_t_d_case+$ni_t_d_case+$pi_t_d_case);
        $total_rec = ($ara_t_r_case+$ni_t_r_case);
        //For Grand Total
        $total_c_ar = ($total_c_ar+$ara_t_case);
        $total_am_ar =($total_am_ar+$ara_t_amount);
        $total_c_ni= ($total_c_ni+$ni_t_case);
        $total_am_ni = ($total_am_ni+$ni_t_amount);
        $total_c_pi =($total_c_pi+$pi_t_case);
        $total_am_pi = ($total_am_pi+$pi_t_amount);
        $total_c_d_ar = ($total_c_d_ar+$ara_t_d_case);
        $total_am_d_ar = ($total_am_d_ar+$ara_t_d_amount);
        $total_c_d_ni = ($total_c_d_ni+$ni_t_d_case);
        $total_am_d_ni = ($total_am_d_ni+$ni_t_d_amount);
        $total_c_d_pi = ($total_c_d_pi+$pi_t_d_case);
        $total_am_d_pi = ($total_am_d_pi+$pi_t_d_amount);
        $total_rec_c_ara = ($total_rec_c_ara+$ara_t_r_case);
        $total_rec_c_ni = ($total_rec_c_ni+$ni_t_r_case);
        $total_rec_am_ara = ($total_rec_am_ara+$ara_t_r_amount);
        $total_rec_am_ni = ($total_rec_am_ni+$ni_t_r_amount);
        $total_fil = ($total_fil+$total_filling);
        $total_amount = ($total_amount+$total_cc_amount);
        $total_desposal = ($total_desposal+$total_disposal);
        $total_recovery = ($total_recovery+$total_rec);

         $headings1 = array($key->month_name,$ara_t_case,$ara_t_amount,$ni_t_case,$ni_t_amount,$pi_t_case,$pi_t_amount,$ara_t_d_case,$ara_t_d_amount,$ni_t_d_case,$ni_t_d_amount,$pi_t_d_case,$pi_t_d_amount,$ara_t_r_case,$ara_t_r_amount,$ni_t_r_case,$ni_t_r_amount,$total_filling,$total_cc_amount,$total_disposal,$total_rec);
          $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getFont()->setSize(10);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray_border);
          
        $rowNumber++;
      }

      $headings1 = array('Grand Total',$total_c_ar,$total_am_ar,$total_c_ni,$total_am_ni,$total_c_pi,$total_am_pi,$total_c_d_ar,$total_am_d_ar,$total_c_d_ni,$total_am_d_ni,$total_c_d_pi,$total_am_d_pi,$total_rec_c_ara,$total_rec_c_ni,$total_rec_am_ara,$total_rec_am_ni,$total_fil,$total_amount,$total_desposal,$total_recovery);
          $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getFont()->setSize(10);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
          $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleArray_border);
          
        $rowNumber++;
    }

    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
    
    $objPHPExcel->getActiveSheet()->setTitle('Internal Report');
    
    //end
    
    
    $objPHPExcel->setActiveSheetIndex(0);
    
    /** PHPExcel_IOFactory */
    require_once './application/Classes/PHPExcel/IOFactory.php';
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-Disposition: attachment;filename="internalreport-'.date('d-M-Y').'.xls"');   
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');   
    exit(); 
    

  }
	
}
?>