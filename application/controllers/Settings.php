<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

        $this->load->model('User_model', '', true);
        $this->load->helper('form');
        $this->load->helper('url');
    }
	
	function index($menu_group=NULL,$menu_cat=NULL)
	{
		$this->load->view('settings/common');
		$this->load->view('settings/header');		
		$this->load->view('settings/header_body');
		$this->load->view('settings/sit');
		$this->load->view('settings/footer');
	}

	function index_update()
	{
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		echo 'OK';
	}

	function default_pass()
	{
		$this->load->view('settings/common');
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/default_pass');
		$this->load->view('settings/footer');
	}

	function default_pass_update()
	{
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		echo 'OK';
	}

	function sit($menu_group=NULL,$menu_cat=NULL)
	{
		$this->load->view('settings/common');
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/sit');
		$this->load->view('settings/footer');
	}
	function apc($menu_group=NULL,$menu_cat=NULL)
	{
		$this->load->model('User_model', '', TRUE);
		$data = array(
		 'api' => $this->User_model->get_api_config_data('api_config','sts=1'),
		 'api_type'=>$this->User_model->get_enum_data('api_config','api_type'),
		 'dev_live'=>$this->User_model->get_enum_data('api_config','dev_live'),
		 );
		$this->load->view('settings/common');
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/apc',$data);
		$this->load->view('settings/footer');
	}
	function user_search()
	{
		
		$this->load->view('settings/common');
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/user_search');
		$this->load->view('settings/footer');
	}

	function sit_update()
	{		
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		echo 'OK';
	}
	function apc_update()
	{	
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		echo 'OK';
	}

	function ip_map()
	{
		$this->load->view('settings/common');
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');		
		$this->load->view('settings/ip_map');
		$this->load->view('settings/footer');
	}

	function ip_map_update()
	{
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		echo 'OK';
	}
	
	function activities_report()
	{
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/activities_report');
		$this->load->view('settings/footer');
	}
	function xl_activities_report($activities_list,$userid,$fromdate=null,$todate=null){
		

		$where=" ac_h.activities_id IS NOT NULL ";
		$activities='';
		if($activities_list!=0)
		{
			$where.=" and ac_h.activities_id=".$this->db->escape($activities_list);
			$activities=$activities_list;
		}
		if($userid!=0)
		{
			$where.=" and u.user_id=".$this->db->escape(trim($userid));
		}

		if($fromdate!=0 && $todate==0)
		{					
			$where.=" AND DATE(ac_h.activities_datetime) = ".$this->db->escape($fromdate);
		}
		if($fromdate!=0 && $todate!=0)
		{
			//$dat_from_ary=explode("/",$_POST['dt_from']);
			//$dat_to_ary=explode("/",$_POST['dt_to']);
			
			$where.=" AND DATE(ac_h.activities_datetime) >=".$this->db->escape($fromdate)." AND DATE(ac_h.activities_datetime) <= ".$this->db->escape($todate);
		}

		if($where!=""){
			$cont="WHERE";
		}else{
			$cont="";
		}
		$str="SELECT act.name AS actName,u.user_id as userId,u.name as userName,  ac_h.*
			FROM user_activities_history ac_h
			LEFT OUTER JOIN ref_status act ON (ac_h.activities_id=act.id)
			LEFT OUTER JOIN users_info u ON (ac_h.activities_by=u.id) ".$cont." ".$where;
		$str .="ORDER BY ac_h.activities_datetime DESC ";
		$qry=$this->db->query($str);
		$result = $qry->result_array();

		$fromdate = $fromdate==0?'':date_format(new DateTime($fromdate),"d-M-Y");
		$todate = $todate==0?'':date_format(new DateTime($todate),"d-M-Y");
		//echo "<pre>";
        //print_r($result);
        //echo "</pre>";
         $sn = 1;

        require_once('./application/Classes/PHPExcel.php'); 
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $styleArray_border = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
              )
          ); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
        $rowNumber = 1;
        
        
        $headings1 = array('User Activities Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':G'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':G'.$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $headings1 = array('Date From ('.$fromdate.' To '.$todate.')');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':G'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':G'.$rowNumber)->applyFromArray($styleArray_border);
        
        $rowNumber++;
        $headings2 = array('SL No.','Activities','Activities Date & Time','IP','User ID','Name','Description');
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':G'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':G'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':G'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':G'.$rowNumber)->applyFromArray($styleArray_border);

        $rowNumber++;
       
        
                foreach($result as $row){
                    $description= $row['description_activities'];
					if($row['oprs_reason']!='')
					{
						$description .=' ('.$row['oprs_reason'].')';
					}
					$objPHPExcel->getActiveSheet()->fromArray(array(
                                $sn,
                                $row['actName'],
                                $row['activities_datetime'],
                                $row['ip_address'],
                                $row['userId'],
                                $row['userName'],
                                $description
                                ),NULL,'A'.$rowNumber);
                            $rowNumber++;
                            $sn++;
                }
            
                
                $rowNumber++;
                $rowNumber--;
                $rowNumber--;
     
         
        $objPHPExcel->getActiveSheet()->getStyle('A4:G'.$rowNumber)->applyFromArray($styleArray_border);     

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('User Activities Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="user_activities_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');  
		exit();
	}

	function operational_report()
	{
		
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/operational_report');
		$this->load->view('settings/footer');
	}

	function user_list_report()
	{
		
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/user_list_report');
		$this->load->view('settings/footer');
	}
	function xl_user_list_report($activities_list=0){		
		
		$where=" where u.data_status=1 ";
		$activities='';
		if($activities_list!=0)
		{
			if($activities_list=='1')
			{
				$where.=" and u.block_status='0' and u.lock_status='0' ";
			}
			else if($activities_list=='2')
			{
				$where.=" and u.block_status='1' ";
			}
			else if($activities_list=='3')
			{
				$where.=" and u.lock_status='1' ";
			}


			$activities=$activities_list;
		}


		 $str="SELECT u.id, u.user_id as userId,u.name as userName,
		case when  u.lock_status = 1 then
         'Lockout' else
         case when  u.block_status = 1 then  'Inactive' else  'Active' end end
      	as Sts
		FROM users_info u  ".$where."  order by u.user_id ASC ";
		//echo $str;exit;
		$qry=$this->db->query($str);

		$result = $qry->result_array();

		
		
         $sn = 1;

        require_once('./application/Classes/PHPExcel.php'); 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $styleArray_border = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
              )
          ); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
        $rowNumber = 1;
        $headings1 = array('User List Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':F'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
        
        
        $rowNumber++;
        $headings2 = array('SL No.','User ID','Name','Status','Updated Date','Description');
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
                foreach($result as $row){
                	$date_time=''; $Description='';
						if($row['Sts']!='Active'){
							if($row['Sts']=='Inactive'){$activities_id=49;}else{$activities_id=54;}
							$str_inr="select activities_datetime,description_activities from user_activities_history
							where activities_id=".$activities_id." and table_name='users_info' and table_row_id='".$row['id']."'
							 order by id DESC LIMIT 1";
							if($qry_inr = $this->db->query($str_inr))
							{
								$obj = $qry_inr->row();
								if(is_object($obj)){
									$date_time=date('d-M-Y, h:i:s a',strtotime($obj->activities_datetime));
									$Description=$obj->description_activities;
								}
							}
						}

                    $objPHPExcel->getActiveSheet()->fromArray(array(
                                $sn,
                                $row['userId'],
                                $row['userName'],
                                $row['Sts'],
                                $date_time,
                                $Description
                                ),NULL,'A'.$rowNumber);
                            $rowNumber++;
                            $sn++;
                }
            
                
                $rowNumber++;
                $rowNumber--;
                $rowNumber--;
     
     
        
        $objPHPExcel->getActiveSheet()->getStyle('A3:F'.$rowNumber)->applyFromArray($styleArray_border);     

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('User List Report'); 
		
		
		require_once './application/Classes/PHPExcel/IOFactory.php';
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		ob_clean();
		header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
		header("Content-type:   application/x-msexcel; charset=utf-8");
		header('Content-Disposition: attachment;filename="user_list_report.xlsx"');
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		$objWriter->save('php://output');   
		exit();
		
		phpinfo();
		
		require_once './application/Classes/PHPExcel/IOFactory.php';
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');  
		header('Content-Disposition: attachment;filename="Global_Search.xls"');   
		header('Cache-Control: max-age=0');
		$objWriter->save('php://output');   
		exit();	
		
		
		var_dump($objPHPExcel).'hhh';
		exit;
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="user_list_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');  
        exit();
	}

	function user_log_report()
	{
		$this->load->view('settings/common');
		
		if(count($_POST)>0){
			$this->update();
		}
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/user_log_report');
		$this->load->view('settings/footer');
	}
	function xl_user_log_report($userid,$fromdate=null,$todate=null){
		
		$where=' where 1=1 ';
		
		$activities_list='';

		if($userid!=0)
		{
			$where.=" and ac_h.user_id='".trim($userid)."' ";
			$activities_list=$userid;
		}
		if($fromdate!=0 && $todate==0)
		{
			//$dat_from_ary=explode("/",$_POST['dt_from']);
			$where.=" AND DATE(ac_h.login_datetime) = ".$this->db->escape($fromdate);
		}
		if($fromdate!=0 && $todate!=0)
		{
			//$dat_from_ary=explode("/",$_POST['dt_from']);
			//$dat_to_ary=explode("/",$_POST['dt_to']);
			$where.=" AND DATE(ac_h.login_datetime) >=".$this->db->escape($fromdate)." AND DATE(ac_h.LOGIN_DATETIME) <= ".$this->db->escape($todate);
		}


		$str=" SELECT u.user_id as userId,u.name as userName,  ac_h.*,
				ac_h.last_activities as last_activities_1,
				ac_h.login_datetime as login_datetime_1
				FROM user_log_history ac_h
				LEFT OUTER JOIN users_info u ON ac_h.user_id=u.id ".$where." order by ac_h.login_datetime DESC ";
		///echo $str; //exit;
		$qry=$this->db->query($str);

		$result = $qry->result_array();

		$fromdate = $fromdate==0?'':date_format(new DateTime($fromdate),"d-M-Y");
		$todate = $todate==0?'':date_format(new DateTime($todate),"d-M-Y");
		//echo "<pre>";
        //print_r($result);
        //echo "</pre>";
         $sn = 1;

        require_once('./application/Classes/PHPExcel.php'); 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $styleArray_border = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
              )
          ); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $rowNumber = 1;
        $headings1 = array('User Log Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':H'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $headings1 = array('Date From ('.$fromdate.' To '.$todate.')');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':H'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
        
        $rowNumber++;
        $headings2 = array('SL No.','User ID','Name','IP','Login Date Time','logout Date Time','Duration','Logout Status');
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
                foreach($result as $row){
                	$datetime1 = new DateTime($row['login_datetime_1']);
					$datetime2 = new DateTime($row['last_activities_1']);
					$interval = $datetime1->diff($datetime2);
					$duration = $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
					$logout = $row['logout_status']=='1'?'Yes':'No';

                    $objPHPExcel->getActiveSheet()->fromArray(array(
                                $sn,
                                $row['userId'],
                                $row['userName'],
                                $row['ip_address'],
                                $row['login_datetime_1'],
                                $row['last_activities_1'],
                                $duration,
                                $logout
                                ),NULL,'A'.$rowNumber);
                            $rowNumber++;
                            $sn++;
                }
            
                
                $rowNumber++;
                $rowNumber--;
                $rowNumber--;
     
        
        $objPHPExcel->getActiveSheet()->getStyle('A4:H'.$rowNumber)->applyFromArray($styleArray_border);     

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('User Log Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="user_log_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');  
        exit();
	}

	function client_info()
	{
		
		$this->load->view('settings/common');
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/client_info');
		$this->load->view('settings/footer');
	}
	function client_update()
	{
		
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		echo 'OK';
	}

	function contact_update()
	{
		
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		echo 'OK';
	}

	function smsemail()
	{
		
		$this->load->view('settings/common');
		$this->load->view('settings/header');
		$this->load->view('settings/header_body');
		$this->load->view('settings/smsemail');
		$this->load->view('settings/footer');
	}
	
	function smsemail_update()
	{
		
		$this->load->view('settings/common');
		if(count($_POST)>0){
			$this->update();
		}
		echo 'OK';
	}

	function update(){


		if($_POST['btn_type']=='default_password')
		{
			$sql = ("update users_info_config set password_validity_period = '".trim($_POST['password_validity_period'])."',
			default_password = '".trim($_POST['default_password'])."',			
			password_max_length = '".trim($_POST['password_max_length'])."',	password_min_length = '".trim($_POST['password_min_length'])."',			
			user_id_max_length = '".trim($_POST['user_id_max_length'])."',	user_id_min_length = '".trim($_POST['user_id_min_length'])."'			
			where id = '1'");
			$this->db->query($sql);	

			$data2 = $this->User_model->user_activities(55, '', 1, 'users_info_config', 'Password & User Id policy updated','', $this->session->userdata['ast_user']['user_id'], $this->session->userdata['ast_user']['user_full_id']);
			
		}
		if($_POST['btn_type']=='api')
		{
			if ($_POST['add_edit']==0) 
	        {
	           for($i=1;$i<= $_POST['api_info_counter'];$i++)
	            {
	            	if (isset($_POST['active_sts_'.$i]) && $this->input->post('active_sts_'.$i) == '1')
					{
						$active_sts=1;
					}
					else
					{
						$active_sts=0;
					}
	                $api = array(
	                'active_sts'=>$active_sts,
	                'dev_live' =>$this->security->xss_clean( $this->input->post('dev_live_'.$i)),
	                'api_type' =>$this->security->xss_clean( $this->input->post('api_type_'.$i)),
	                'api_url' =>$this->security->xss_clean( $this->input->post('api_url_'.$i)),
	                'api_name' =>$this->security->xss_clean( $this->input->post('api_name_'.$i)),
	                'user_id' =>$this->security->xss_clean( $this->input->post('user_id_'.$i)),
	                'channel_id' =>$this->security->xss_clean( $this->input->post('channel_id_'.$i)),
	                'password' =>$this->security->xss_clean( $this->input->post('password_'.$i))
	                );
	                if ($_POST['api_info_delete_'.$i]!=1) {
	                    $this->db->insert('api_config', $api);
	                }
	            }
	        }
	        //For Edit Api Config
	        else
	        {
	            for($i=1;$i<= $_POST['api_info_counter'];$i++)
	            {
	                if (isset($_POST['active_sts_'.$i]) && $this->input->post('active_sts_'.$i) == '1')
					{
						$active_sts=1;
					}
					else
					{
						$active_sts=0;
					}
	                $api = array(
	                'active_sts'=>$active_sts,
	                'dev_live' =>$this->security->xss_clean($this->input->post('dev_live_'.$i)),
	                'api_type' =>$this->security->xss_clean($this->input->post('api_type_'.$i)),
	                'api_url' =>$this->security->xss_clean( $this->input->post('api_url_'.$i)),
	                'api_name' =>$this->security->xss_clean( $this->input->post('api_name_'.$i)),
	                'user_id' =>$this->security->xss_clean( $this->input->post('user_id_'.$i)),
	                'channel_id' =>$this->security->xss_clean( $this->input->post('channel_id_'.$i)),
	                'password' =>$this->security->xss_clean( $this->input->post('password_'.$i))
	                );
	                // For skip The new deleted row
	                if ($_POST['api_info_edit_'.$i]==0 && $_POST['api_info_delete_'.$i]==1) 
	                {
	                    continue;
	                }
	                //For Delete the old row
	                if ($_POST['api_info_edit_'.$i]!=0 && $_POST['api_info_delete_'.$i]==1) 
	                {
	                    $data = array('sts' => 0);
	                    $this->db->where('id',$_POST['api_info_edit_'.$i]);
	                    $this->db->update('api_config', $data);
	                }
	                //For update the old row
	                else if($_POST['api_info_edit_'.$i]!=0 && $_POST['api_info_delete_'.$i]!=1)
	                {
	                    $this->db->where('id',$_POST['api_info_edit_'.$i]);
	                    $this->db->update('api_config', $api);
	                }
	                //For insert the new row
	                else if($_POST['api_info_edit_'.$i]==0 && $_POST['api_info_delete_'.$i]==0)
	                {
	                    $this->db->insert('api_config', $api);
	                }
	                
	            }
	        }
			
			$data2 = $this->User_model->user_activities(55, '', 1, 'users_info_config', 'API Setting Updated','', $this->session->userdata['ast_user']['user_id'], $this->session->userdata['ast_user']['user_full_id']);
			
		}		
		
		

		if($_POST['btn_type']=='isit')
		{
			$str="Select * from ".USER_TB_NAME." where upper(".USER_ID_NAME.")='".strtoupper(trim($_POST['User_Id_4_isit']))."' and ".USER_TB_STS_NAME."=1";
			$qry=$this->db->query($str);
			$no_row=$qry->num_rows();
			
			if($no_row>0){		
				$sql = ("update ".USER_TB_NAME." set SESSION_idle_time = ".$this->db->escape(trim($_POST['user_id_isit']))." where ".USER_ID_NAME."= '".trim($_POST['User_Id_4_isit'])."' and  ".USER_TB_STS_NAME."=1");
				$this->db->query($sql);
				
			$data2 = $this->User_model->user_activities(55, '', 1, 'users_info_config', 'Individual Idle Time '.$this->db->escape(trim($_POST['user_id_isit'])).' Minutes Update for '.$this->db->escape(trim($_POST['User_Id_4_isit'])),'', $this->session->userdata['ast_user']['user_id'], $this->session->userdata['ast_user']['user_full_id']);
					
			}
		}
		if($_POST['btn_type']=='gsit')
		{	
				$sql = ("update ".USER_TB_NAME." set SESSION_idle_time = ".$this->db->escape(trim($_POST['global_si_time']))." where  ".USER_TB_STS_NAME."=1");
				$this->db->query($sql);
				
				$sql = ("update users_info_config set global_session_time = ".$this->db->escape(trim($_POST['global_si_time']))." where id = '1'");
				$this->db->query($sql);
				
					
				
				$data2 = $this->User_model->user_activities(55, '', 1, 'users_info_config', 'Global Idle Time '.$this->db->escape(trim($_POST['global_si_time'])).' Minutes Update for all user','', $this->session->userdata['ast_user']['user_id'], $this->session->userdata['ast_user']['user_full_id']);
				
		}
		if($_POST['btn_type']=='contact')
		{			
				$sql = ("update `upr_config` set contact_person = ".$this->db->escape(trim($_POST['contact_person']))." where Id = '1'");
				$this->db->query($sql);
				
				$sql2 = ("INSERT INTO USER_ACTIVITIES_HISTORY (Activities_Id, Activities_by, Activities_dt, IP, Operate_user_Id, Description) VALUES 
						('18', '".$_SESSION['pop_user_id']."', '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', '', 'Contact Person Information Update for all user')");
				$this->db->query($sql2);	
				
		}

		

		if($_POST['btn_type']=='IP_MAP')
		{	
				for($i=1; $i<$_POST['counter']; $i++)
				{
					if(trim($_POST['IP_3octet'.$i])!='')
					{
						$sql = ("update ".BRANCH_TB_NAME." set IP_3octet = ".$this->db->escape(trim($_POST['IP_3octet'.$i]))." where  ".BRANCH_ID."=".$this->db->escape(trim($_POST['brn_id'.$i])));
						$this->db->query($sql);
					}
				}
				$sql2 = ("INSERT INTO USER_ACTIVITIES_HISTORY (TABLE_NAME,TABLE_ROW_ID,ACTIVITIES_ID, ACTIVITIES_BY, ACTIVITIES_DATETIME, IP_ADDRESS, OPERATE_USER_ID, DESCRIPTION_ACTIVITIES) VALUES
				('USERS_INFO_CONFIG','1','16', '".$_SESSION['pop_user_id']."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', '".USER_ID_NAME."', 'IP Mapping Update (Location)')");
				$this->db->query($sql2);	
				
		}
		if($_POST['btn_type']=='client')
		{
		
			if($_POST['count']>0)
			{
				$sql = ("UPDATE project_info SET project_title = '".trim($_POST['PROJECT_TITLE'])."',
												 project_client_name = '".trim($_POST['PROJECT_CLIENT_NAME'])."',
												 project_client_address = '".trim($_POST['PROJECT_CLIENT_ADDRESS'])."',	
												 project_version = '".trim($_POST['PROJECT_VERSION'])."'
				 								 WHERE id = '1'"
				 	   );
					   
				$data2 = $this->User_model->user_activities(55, '', 1, 'project_info', 'Project Info Updated','', $this->session->userdata['ast_user']['user_id'], $this->session->userdata['ast_user']['user_full_id']);
					   
					   
				//echo $this->db->query($sql);exit;
			}
			
			//$parse_result2 = oci_parse ($dbh, $sql);
			//oci_execute($parse_result2);
			//echo 'OK';
			//exit;
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */