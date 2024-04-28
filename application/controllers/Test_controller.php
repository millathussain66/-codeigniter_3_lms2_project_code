<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', true);
        $this->load->model('User_info_model', '', true);
        $this->load->model('Common_model', '', true);
        $this->load->model('Legal_notice_model', '', true);
        $this->load->model('Legal_notice_ho_model', '', true);
        $this->load->model('Cma_ho_model', '', true);
        $this->load->model('Cma_process_model', '', true);
        $this->load->helper('form');
        $this->load->helper('url');
    }
    function test()
    {
        
    }

    function update_prev_date()
    {
        $str2="SELECT  j0.id,j0.initial_case_sts,j0.prev_date,j0.case_sts_prev_dt,j0.initial_case_sts_dt,j0.last_case_sts_id
                 FROM suit_filling_info j0
             WHERE (j0.suit_sts=75 or j0.suit_sts=76)";   
        $suit_data=$this->db->query($str2)->result();
        foreach($suit_data as $key)
        {
            $data2=array();
            $str="SELECT  j0.*
                             FROM change_request j0
                         WHERE j0.sts<>0 AND j0.suit_file_id='".$key->id."' AND j0.sts=51 AND j0.id<>'".$key->last_case_sts_id."' ORDER BY j0.id DESC LIMIT 1";
            $status_data=$this->db->query($str)->row();
            if(!empty($status_data))
            {
                $data2['last_step'] = $status_data->case_sts;
                $data2['last_date'] = $status_data->case_dt;
                $this->db->where('id', $key->id);
                $this->db->update('suit_filling_info', $data2);
            }
            else if(empty($status_data) && $key->last_case_sts_id!=0 && $key->last_case_sts_id!=NULL && $key->last_case_sts_id!='')
            {
                $data2['last_step'] = $key->initial_case_sts;
                $data2['last_date'] = $key->initial_case_sts_dt;
                $this->db->where('id', $key->id);
                $this->db->update('suit_filling_info', $data2);
            }
            else
            {
                $data2['last_step'] = $key->case_sts_prev_dt;
                $data2['last_date'] = $key->prev_date;
                $this->db->where('id', $key->id);
                $this->db->update('suit_filling_info', $data2);
            }
        }
        echo "Success";
        exit;
    }

    function update_prev_filling_date()
    {
        $str2="SELECT  j0.id,j0.filling_date,j0.pre_suit_id
                 FROM suit_filling_info j0
             WHERE (j0.suit_sts=75 or j0.suit_sts=76) AND j0.re_case_sts=1";   
        $suit_data=$this->db->query($str2)->result();
        foreach($suit_data as $key)
        {
            $prev_filling_date="";
            $data2=array();
            $suit_id = $key->pre_suit_id;
            while(1)
            {
                if($suit_id == 0)
                {
                    break;
                }
                $str="SELECT  DATE_FORMAT(j0.filling_date,'%d-%m-%Y') as filling_date,j0.pre_suit_id
                             FROM suit_filling_info j0
                         WHERE (j0.sts<>0 OR (j0.sts=0 AND j0.merged_sts=1)) AND j0.id='".$suit_id."' LIMIT 1";
                $pre_suit_data=$this->db->query($str)->row();
                if(!empty($pre_suit_data))
                {
                    if($prev_filling_date=='')
                    {
                        $prev_filling_date.=$pre_suit_data->filling_date;
                    }
                    else
                    {
                        $prev_filling_date.=', '.$pre_suit_data->filling_date;
                    }
                    if($pre_suit_data->pre_suit_id!=0 && $pre_suit_data->pre_suit_id!=NULL && $pre_suit_data->pre_suit_id!='')
                    {
                        $suit_id = $pre_suit_data->pre_suit_id;
                    }
                    else
                    {
                        $suit_id = 0;
                    }
                }
                else
                {
                    $suit_id =0;
                }
            }
            $data2['prev_filling_date'] = $prev_filling_date;
            $this->db->where('id', $key->id);
            $this->db->update('suit_filling_info', $data2);
        }
        echo "Success";
        exit;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
