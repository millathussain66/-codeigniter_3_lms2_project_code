<?php
class Auction_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->model('User_model', '', TRUE);
		$this->load->model('Cma_process_model', '', TRUE);
	}

	function get_grid_data($filterscount, $sortdatafield, $sortorder, $limit, $offset) {
		$i = 0;
		$where2 = "b.life_cycle IN(24,17)";
		if (isset($filterscount) && $filterscount > 0) {
			$where = "(";

			$tmpdatafield = "";
			$tmpfilteroperator = "";
			for ($i = 0; $i < $filterscount; $i++) {
//$where2.="(".$this->input->get('filterdatafield'.$i)." like '%".$this->input->get('filtervalue'.$i)."%')";

				// get the filter's value.
				$filtervalue = $this->input->get('filtervalue' . $i);
				// get the filter's condition.
				$filtercondition = $this->input->get('filtercondition' . $i);
				// get the filter's column.
				$filterdatafield = $this->input->get('filterdatafield' . $i);
				// get the filter's operator.
				$filteroperator = $this->input->get('filteroperator' . $i);

				if ($filterdatafield == 'loan_ac') {
					$filterdatafield = 'j2.loan_ac';
				} else if ($filterdatafield == 'cif') {
					$filterdatafield = 'j2.cif';
				} else if ($filterdatafield == 'ac_name') {
					$filterdatafield = 'j2.ac_name';
				} else if ($filterdatafield == 'status') {
					$filterdatafield = 'j1.name';
				} else if ($filterdatafield == 'region_name') {
					$filterdatafield = 'j7.name';
				} else if ($filterdatafield == 'territory_name') {
					$filterdatafield = 'j8.name';
				} else if ($filterdatafield == 'district_name') {
					$filterdatafield = 'j9.name';
				} else if ($filterdatafield == 'serial') {
					$filterdatafield = 'j2.sl_no';
				} else if ($filterdatafield == 'unit_office_name') {
					$filterdatafield = 'j10.name';
				} else if ($filterdatafield == 'e_by') {
					//$filterdatafield='j2.name';
				} else if ($filterdatafield == 'e_dt') {
					//$filterdatafield='b.e_dt';
					$filterdatafield = "DATE_FORMAT(j2.e_dt,'%d-%b-%y %h:%i %p')";
				} else if ($filterdatafield == 'stc_dt') {
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(j2.stc_dt,'%d-%b-%y %h:%i %p')";
				} else if ($filterdatafield == 'sth_dt') {
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(j2.sth_dt,'%d-%b-%y %h:%i %p')";
				} else if ($filterdatafield == 'v_dt') {
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(j2.v_dt,'%d-%b-%y %h:%i %p')";
				} else if ($filterdatafield == 'ln_expiry_dt') {
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.ln_expiry_dt,'%d-%b-%y')";
				} else if ($filterdatafield == 'auction_date') {
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.auction_date,'%d-%b-%y')";
				} else if ($filterdatafield == 'ln_serve_dt') {
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.ln_serve_dt,'%d-%b-%y')";
				} else if ($filterdatafield == 'rec_dt') {
					//$filterdatafield='b.rec_dt';
					$filterdatafield = "DATE_FORMAT(j2.rec_dt,'%d-%b-%y %h:%i %p')";
				} //else { $filterdatafield = 'b.' . $filterdatafield;}

				if ($tmpdatafield == "") {
					$tmpdatafield = $filterdatafield;
				} else if ($tmpdatafield != $filterdatafield) {
					$where .= ")AND(";
				} else if ($tmpdatafield == $filterdatafield) {
					if ($tmpfilteroperator == 0) {
						$where .= " AND ";
					} else {
						$where .= " OR ";
					}

				}

				// build the "WHERE" clause depending on the filter's condition, value and datafield.
				if ($filterdatafield == 'e_by') {
					$where .= " (j3.name LIKE '%" . $filtervalue . "%' OR j3.user_id LIKE '%" . $filtervalue . "%') ";
				}
				else if ($filterdatafield == 'stc_by') {
					$where .= " (j6.name LIKE '%" . $filtervalue . "%' OR j6.user_id LIKE '%" . $filtervalue . "%') ";
				}
				else if ($filterdatafield == 'sth_by') {
					$where .= " (j4.name LIKE '%" . $filtervalue . "%' OR j4.user_id LIKE '%" . $filtervalue . "%') ";
				}
				else if ($filterdatafield == 'v_by') {
					$where .= " (j5.name LIKE '%" . $filtervalue . "%' OR j5.user_id LIKE '%" . $filtervalue . "%') ";
				}
				else if ($filterdatafield == 'rec_by') {
					$where .= " (j11.name LIKE '%" . $filtervalue . "%' OR j11.user_id LIKE '%" . $filtervalue . "%') ";
				}
				 else {
					switch ($filtercondition) {
					case "CONTAINS":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "%'";
						break;
					case "DOES_NOT_CONTAIN":
						$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue . "%'";
						break;
					case "EQUAL":
						$where .= " " . $filterdatafield . " = '" . $filtervalue . "'";
						break;
					case "NOT_EQUAL":
						$where .= " " . $filterdatafield . " <> '" . $filtervalue . "'";
						break;
					case "GREATER_THAN":
						$where .= " " . $filterdatafield . " > '" . $filtervalue . "'";
						break;
					case "LESS_THAN":
						$where .= " " . $filterdatafield . " < '" . $filtervalue . "'";
						break;
					case "GREATER_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " >= '" . $filtervalue . "'";
						break;
					case "LESS_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " <= '" . $filtervalue . "'";
						break;
					case "STARTS_WITH":
						$where .= " " . $filterdatafield . " LIKE '" . $filtervalue . "%'";
						break;
					case "ENDS_WITH":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue . "'";
						break;
					}
				}

				if ($i == $filterscount - 1) {
					$where .= ")";

				}

				$tmpfilteroperator = $filteroperator;
				$tmpdatafield = $filterdatafield;

			}
			// build the query.
		} else { $where = array();}

		if ($sortorder == '') {
			// $sortdatafield="b.id";
			// $sortorder = "DESC";	
			$sortdatafield="j1.s_order";		
			$sortorder = "ASC";	
		}
		$this->db
			->select('SQL_CALC_FOUND_ROWS b.*,j2.legal_region,j2.sl_no as serial,IF(A.file_name="",0,1) as serve_ln_sts,
            IF(b.auction_sts="17" OR b.auction_sts="40",CONCAT(j1.name," (",j12.user_id,")"),j1.name) as status,
            j7.name as region_name,j8.name as territory_name,j2.req_type,
        j9.name as district_name,j10.name as unit_office_name,j2.ac_name,
        IF(b.ln_expiry_dt<="' . date("Y-m-d") . '", "1", "0") as exp_sts,
        IF(b.auction_date<="' . date("Y-m-d") . '", "1", "0") as auc_dt_sts,
        CONCAT(j3.name," (",j3.user_id,")")as e_by,
        CONCAT(j4.name," (",j4.user_id,")")as sth_by,
        CONCAT(j5.name," (",j5.user_id,")")as v_by,
        CONCAT(j6.name," (",j6.user_id,")")as stc_by,
        CONCAT(j11.name," (",j11.user_id,")")as rec_by,
        DATE_FORMAT(j2.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(b.ln_expiry_dt,"%d-%b-%y") AS ln_expiry_dt,
        DATE_FORMAT(b.auction_date,"%d-%b-%y") AS auction_date,
        DATE_FORMAT(b.ln_serve_dt,"%d-%b-%y") AS ln_serve_dt,
        DATE_FORMAT(j2.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
        DATE_FORMAT(j2.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,
        DATE_FORMAT(j2.sth_dt,"%d-%b-%y %h:%i %p") AS sth_dt,
        DATE_FORMAT(j2.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
        ', FALSE)
			->from("cma_auction b")
			->join('cma as j2', 'b.cma_id=j2.id', 'left')
			->join('users_info as j3', 'j2.e_by=j3.id', 'left')
			->join('users_info as j4', 'j2.sth_by=j4.id', 'left')
			->join('users_info as j5', 'j2.v_by=j5.id', 'left')
			->join('users_info as j6', 'j2.stc_by=j6.id', 'left')
			->join('users_info as j11', 'j2.rec_by=j11.id', 'left')
			->join('ref_status as j1', 'b.auction_sts=j1.id', 'left')
			->join('ref_region as j7', 'b.region=j7.id', 'left')
			->join('ref_territory as j8', 'b.territory=j8.id', 'left')
			->join('ref_district as j9', 'b.district=j9.id', 'left')
			->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
			->join('users_info as j12', 'b.legal_checker_id=j12.id', 'left')
			->join('(SELECT d.data_field_name, d.cma_id,d.file_name
                  FROM cma_document_file d
                  ORDER BY d.cma_id DESC LIMIT 6) A', 'j2.id=A.cma_id and A.data_field_name="c_of_served_ln"', 'left')
			->where($where)
			->where($where2)
			->order_by($sortdatafield, $sortorder)
			->limit($limit, $offset);
		$q = $this->db->get();

		$query = $this->db->query('SELECT FOUND_ROWS() AS Count');
		$objCount = $query->result_array();
		$result["TotalRows"] = $objCount[0]['Count'];

		if ($q->num_rows() > 0) {
			$result["Rows"] = $q->result();
		} else {
			$result["Rows"] = array();
		}
		return $result;

	}
	function get_info($id) // get data for edit
	{
		if ($id != '') {
			$this->db
				->select("j0.*", FALSE)
				->from('cma_auction as j0')
				->where("j0.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			return $this->db->get()->row();
		} else {return NULL;}
	}

	function get_data($table) {
		$this->db
			->select('*')
			->from($table);
		return $this->db->get()->result();
	}
	function seconddb($accno) {
		if(config_item('csms_dev_liv')=='liv')
		{
			$secound_db = $this->load->database('database_two', TRUE);
			$exist2 = $secound_db->query("SELECT m.id, m.mortgage_deed_no,m.mortgage_date, m.market_value_prprty,m.mortgage_land_value,
	            lb.title_deed_number,lb.registration_dt,lb.deed_type,lb.district,lb.thana,lb.sro_name,lb.mouza,
	            lb.land_area, lb.plot_number, lb.holding_number, lb.jote_no,
	            lb.khatian_no_cs, lb.khatian_no_sa, lb.khatian_no_rs,lb.khatian_no_bs,lb.khatian_nocity_jorip,lb.mutation_khatian_number,
	            lb.dag_no_cs, lb.dag_no_sa, lb.dag_no_rs,lb.dag_no_bs,lb.dag_nocity_jorip
	            FROM app_collateral_land_and_building_mortgage lbm
	            JOIN app_mortgage m ON (lbm.mortgage_id=m.id)
	            JOIN app_collateral_land_and_building lb ON (lbm.security_id=lb.id)
	            WHERE  m.sts=1  AND m.loan_ac_no='" . $accno . "' ORDER BY m.mortgage_deed_no ");
			$row = $exist2->result();
		}
		else
		{
			$row=array();
			$row[] = (object)array(
				"id" => "4102",
	            "loan_ac_no" => "1511602073489003",
	            "mortgage_deed_no" => "200",
	            "mortgage_date" => "2011-11-30",
	            "market_value_prprty" => "19618542",
	            "mortgage_land_value" => "4.95",
	            "title_deed_number" => "5798",
	            "registration_dt" => "2000-09-27",
	            "deed_type" => "1",
	            "district" => "14_DHAKA",
	            "thana" => "12_Mirpur",
	            "sro_name" => "136_MIRPUR",
	            "mouza" => "7575_BASUPARA",
	            "land_area" => "4.95",
	            "plot_number" => "",
	            "holding_number" => "B/48",
	            "jote_no" => "",
	            "khatian_no_cs" => "",
	            "khatian_no_sa" => "",
	            "khatian_no_rs" => "",
	            "khatian_no_bs" => "",
	            "khatian_nocity_jorip" => "155",
	            "mutation_khatian_number" => "",
	            "dag_no_cs" => "",
	            "dag_no_sa" => "",
	            "dag_no_rs" => "",
	            "dag_no_bs" => "",
	            "dag_nocity_jorip" => "16",
			);
			$row[] = (object)array(
				"id" => "4102",
	            "loan_ac_no" => "1511602073489004",
	            "mortgage_deed_no" => "100",
	            "mortgage_date" => "2011-11-30",
	            "market_value_prprty" => "19618542",
	            "mortgage_land_value" => "4.95",
	            "title_deed_number" => "5799",
	            "registration_dt" => "2000-09-27",
	            "deed_type" => "2",
	            "district" => "14_DHAKA",
	            "thana" => "12_Mirpur",
	            "sro_name" => "136_MIRPUR",
	            "mouza" => "7575_BASUPARA",
	            "land_area" => "4.95",
	            "plot_number" => "",
	            "holding_number" => "B/48",
	            "jote_no" => "",
	            "khatian_no_cs" => "",
	            "khatian_no_sa" => "",
	            "khatian_no_rs" => "",
	            "khatian_no_bs" => "",
	            "khatian_nocity_jorip" => "155",
	            "mutation_khatian_number" => "",
	            "dag_no_cs" => "",
	            "dag_no_sa" => "",
	            "dag_no_rs" => "",
	            "dag_no_bs" => "",
	            "dag_nocity_jorip" => "16",
			);
		}
		
		return $row;

	}
	function insert_get_id($table, $data) {
		$this->load->database('default', TRUE);
		$this->db->insert($table, $data);
		$tmp = $this->db->insert_id();
		return $tmp;
	}
	function get_guarantor_info($add_edit, $id) // get data for edit
	{
		if ($id != '') {
			$str = " SELECT g.* ,
            IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
            IF(g.guarantor_type='', ' ', t.name) as type_name,
            IF(g.occ_sts='', ' ', o.name) as occ_sts_name
            FROM cma_guarantor g
            LEFT OUTER JOIN ref_guar_type t on(g.guarantor_type=t.code)
            LEFT OUTER JOIN ref_guar_sts s on(g.guar_sts=s.id)
            LEFT OUTER JOIN ref_guar_occ o on(g.occ_sts=o.code)
            WHERE g.sts = '1'  AND g.cma_id= " . $this->db->escape($id) . " ORDER BY g.id ASC";
			$query = $this->db->query($str);
			return $query->result();
		} else {return NULL;}
	}
	function get_mortgage_security($id) // get data for edit
	{
		if ($id != '') {
			$str = " SELECT g.* ,d.name as district,t.name as thana,r.name as sub_reg_office,
            m.name as mouza,dt.name as deed_type,
             DATE_FORMAT(g.reg_date,'%d-%b-%y') AS reg_date
            FROM cma_facility_mortgage_security g
            LEFT OUTER JOIN csms_ref_districts d on(g.district=d.id)
            LEFT OUTER JOIN csms_ref_thana t on(g.thana=t.id)
            LEFT OUTER JOIN csms_ref_sro_office_name r on(g.sub_reg_office=r.id)
            LEFT OUTER JOIN csms_ref_mouza m on(g.mouza=m.id)
            LEFT OUTER JOIN csms_ref_type_of_deed dt on(g.deed_type=dt.id)
            WHERE g.sts = '1'  AND g.cma_id= " . $this->db->escape($id) . " ORDER BY g.id ASC";
			$query = $this->db->query($str);
			return $query->result();
		} else {return NULL;}
	}
	function get_mortgage_info_by_cma($cma_id) {
		if ($cma_id != '') {
			$str = " SELECT g.* ,
            date_format(g.mortgage_date,'%d-%b-%y') as mortgage_date
            FROM cma_facility_mortgage g
            WHERE g.sts = '1'  AND g.cma_id= " . $this->db->escape($cma_id) . " ORDER BY g.id ASC";
			$query = $this->db->query($str);
			return $query->result();
		} else {return NULL;}
	}
	function get_where($table, $where, $col = NULL, $order = "ASC") {
		$this->db->select('*');
		$this->db->from($table);
		if ($where != '') {
			$this->db->where($where);
		}
		if ($col != '' && $order = '') {
			$this->db->order_by($col, $order);
		}
		$res = $this->db->get();
		$result = $res->result();
		return $result;
	}
	function mortgage_add_edit($add_edit = NULL, $edit_id = NULL, $editrow = NULL) {
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		if ($editrow == "") {$editrow = 0;}

		$mort_data = array(
			'cma_id' => $this->security->xss_clean($this->input->post('cma_id')),
			'mort_schedule_name' => $this->security->xss_clean($this->input->post('mortgageshedulename')),
			'mort_schedule_desc' => $this->security->xss_clean($this->input->post('mortgageschedule')),
			'deed_number' => $this->security->xss_clean($this->input->post('deednumber')),
			'mortgage_date' => implode('-', array_reverse(explode('/', $this->input->post('mortgagedate')))),
			'valuator_name' => $this->security->xss_clean($this->input->post('valuatorname')),
			'valuator_date' => implode('-', array_reverse(explode('/', $this->input->post('valuatordate')))),
			'valuator_mv' => $this->security->xss_clean($this->input->post('valuatormv')),
			'valuator_fsv' => $this->security->xss_clean($this->input->post('valuatorfsv')),
			're_valuator_name' => $this->security->xss_clean($this->input->post('revaluatorname')),
			're_valuator_date' => implode('-', array_reverse(explode('/', $this->input->post('revaluatordate')))),
			're_valuator_mv' => $this->security->xss_clean($this->input->post('revaluemv')),
			're_valuator_fsv' => $this->security->xss_clean($this->input->post('revaluefsv')),
			'gov_mouza_rate' => $this->security->xss_clean($this->input->post('mouzarate')),
			'land_area' => $this->security->xss_clean($this->input->post('landarea')),
			'bounded_by' => $this->security->xss_clean($this->input->post('boundedby')),

		);
		//'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
		if ($add_edit == "add") {
			$mort_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$mort_data['e_dt'] = date('Y-m-d H:i:s');
			$mort_data['csms_new'] = 0;
			$this->db->insert('cma_facility_mortgage', $mort_data);
			$insert_idss = $this->db->insert_id();
			if ($this->db->affected_rows() == 0) {
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '00';
			}
			$data2 = $this->user_model->user_activities(39, 'auction', $insert_idss, 'cma_facility_mortgage', 'Add Facility Mortgage For CMA(' . $insert_idss . ')');
		} else {
			$mort_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$mort_data['u_dt'] = date('Y-m-d H:i:s');

			$this->db->where('id', $edit_id);
			$this->db->update('cma_facility_mortgage', $mort_data);
			$insert_idss = $edit_id;
			if ($this->db->affected_rows() == 0) {
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '00';
			}
			$data2 = $this->user_model->user_activities(35, 'auction', $this->input->post('cma_id'), 'cma_facility_mortgage', 'Update Facility Mortgage For CMA(' . $insert_idss . ')');
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return '00';
		} else {
			$this->db->trans_commit();
			return $insert_idss;
		}
	}
	function get_add_action_data($id) {
		$this->db
			->select("b.*", FALSE)
			->from("cma_facility_mortgage b")
			->where("b.sts='1' and b.id='" . $id . "'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function get_paper_info($id) // get data for edit
	{
		if ($id != '') {
			$this->db
				->select("j0.auction_address,j0.paper_remarks,j2.name as paper_name,j3.name as paper_vendor,
                CONCAT(j4.name,' (',j4.user_id,')') as e_by,
                DATE_FORMAT(j0.paper_date,'%d-%b-%y %h:%i %p') AS paper_date,
                DATE_FORMAT(j0.paper_e_dt,'%d-%b-%y %h:%i %p') AS paper_e_dt,
                DATE_FORMAT(j0.auction_time,'%h:%i %p') AS auction_time,
                DATE_FORMAT(j0.auction_date,'%d-%b-%y %h:%i %p') AS auction_date", FALSE)
				->from('cma_auction as j0')
				->join("ref_paper as j2", "j0.paper_name=j2.id", "left")
				->join("ref_paper_vendor as j3", "j0.paper_vendor=j3.id", "left")
				->join("users_info as j4", "j0.paper_e_by=j4.id", "left")
				->where("j0.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			return $this->db->get()->row();
		} else {return NULL;}
	}
	function get_mortgage_info($id) // get data for edit
	{
		if ($id != '') {
			$this->db
				->select("j0.mort_schedule_name,j0.mort_schedule_desc,j0.deed_number,j0.valuator_name,
                j0.valuator_mv,j0.valuator_fsv,j0.re_valuator_name,j0.re_valuator_mv,j0.re_valuator_fsv,
                j0.gov_mouza_rate,j0.land_area,j0.bounded_by,
                DATE_FORMAT(j0.mortgage_date,'%d-%b-%y') AS mortgage_date,
                DATE_FORMAT(j0.valuator_date,'%d-%b-%y') AS valuator_date,
                DATE_FORMAT(j0.re_valuator_date,'%d-%b-%y') AS re_valuator_date", FALSE)
				->from('cma_facility_mortgage as j0')
				->where("j0.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			return $this->db->get()->row();
		} else {return NULL;}
	}
	function get_bidder_details($id) // get data for edit
	{
		if ($id != '') {
			$str = " SELECT b.* ,r.name as bidder_rank_name,
             DATE_FORMAT(b.pay_order_date,'%d-%b-%y') AS pay_order_dt
            FROM cma_auction_bidder b
            LEFT OUTER JOIN ref_bidder_rank r on(b.bidder_rank=r.id)
            WHERE b.sts = '1'  AND b.cma_id= " . $this->db->escape($id) . " ORDER BY b.id ASC";
			$query = $this->db->query($str);
			return $query->result();
		} else {return NULL;}
	}
	function get_security_info($id) // get data for edit
	{
		if ($id != '') {
			$this->db
				->select("j0.*,
                DATE_FORMAT(j0.reg_date,'%d-%b-%y') AS reg_date", FALSE)
				->from('cma_facility_mortgage_security as j0')
				->where("j0.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			return $this->db->get()->row();
		} else {return NULL;}
	}
	function get_add_action_data_auction($id) {
		$this->db
			->select("b.*", FALSE)
			->from("cma_auction b")
			->where("b.id='" . $id . "'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function security_add_edit($add_edit = NULL, $edit_id = NULL, $editrow = NULL) {
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		if ($editrow == "") {$editrow = 0;}

		$mort_data = array(
			'cma_id' => $this->security->xss_clean($this->input->post('cma_id')),
			'mortgage_id' => $this->security->xss_clean($this->input->post('mortgage_id')),
			'title_deed_number' => $this->security->xss_clean($this->input->post('deednumber')),
			'reg_date' => implode('-', array_reverse(explode('/', $this->input->post('regdate')))),
			'deed_type' => $this->security->xss_clean($this->input->post('typeofdeed')),
			'district' => $this->security->xss_clean($this->input->post('district')),
			'thana' => $this->security->xss_clean($this->input->post('thana')),
			'sub_reg_office' => $this->security->xss_clean($this->input->post('unitoffice')),
			'mouza' => $this->security->xss_clean($this->input->post('mouza')),
			'land_area' => $this->security->xss_clean($this->input->post('landarea')),
			'plot_number' => $this->security->xss_clean($this->input->post('plotnumber')),
			'holding_number' => $this->security->xss_clean($this->input->post('holdingnum')),
			'jote_no' => $this->security->xss_clean($this->input->post('joteno')),
			'cs_khatian_no' => $this->security->xss_clean($this->input->post('cskhatianno')),
			'sa_khatian_no' => $this->security->xss_clean($this->input->post('sakhatianno')),
			'rs_khatian_no' => $this->security->xss_clean($this->input->post('rskhatianno')),
			'bs_dp_khatian_no' => $this->security->xss_clean($this->input->post('bskhatianno')),
			'city_jorip_khatian_no' => $this->security->xss_clean($this->input->post('cityjoripkhatianno')),
			'mutation_khatian_no' => $this->security->xss_clean($this->input->post('mutationkhatianno')),
			'cs_dag_no' => $this->security->xss_clean($this->input->post('csdagno')),
			'sa_dag_no' => $this->security->xss_clean($this->input->post('sadagno')),
			'rs_dag_no' => $this->security->xss_clean($this->input->post('rsdagno')),
			'bs_dp_dag_no' => $this->security->xss_clean($this->input->post('bsdagno')),
			'city_jorip_dag_no' => $this->security->xss_clean($this->input->post('cityjoripdagno')),
		);
		//'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
		if ($add_edit == "add") {
			$mort_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$mort_data['e_dt'] = date('Y-m-d H:i:s');
			$mort_data['csms_new'] = 0;
			$this->db->insert('cma_facility_mortgage_security', $mort_data);
			$insert_idss = $this->db->insert_id();
			if ($this->db->affected_rows() == 0) {
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '00';
			}
			$data2 = $this->user_model->user_activities(39, 'auction', $this->input->post('cma_id'), 'cma_facility_mortgage_security', 'Add Facility Mortgage Security For CMA(' . $insert_idss . ')');
		} else {
			$mort_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$mort_data['u_dt'] = date('Y-m-d H:i:s');

			$this->db->where('id', $edit_id);
			$this->db->update('cma_facility_mortgage_security', $mort_data);
			$insert_idss = $edit_id;
			if ($this->db->affected_rows() == 0) {
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '00';
			}
			$data2 = $this->user_model->user_activities(35, 'auction', $insert_idss, 'cma_facility_mortgage_security', 'Update Facility Mortgage Security For CMA(' . $insert_idss . ')');
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return '00';
		} else {
			$this->db->trans_commit();
			return $insert_idss;
		}
	}
	function get_add_action_security_data($id) {
		$this->db
			->select("b.*", FALSE)
			->from("cma_facility_mortgage_security b")
			->where("b.sts='1' and b.id='" . $id . "'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function add_memo($edit_id = NULL, $editrow = NULL) {
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		if ($editrow == "") {$editrow = 0;}
		//For Memo Add Action
		if ($_POST['add_edit'] == 0) {
			for ($i = 1; $i <= $_POST['bidder_info_counter']; $i++) {
				$bidder = array(
					'cma_id' => $this->security->xss_clean($this->input->post('cma_id')),
					'bidder_name' => $this->security->xss_clean($this->input->post('bidder_name_' . $i)),
					'bidder_details' => $this->security->xss_clean($this->input->post('bidder_details_' . $i)),
					'bidder_rank' => $this->security->xss_clean($this->input->post('bidder_rank_' . $i)),
					'pay_order_no' => $this->security->xss_clean($this->input->post('pay_order_no_' . $i)),
					'pay_order_date' => implode('-', array_reverse(explode('/', $this->input->post('pay_order_date_' . $i)))),
					'pay_order_amount' => $this->security->xss_clean($this->input->post('pay_order_amount_' . $i)),
					'bid_amount' => $this->security->xss_clean($this->input->post('bid_amount_' . $i)),
					'auction_schedule' => $this->security->xss_clean($this->input->post('auction_schedule_' . $i)),
					'r_s_plot_no' => $this->security->xss_clean($this->input->post('r_s_plot_no_' . $i)),
					'remarks' => $this->security->xss_clean($this->input->post('remarks_' . $i)),
					'e_by' => $this->session->userdata['ast_user']['user_id'],
					'e_dt' => date('Y-m-d H:i:s'),
				);
				if ($_POST['bidder_info_delete_' . $i] != 1) {
					$this->db->insert('cma_auction_bidder', $bidder);
				}
				$insert_idss = $this->db->insert_id();
				if ($insert_idss == 0) {
					$this->db->trans_rollback();
					$this->db->db_debug = $db_debug;
					return '00';
				}
			}
			$data = array('auction_sts' => 18);
			$this->db->where('id', $_POST['id']);
			$this->db->update('cma_auction', $data);
			$data2 = $this->user_model->user_activities(18, 'auction', $insert_idss, 'cma_auction_bidder', 'Bidder Inforamtion Add(' . $insert_idss . ')');
		}
		//For Edit Memo Action
		else {
			for ($i = 1; $i <= $_POST['bidder_info_counter']; $i++) {
				$bidder = array(
					'cma_id' => $this->security->xss_clean($this->input->post('cma_id')),
					'bidder_name' => $this->security->xss_clean($this->input->post('bidder_name_' . $i)),
					'bidder_details' => $this->security->xss_clean($this->input->post('bidder_details_' . $i)),
					'bidder_rank' => $this->security->xss_clean($this->input->post('bidder_rank_' . $i)),
					'pay_order_no' => $this->security->xss_clean($this->input->post('pay_order_no_' . $i)),
					'pay_order_date' => implode('-', array_reverse(explode('/', $this->input->post('pay_order_date_' . $i)))),
					'pay_order_amount' => $this->security->xss_clean($this->input->post('pay_order_amount_' . $i)),
					'bid_amount' => $this->security->xss_clean($this->input->post('bid_amount_' . $i)),
					'auction_schedule' => $this->security->xss_clean($this->input->post('auction_schedule_' . $i)),
					'r_s_plot_no' => $this->security->xss_clean($this->input->post('r_s_plot_no_' . $i)),
					'remarks' => $this->security->xss_clean($this->input->post('remarks_' . $i)),
				);
				// For skip The new deleted row
				if ($_POST['bidder_info_edit_' . $i] == 0 && $_POST['bidder_info_delete_' . $i] == 1) {
					continue;
				}
				//For Delete the old row
				if ($_POST['bidder_info_edit_' . $i] != 0 && $_POST['bidder_info_delete_' . $i] == 1) {
					$data = array('sts' => 0);
					$this->db->where('id', $_POST['bidder_info_edit_' . $i]);
					$this->db->update('cma_auction_bidder', $data);
				}
				//For update the old row
				else if ($_POST['bidder_info_edit_' . $i] != 0 && $_POST['bidder_info_delete_' . $i] != 1) {
					$this->db->where('id', $_POST['bidder_info_edit_' . $i]);
					$this->db->update('cma_auction_bidder', $bidder);
				}
				//For insert the new row
				else if ($_POST['bidder_info_edit_' . $i] == 0 && $_POST['bidder_info_delete_' . $i] == 0) {
					$this->db->insert('cma_auction_bidder', $bidder);
				}

			}
			$data = array('auction_sts' => 18);
			$this->db->where('id', $_POST['id']);
			$this->db->update('cma_auction', $data);
			$data2 = $this->user_model->user_activities(18, 'auction', $_POST['id'], 'cma_auction_bidder', 'Bidder Inforamtion Update(' . $_POST['id'] . ')');
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return '00';
		} else {
			$this->db->trans_commit();
			return $_POST['id'];
		}
	}
	function get_file_name($field_name,$path)
    {
        //Deleteng old file when no new file selected
        if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            unlink($delete_path);   
            $file ="";
        }//Deleteng old file and new file selected
        else if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='1') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            unlink($delete_path);   
            $file = $this->Common_model->get_file_name('cma',$field_name,$path);
        }//Taking Old File
        else if (isset($_POST['hidden_'.$field_name.'_value']) && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $file = $_POST['hidden_'.$field_name.'_value'];
        }//Taking Full New File
        else
        {
            $file = $this->Common_model->get_file_name('cma',$field_name,$path);
        }
        return $file;
    }
    function get_vendor_info($id){
    	$where= 'j0.id='.$id;
    	$this->db
			->select("j0.id,j0.paper_vendor,j0.paper_name,date_format(j0.paper_date,'%d-%m-%Y') as paper_date,date_format(j0.auction_date,'%d-%m-%Y') as auction_date,j0.auction_time,j0.auction_address,j0.paper_remarks,pv.name as vendor_name,p.name as p_name,pv.email as email", FALSE)
			->from('cma_auction as j0')
			->join('ref_paper_vendor as pv', 'pv.id=j0.paper_vendor', 'left')
			->join('ref_paper as p', 'p.id=j0.paper_name', 'left')
			->where($where, NULL, FALSE);
		$query = $this->db->get()->row();
		return $query;
    }
    function vendor_notify_send(){
    	$subject = '';
    	$message='';
    	$fromemail='';
    	$response = $this->user_model->send_email($fromemail,$this->input->post('vendor_name'),$this->input->post('email'),'',$subject,$message);
    	
    	$data = array(
			'table_name' => 'cma_auction',
			'table_id' => $this->security->xss_clean($this->input->post('auction_id')),
			'vendor_id' => $this->security->xss_clean($this->input->post('vendor_id')),
			'paper_id' => $this->security->xss_clean($this->input->post('paper_id')),
			'email' => $this->security->xss_clean($this->input->post('email')),
			'status' =>$response,
			'e_by' => $this->session->userdata['ast_user']['user_id'],
			'e_dt' => date('Y-m-d H:i:s'),
		);

    	$this->db->insert('vendor_mail_history', $data);
    	return $response;
    }
	function delete_action() {
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		if ($this->input->post('type') == 'acknowledgement') {
			$pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '33,16', 'auction_sts');
			if (count($pre_action_result) > 0) {
				return 'taken';
			} else {
				$data = array('auction_sts' => '16', 'ack_by' => $this->session->userdata['ast_user']['user_id'], 'ack_dt' => date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma_auction', $data);

				$data2 = $this->user_model->user_activities(16, 'auction', $_POST['cma_id'], 'cma_auction', 'Acknowledgement CMA Auction(' . $this->input->post('deleteEventId') . ')');
				//Getting The Facility
				$result = $this->seconddb($_POST['loan_ac']);
				//echo "<pre>";print_r($result);exit;
				$cma_id = $_POST['cma_id'];
				$e_by = $this->session->userdata['ast_user']['user_id'];
				$e_dt = date('Y-m-d H:i:s');
				$arr = array();
				$tmp = 0;
				foreach ($result as $val) {
					if (in_array($val->mortgage_deed_no, $arr) != true) {
						array_push($arr, $val->mortgage_deed_no);
						$mort_data = array(
							'cma_id' => $cma_id,
							'deed_number' => $val->mortgage_deed_no,
							'mortgage_date' => $val->mortgage_date,
							'valuator_mv' => $val->market_value_prprty,
							'land_area' => $val->mortgage_land_value,
							'csms_new' => 1,
							'e_by' => $e_by,
							'e_dt' => $e_dt,
						);
						//insert cma facility mortgage
						$this->db->insert('cma_facility_mortgage', $mort_data);
						$tmp = $this->db->insert_id();
						if ($this->db->affected_rows() == 0) {
							$this->db->trans_rollback();
							$this->db->db_debug = $db_debug;
							return '00';
						}
					}
					$dist = explode("_", $val->district);
					$thana = explode("_", $val->thana);
					$sro_name = explode("_", $val->sro_name);
					$mouza = explode("_", $val->mouza);
					$sequ = array(
						'cma_id' => $cma_id,
						'mortgage_id' => $tmp,
						'title_deed_number' => $val->title_deed_number,
						'reg_date' => $val->registration_dt,
						'deed_type' => $val->deed_type,
						'district' => $dist[0],
						'thana' => $thana[0],
						'sub_reg_office' => $sro_name[0],
						'mouza' => $mouza[0],
						'land_area' => $val->land_area,
						'plot_number' => $val->plot_number,
						'holding_number' => $val->holding_number,
						'jote_no' => $val->jote_no,
						'cs_khatian_no' => $val->khatian_no_cs,
						'rs_khatian_no' => $val->khatian_no_rs,
						'bs_dp_khatian_no' => $val->khatian_no_bs,
						'city_jorip_khatian_no' => $val->khatian_nocity_jorip,
						'mutation_khatian_no' => $val->mutation_khatian_number,
						'cs_dag_no' => $val->dag_no_cs,
						'sa_dag_no' => $val->dag_no_sa,
						'rs_dag_no' => $val->dag_no_rs,
						'bs_dp_dag_no' => $val->dag_no_bs,
						'city_jorip_dag_no' => $val->dag_nocity_jorip,
						'csms_new' => 1,
						'e_by' => $e_by,
						'e_dt' => $e_dt,
					);
					//Insert Cma Facility Mortgage Security
					$this->db->insert('cma_facility_mortgage_security', $sequ);
					if ($this->db->affected_rows() == 0) {
						$this->db->trans_rollback();
						$this->db->db_debug = $db_debug;
						return '00';
					}

				}
			}
		}
		if ($this->input->post('type') == 'sendtochecker') {
			$pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '58', 'auction_sts');
			if (count($pre_action_result) > 0) {
				return 'taken';
			} else {
				$data = array('auction_sts' => 58, 'stc_by' => $this->session->userdata['ast_user']['user_id'], 'stc_dt' => date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma_auction', $data);
				$data2 = $this->user_model->user_activities(58, 'auction', $_POST['cma_id'], 'cma_auction', 'Send To checker Auction(' . $this->input->post('deleteEventId') . ')');
			}
		}
		if ($this->input->post('type') == 'return_auction') {
			$pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '41,44', 'auction_sts');
			if (count($pre_action_result) > 0) {
				return 'taken';
			} else {
				$data = array('auction_sts' => 44, 'auction_r_reason' => trim($_POST['reason']), 'auction_r_by' => $this->session->userdata['ast_user']['user_id'], 'auction_r_dt' => date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma_auction', $data);
				$data2 = $this->user_model->user_activities(44, 'auction', $_POST['cma_id'], 'cma_auction', 'Return Auction(' . $this->input->post('deleteEventId') . ')', $_POST['reason']);
				if ($this->db->affected_rows() > 0) {
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'decline') {
						$str = "SELECT  j0.id,s.name as auction_sts,j0.stc_by
                                     FROM cma_auction j0
                                     LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                                 WHERE j0.id= '" . $this->input->post('deleteEventId') . "' LIMIT 1";

						$application_data = $this->db->query($str)->row();

						$checker_id = $application_data->stc_by;

						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '" . $checker_id . "' LIMIT 1";
						$checker_info = $this->db->query($str1)->row();

						if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
							$subject = "Request for Approval";
							$req_type = $application_data->auction_sts;
							$subject .= " [" . $req_type . "] (" . date('l, M d, Y h:i:s A') . ')';
							$message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                            A request is waiting for your approval.<br/><br/>
                            Request Type: " . $req_type . "<br/>
                            Request by: " . $this->session->userdata['ast_user']['user_name'] . " (" . $this->session->userdata['ast_user']['user_full_id'] . "), <br/>
                            Request Date & Time: " . date('l, M d, Y h:i:s A') . " <br/><br/>
                            Please login to  <a href=" . base_url() . ">LMS Application</a>  to approve the request.<br/><br/>
                            This is a system generated email, no need to reply.<br/><br/>
                            Thanks</div>";
							$m = $this->User_model->send_email("", "", $checker_info->email_address, "", $subject, $message);

						}
					}
				}
			}
		}
		if ($this->input->post('type') == 'approve_auction') {
			//Verify Auction
			$pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '41,44', 'auction_sts');
			if (count($pre_action_result) > 0) {
				return 'taken';
			} else {
				$data = array('auction_sts' => 41, 'auction_v_by' => $this->session->userdata['ast_user']['user_id'], 'auction_v_dt' => date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma_auction', $data);
				$data2 = $this->user_model->user_activities(41, 'auction', $_POST['cma_id'], 'cma_auction', 'Approve Auction(' . $this->input->post('deleteEventId') . ')');
			}
		}
		if ($this->input->post('type') == 'mortgage_delete') {
			$data = array('d_reason' => trim($_POST['comments']), 'sts' => 0, 'd_by' => $this->session->userdata['ast_user']['user_id'], 'd_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_facility_mortgage', $data);
			//Delete security under this mortgage
			$data = array('d_reason' => trim($_POST['comments']), 'sts' => 0, 'd_by' => $this->session->userdata['ast_user']['user_id'], 'd_dt' => date('Y-m-d H:i:s'));
			$this->db->where('mortgage_id', $_POST['deleteEventId']);
			$this->db->update('cma_facility_mortgage_security', $data);
			$data2 = $this->user_model->user_activities(35, 'auction', $_POST['cma_id'], 'cma_facility_mortgage', 'Delete Mortgage(' . $this->input->post('deleteEventId') . ')', $_POST['comments']);

		}
		if ($this->input->post('type') == 'security_delete') {
			//Delete security under this mortgage
			$data = array('d_reason' => trim($_POST['comments']), 'sts' => 0, 'd_by' => $this->session->userdata['ast_user']['user_id'], 'd_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_facility_mortgage_security', $data);
			$data2 = $this->user_model->user_activities(35, 'auction', $_POST['cma_id'], 'cma_facility_mortgage_security', 'Delete Mortgage Security(' . $this->input->post('deleteEventId') . ')', $_POST['comments']);
		}
		if ($this->input->post('type') == 'send_to_legal') {
			//Verify Auction
			// $pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '17', 'auction_sts');
			// if (count($pre_action_result) > 0) {
			// 	return 'taken';
			// } else {
				
			// }

			for ($i = 1; $i <= $this->input->post('doc_info_counter'); $i++) {
				if ($_POST['doc_info_delete_' . $i] != 1) {
					$doc_info['legal_sent_sts'] = 1;
					$this->db->where('id', $_POST['doc_id_' . $i]);
					$this->db->update('cma_document_file', $doc_info);
				} else {
					$doc_info['legal_sent_sts'] = 0;
					$this->db->where('id', $_POST['doc_id_' . $i]);
					$this->db->update('cma_document_file', $doc_info);
				}
			}
			for ($i = 1; $i <= $this->input->post('facility_info_counter'); $i++) {
				$facility_info['belance'] = $this->input->post('belance_'.$i);
				$facility_info['belance_dt'] = implode('-',array_reverse(explode('/',$this->input->post('belance_dt_'.$i))));
				$this->db->where('id', $_POST['facility_id_' . $i]);
				$this->db->update('cma_facility', $facility_info);
			}
			$data = array('auction_sts' => 17, 'life_cycle' => 17, 'legal_checker_id' => $this->input->post('checker'), 'auc_st_l_by' => $this->session->userdata['ast_user']['user_id'], 'auc_st_l_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);
			$data2 = $this->user_model->user_activities(17, 'auction', $_POST['cma_id'], 'cma_auction', 'Auction Send To Legal(' . $this->input->post('deleteEventId') . ')');
		}
		if ($this->input->post('type') == 'update_paper_info') {
			//Verify Auction
			$pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '43', 'auction_sts');
			if (count($pre_action_result) > 0) {
				return 'taken';
			} else {
				$data = array(
					'auction_sts' => 43,
					'paper_name' => $this->security->xss_clean($this->input->post('paper')),
					'paper_vendor' => $this->security->xss_clean($this->input->post('paper_vendor')),
					'paper_date' => implode('-', array_reverse(explode('/', $this->input->post('paper_date')))),
					'auction_date' => implode('-', array_reverse(explode('/', $this->input->post('auction_date')))),
					'auction_time' => $this->security->xss_clean($this->input->post('auction_times')),
					'auction_address' => $this->security->xss_clean($this->input->post('auction_address')),
					'paper_remarks' => $this->security->xss_clean($this->input->post('remarks')),
					'paper_e_by' => $this->session->userdata['ast_user']['user_id'],
					'paper_e_dt' => date('Y-m-d H:i:s'),
				);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma_auction', $data);
				$data2 = $this->user_model->user_activities(43, 'auction', $_POST['cma_id'], 'cma_auction', 'Update Paper Info(' . $this->input->post('deleteEventId') . ')');
				
				$application_data = $this->db->query("SELECT c.loan_ac,c.ac_name,a.ack_by
					FROM cma_auction a
					LEFT OUTER JOIN cma c on(a.cma_id=c.id)
					where a.id='".$_POST['deleteEventId']."'")->row();
                $subject = "You have an auction will be held on tomorrow on  A/C Name: ".$application_data->ac_name;
                $url = base_url()."cma_process/details";
                $date2 = new DateTime(implode('-', array_reverse(explode('/', $this->input->post('auction_date'))))); // Y-m-d
                $start_date = $date2->modify("-1 days")->format('Y-m-d');
                $data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['cma_id'],$start_date,'',$application_data->ack_by,'1');
			}
		}
		if ($this->input->post('type') == 'update_bidder_info') {
			$pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '18', 'auction_sts');
			if (count($pre_action_result) > 0) {
				return 'taken';
			} else {
				for ($i = 1; $i <= $_POST['bidder_info_counter']; $i++) {
					$deadline = 0;
					if($this->security->xss_clean($this->input->post('bid_amount_' . $i))<1000000)
					{
						$deadline = 30;
					}
					else if($this->security->xss_clean($this->input->post('bid_amount_' . $i))>=1000000 && $this->security->xss_clean($this->input->post('bid_amount_' . $i))<5000000)
					{
						$deadline = 60;
					}
					else if($this->security->xss_clean($this->input->post('bid_amount_' . $i))>=5000000)
					{
						$deadline = 90;
					}
					$year = date('Y');
			        $year1= $year+1;
			        $str = "SELECT  DATE_FORMAT(j0.holiy_dt,'%m-%d') as holi_date
			                         FROM holidays j0
			                     WHERE (j0.Years='".$year."' OR j0.Years='".$year1."') GROUP BY DATE_FORMAT(j0.holiy_dt,'%m-%d')";

			        $application_data = $this->db->query($str)->result();
			        $rows = [];
			        if(!empty($application_data))
			        {
			            foreach($application_data as $key)
			            {
			                $rows[] = $key->holi_date;
			            }
			        }
			        
			        $weekend = array('Fri','Sat');
			        $cur_date = date('Y-m-d');
			        $date = new DateTime($cur_date);
			        $nextDay = clone $date;
			        $j = 0; // We have 0 future dates to start with
			        $deadline_date = "";
			        $notification_date = "";
			        while ($j < $deadline)
			        {
			            $nextDay->add(new DateInterval('P1D')); // Add 1 day
			            if (in_array($nextDay->format('m-d'), $rows)) continue; 
			            if (in_array($nextDay->format('D'), $weekend)) continue;
			            $deadline_date = $nextDay->format('Y-m-d');
			            $j++;
			        }
			        if($deadline_date!="")
			        {
			        	$date=date_create($deadline_date);
				        date_sub($date,date_interval_create_from_date_string("7 days"));
				        $notification_date = date_format($date,"Y-m-d");
			        }
					$bidder = array(
						'cma_id' => $this->security->xss_clean($this->input->post('cma_id')),
						'bidder_name' => $this->security->xss_clean($this->input->post('bidder_name_' . $i)),
						'bidder_mobile' => $this->security->xss_clean($this->input->post('bidder_mobile_' . $i)),
						'bidder_details' => $this->security->xss_clean($this->input->post('bidder_details_' . $i)),
						'bidder_rank' => $this->security->xss_clean($this->input->post('bidder_rank_' . $i)),
						'pay_order_no' => $this->security->xss_clean($this->input->post('pay_order_no_' . $i)),
						'pay_order_date' => implode('-', array_reverse(explode('/', $this->input->post('pay_order_date_' . $i)))),
						'pay_order_amount' => $this->security->xss_clean($this->input->post('pay_order_amount_' . $i)),
						'bid_amount' => $this->security->xss_clean($this->input->post('bid_amount_' . $i)),
						'auction_schedule' => $this->security->xss_clean($this->input->post('auction_schedule_' . $i)),
						'r_s_plot_no' => $this->security->xss_clean($this->input->post('r_s_plot_no_' . $i)),
						'remarks' => $this->security->xss_clean($this->input->post('remarks_' . $i)),
						'e_by' => $this->session->userdata['ast_user']['user_id'],
						'deadline_date' => $deadline_date,
						'notification_date' => $notification_date,
						'e_dt' => date('Y-m-d H:i:s'),
					);
					if ($_POST['bidder_info_delete_' . $i] != 1) {
						$this->db->insert('cma_auction_bidder', $bidder);
					}
					$insert_idss = $this->db->insert_id();
					if ($insert_idss == 0) {
						$this->db->trans_rollback();
						$this->db->db_debug = $db_debug;
						return '00';
					}
				}
				$data = array(
					'auction_sts' => 18,
				);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma_auction', $data);
				$data2 = $this->user_model->user_activities(18, 'auction', $_POST['cma_id'], 'cma_auction', 'Update Bidder Info(' . $this->input->post('deleteEventId') . ')');
			}
		}
		if(isset($_POST['type']) && $this->input->post('type')=='closeaccount'){
            $pre_action_result=$this->Common_model->get_pre_action_data('cma_auction',$_POST['deleteEventId'],'76','auction_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $close_account_file = $this->get_file_name('close_account_file','cma_file/close_account_file/');
                $data = array('auction_sts' => 76);
                $data2 = array('cma_sts' => 76,'close_account_file' => $close_account_file,'file_close_remarks' => $_POST['close_account_remarks'],'file_close_by'=> $this->session->userdata['ast_user']['user_id'], 'file_close_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['cma_id']);
                $this->db->update('cma', $data2);
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma_auction', $data);
                $data3 = $this->user_model->user_activities(76,'auction',$this->input->post('deleteEventId'),'cma_auction','Account Closed by Auction('.$this->input->post('deleteEventId').')',$_POST['close_account_remarks']);
            }
            $id = $_POST['deleteEventId'];
            
        }
		if ($this->input->post('type') == 'auctionsts') {
			$pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '83', 'auction_sts');
			if (count($pre_action_result) > 0) {
				return 'taken';
			} else {
				for ($i = 1; $i <= $this->input->post('bidder_info_counter'); $i++) {
					if ($_POST['bidder_info_delete_' . $i] != 1) {
						$bidder_info['selected'] = 1;
						$this->db->where('id', $_POST['bidder_id_' . $i]);
						$this->db->update('cma_auction_bidder', $bidder_info);
					} else {
						$bidder_info['selected'] = 0;
						$this->db->where('id', $_POST['bidder_id_' . $i]);
						$this->db->update('cma_auction_bidder', $bidder_info);
					}
				}
				$data = array('auction_sts' => 83,'final_sts' => $_POST['auction_status'], 'auction_remarks' => trim($_POST['comments']), 'auc_sts_update_by' => $this->session->userdata['ast_user']['user_id'], 'auc_sts_update_dt' => date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma_auction', $data);
				// $data = array('cma_sts' => 33, 'life_cycle' => 2, 'auction_sts' => '1', 'auction_sts_by' => $this->session->userdata['ast_user']['user_id'], 'auction_sts_dt' => date('Y-m-d H:i:s'));
				// $this->db->where('id', $_POST['cma_id']);
				// $this->db->update('cma', $data);
				// $data2 = $this->user_model->user_activities(33, 'auction', $_POST['cma_id'], 'cma_auction', 'Completed CMA Auction(' . $this->input->post('deleteEventId') . ')');

			}
		}
		if ($this->input->post('type') == 'auctionconfirm') {
			$pre_action_result = $this->Common_model->get_pre_action_data('cma_auction', $_POST['deleteEventId'], '33', 'auction_sts');
			if (count($pre_action_result) > 0) {
				return 'taken';
			} else {
				 $auction_sign_memo = $this->get_file_name('auction_sign_memo','cma_file/auction_sign_memo/');
				$data = array('auction_sts' => 33,'auction_sign_memo' => $auction_sign_memo,'complete_remarks' => $_POST['complete_remarks'], 'auction_complete_by' => $this->session->userdata['ast_user']['user_id'], 'auction_complete_dt' => date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma_auction', $data);
				$str = "SELECT  j0.id,j0.final_sts
                                 FROM cma_auction j0
                             WHERE j0.id= '" . $this->input->post('deleteEventId') . "' LIMIT 1";

					$application_data = $this->db->query($str)->row();
				$data = array('cma_sts' => 33, 'life_cycle' => 2, 'auction_sts' => $application_data->final_sts, 'auction_sts_by' => $this->session->userdata['ast_user']['user_id'], 'auction_sts_dt' => date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['cma_id']);
				$this->db->update('cma', $data);
				$data2 = $this->user_model->user_activities(33, 'auction', $_POST['cma_id'], 'cma_auction', 'Completed CMA Auction(' . $this->input->post('deleteEventId') . ')');

			}
		}
		if ($this->input->post('type') == 'verify_memo') {
			//Verify Paper notice
			$data = array('auction_sts' => 22, 'memo_v_by' => $this->session->userdata['ast_user']['user_id'], 'memo_v_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);
			$data2 = $this->user_model->user_activities(17, 'auction', $_POST['cma_id'], 'cma_auction', 'Approve memo (' . $this->input->post('deleteEventId') . ')');
		}
		if ($this->input->post('type') == 'memo_decline') {
			//Verify Paper notice
			$data = array('auction_sts' => 23, 'memo_d_reason' => trim($_POST['reason']), 'memo_d_by' => $this->session->userdata['ast_user']['user_id'], 'memo_d_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);
			$data2 = $this->user_model->user_activities(23, 'auction', $_POST['cma_id'], 'cma_auction', 'Decline Memo(' . $this->input->post('deleteEventId') . ')', $_POST['reason']);
			if ($this->db->affected_rows() > 0) {
				if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'memo_decline') {
					$str = "SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '" . $this->input->post('deleteEventId') . "' LIMIT 1";

					$application_data = $this->db->query($str)->row();

					$checker_id = $application_data->ack_by;

					$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '" . $checker_id . "' LIMIT 1";
					$checker_info = $this->db->query($str1)->row();

					if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
						$subject = "Request for Approval";
						$req_type = $application_data->auction_sts;
						$subject .= " [" . $req_type . "] (" . date('l, M d, Y h:i:s A') . ')';
						$message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: " . $req_type . "<br/>
                        Request by: " . $this->session->userdata['ast_user']['user_name'] . " (" . $this->session->userdata['ast_user']['user_full_id'] . "), <br/>
                        Request Date & Time: " . date('l, M d, Y h:i:s A') . " <br/><br/>
                        Please login to  <a href=" . base_url() . ">LMS Application</a>  to approve the request.<br/><br/>
                        This is a system generated email, no need to reply.<br/><br/>
                        Thanks</div>";
						$m = $this->User_model->send_email("", "", $checker_info->email_address, "", $subject, $message);

					}
				}
			}
		}
		if ($this->input->post('type') == 'memo_hold') {
			//Verify Paper notice
			$data = array('auction_sts' => 21, 'memo_h_reason' => trim($_POST['reason']), 'memo_h_by' => $this->session->userdata['ast_user']['user_id'], 'memo_h_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);

			if ($this->db->affected_rows() > 0) {
				if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'memo_hold') {
					$str = "SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '" . $this->input->post('deleteEventId') . "' LIMIT 1";

					$application_data = $this->db->query($str)->row();

					$checker_id = $application_data->ack_by;

					$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '" . $checker_id . "' LIMIT 1";
					$checker_info = $this->db->query($str1)->row();

					if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
						$subject = "Request for Approval";
						$req_type = $application_data->auction_sts;
						$subject .= " [" . $req_type . "] (" . date('l, M d, Y h:i:s A') . ')';
						$message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: " . $req_type . "<br/>
                        Request by: " . $this->session->userdata['ast_user']['user_name'] . " (" . $this->session->userdata['ast_user']['user_full_id'] . "), <br/>
                        Request Date & Time: " . date('l, M d, Y h:i:s A') . " <br/><br/>
                        Please login to  <a href=" . base_url() . ">LMS Application</a>  to approve the request.<br/><br/>
                        This is a system generated email, no need to reply.<br/><br/>
                        Thanks</div>";
						$m = $this->User_model->send_email("", "", $checker_info->email_address, "", $subject, $message);

						//echo $m;exit;
					}
				}
			}
			$data2 = $this->user_model->user_activities(21, 'auction', $_POST['cma_id'], 'cma_auction', 'Hold Memo(' . $this->input->post('deleteEventId') . ')', $_POST['reason']);
		}
		if ($this->input->post('type') == 'memo_return') {
			//Verify Paper notice
			$data = array('auction_sts' => 20, 'memo_r_reason' => trim($_POST['reason']), 'memo_r_by' => $this->session->userdata['ast_user']['user_id'], 'memo_r_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);
			if ($this->db->affected_rows() > 0) {
				if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'memo_return') {
					$str = "SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '" . $this->input->post('deleteEventId') . "' LIMIT 1";

					$application_data = $this->db->query($str)->row();

					$checker_id = $application_data->ack_by;

					$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '" . $checker_id . "' LIMIT 1";
					$checker_info = $this->db->query($str1)->row();

					if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
						$subject = "Request for Approval";
						$req_type = $application_data->auction_sts;
						$subject .= " [" . $req_type . "] (" . date('l, M d, Y h:i:s A') . ')';
						$message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: " . $req_type . "<br/>
                        Request by: " . $this->session->userdata['ast_user']['user_name'] . " (" . $this->session->userdata['ast_user']['user_full_id'] . "), <br/>
                        Request Date & Time: " . date('l, M d, Y h:i:s A') . " <br/><br/>
                        Please login to  <a href=" . base_url() . ">LMS Application</a>  to approve the request.<br/><br/>
                        This is a system generated email, no need to reply.<br/><br/>
                        Thanks</div>";
						$m = $this->User_model->send_email("", "", $checker_info->email_address, "", $subject, $message);

						//echo $m;exit;
					}
				}
			}
			$data2 = $this->user_model->user_activities(20, 'auction', $_POST['cma_id'], 'cma_auction', 'Return Memo(' . $this->input->post('deleteEventId') . ')', $_POST['reason']);
		}
		if ($this->input->post('type') == 'update_bidder') {
			//Verify Paper notice
			for ($i = 1; $i <= $this->input->post('bidder_info_counter'); $i++) {
				if ($this->input->post('bidder_info_delete_' . $i) != 1) {
					$data = array('selected' => 1, 'select_by' => $this->session->userdata['ast_user']['user_id'], 'select_dt' => date('Y-m-d H:i:s'));
					$this->db->where('id', $_POST['bidder_id_' . $i]);
					$this->db->update('cma_auction_bidder', $data);
				}
			}
			$data = array('auction_sts' => 33);
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);
			$data = array('cma_sts' => 33, 'life_cycle' => 2);
			$this->db->where('id', $_POST['cma_id']);
			$this->db->update('cma', $data);
			$data2 = $this->user_model->user_activities(33, 'auction', $_POST['cma_id'], 'cma_auction', 'Update Bidder And Complete Auction (' . $_POST['cma_id'] . ')');
		}
		if ($this->input->post('type') == 'vendornotify') {
			$data = array('paper_vendor' => trim($_POST['paper_vendor']));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);
			
			$subject = '';
	    	$message='';
	    	$fromemail='';
	    	$response = $this->user_model->send_email($fromemail,"",$this->input->post('email'),'',$subject,$message);
	    	
	    	$data = array(
				'table_name' => 'cma_auction',
				'table_id' => $this->security->xss_clean($_POST['deleteEventId']),
				'vendor_id' => $this->security->xss_clean($this->input->post('paper_vendor')),
				'email' => $this->security->xss_clean($this->input->post('email')),
				'status' =>$response,
				'e_by' => $this->session->userdata['ast_user']['user_id'],
				'e_dt' => date('Y-m-d H:i:s'),
			);

	    	$this->db->insert('vendor_mail_history', $data);

		}
		if ($this->input->post('type') == 'hold') {
			//Verify Paper notice
			//'auction_sts' => 102, 
			$data = array('auction_hold_reason' => trim($_POST['hold_reason']), 'auction_hold_by' => $this->session->userdata['ast_user']['user_id'], 'auction_hold_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);
			$data2 = $this->user_model->user_activities(102, 'auction', $_POST['cma_id'], 'cma_auction', 'Hold Auction(' . $this->input->post('deleteEventId') . ')', $_POST['hold_reason']);
		}
		if ($this->input->post('type') == 'return_to_maker') {
			//Verify Paper notice
			$data = array('auction_sts' => 103, 'return_to_m_reason' => trim($_POST['hold_return_reason']), 'return_to_m_by' => $this->session->userdata['ast_user']['user_id'], 'return_to_m_dt' => date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma_auction', $data);
			//Updating CMA Data
			$data = array('cma_sts' => 103,'life_cycle'=>1);
			$this->db->where('id', $_POST['cma_id']);
			$this->db->update('cma', $data);
			$data2 = $this->user_model->user_activities(103, 'auction', $_POST['cma_id'], 'cma_auction', 'Return To Maker Auction(' . $this->input->post('deleteEventId') . ')', $_POST['hold_return_reason']);
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		} else {
			$this->db->trans_commit();
			$this->db->db_debug = $db_debug;
			return $_POST['deleteEventId'];
		}
	}
	//GROUP_CONCAT(DISTINCT(f0.ac_number) ORDER BY f0.id ASC SEPARATOR ',') AS all_ac
	public function get_word_data($id) {
		$where = "j0.id='" . $id . "'";
		$this->db
			->select("j0.id,j0.sl_no,j0.brrower_name,j0.loan_ac,j0.proposed_type,
                GROUP_CONCAT(f0.ac_number ORDER BY f0.id ASC SEPARATOR ',') AS all_ac,
                GROUP_CONCAT(f0.outstanding_bl_dt ORDER BY f0.id ASC SEPARATOR ',') AS out_bl_dt,
                GROUP_CONCAT(f0.outstanding_bl ORDER BY f0.id ASC SEPARATOR ',') AS out_bl", FALSE)
			->from('cma as j0')
			->join('ref_auc_sts as auc', 'j0.pre_auc_sts=auc.id', 'left')
			->join('cma_auction as a', 'j0.id=a.cma_id', 'left')
			->join('cma_facility as f0', 'j0.id=f0.cma_id', 'left')
			->where($where, NULL, FALSE);
		$query = $this->db->get()->result_array();
		foreach ($query as $i => $product) {
			$this->db->select("g.* ,
                    IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
                    IF(g.guarantor_type='', ' ', t.name) as type_name,
                    IF(g.occ_sts='', ' ', o.name) as occ_sts_name");
			$this->db->from('cma_guarantor as g');
			$this->db->join("ref_guar_type as t", "g.guarantor_type=t.code", "left OUTER");
			$this->db->join("ref_guar_sts as s", "g.guar_sts=s.id", "left OUTER");
			$this->db->join("ref_guar_occ as o", "g.occ_sts=o.code", "left OUTER");
			$this->db->where('g.cma_id', $product['id']);
			$this->db->where('g.sts', '1');

			$images_query = $this->db->get()->result_array();
			$query[$i]['guarntor'] = $images_query;
		}
		foreach ($query as $i => $product) {
			if ($product['proposed_type'] == 'Loan') {
				$this->db->select("f0.id,f0.facility_type,f1.name as facility_type_name,f0.cma_id,f0.cl_bb,f0.outstanding_bl,f0.payble,f0.repayment,f0.disbursed_amount,f0.ac_number,
                    IF(DATE_FORMAT(f0.outstanding_bl_dt,'%d%m%Y') != 0,date_format(f0.outstanding_bl_dt,'%Y-%m-%d'),'') as outstanding_bl_dt,
                    IF(DATE_FORMAT(f0.overdue_bl_dt,'%d%m%Y') != 0,date_format(f0.overdue_bl_dt,'%Y-%m-%d'),'') as overdue_bl_dt,
                    IF(DATE_FORMAT(f0.expire_date,'%d%m%Y') != 0,date_format(f0.expire_date,'%Y-%m-%d'),'') as expire_date,
                    IF(DATE_FORMAT(f0.disbursement_date,'%d%m%Y') != 0,date_format(f0.disbursement_date,'%Y-%m-%d'),'') as disbursement_date");
				$this->db->from('cma_facility as f0');
				$this->db->join("ref_facility_name as f1", "f0.facility_type=f1.code", "left OUTER");
				$this->db->where('f0.cma_id', $product['id']);
				$this->db->where('f0.sts', '1');
				$this->db->where('f0.section_type', 'loan');

				$images_query = $this->db->get()->result_array();
				$query[$i]['facility_loan'] = $images_query;

				//get cma facility mortgage
				$this->db->select("m0.id,m0.cma_id,m0.valuator_name,m0.valuator_date,m0.re_valuator_name,m0.re_valuator_date,m0.valuator_mv,m0.valuator_fsv,m0.re_valuator_mv,m0.re_valuator_fsv,m0.gov_mouza_rate,m0.mort_schedule_name,m0.mort_schedule_desc,m0.deed_number,
                        date_format(m0.mortgage_date,'%d-%b-%y %h:%i %p') as mortgage_date,
                        GROUP_CONCAT(DISTINCT(s0.city_jorip_dag_no) ORDER BY s0.mortgage_id ASC SEPARATOR ' & ') AS city_jorip_dag_no,
                        GROUP_CONCAT(DISTINCT(s0.rs_dag_no) ORDER BY s0.mortgage_id ASC SEPARATOR ' & ') AS rs_dag_no,
                        GROUP_CONCAT(DISTINCT(s0.sa_dag_no) ORDER BY s0.mortgage_id ASC SEPARATOR ' & ') AS sa_dag_no,
                        GROUP_CONCAT(DISTINCT(s0.cs_dag_no) ORDER BY s0.mortgage_id ASC SEPARATOR ' & ') AS cs_dag_no,
                        GROUP_CONCAT(DISTINCT(s0.rs_khatian_no) ORDER BY s0.mortgage_id ASC SEPARATOR ' & ') AS rs_khatian_no,
                        GROUP_CONCAT(DISTINCT(s0.sa_khatian_no) ORDER BY s0.mortgage_id ASC SEPARATOR ' & ') AS sa_khatian_no,
                        GROUP_CONCAT(DISTINCT(s0.cs_khatian_no) ORDER BY s0.mortgage_id ASC SEPARATOR ' & ') AS cs_khatian_no,
                        GROUP_CONCAT(DISTINCT(s0.city_jorip_khatian_no) ORDER BY s0.mortgage_id ASC SEPARATOR ' & ') AS city_jorip_khatian_no");
				$this->db->from('cma_facility_mortgage as m0');
				$this->db->join('cma_facility_mortgage_security as s0', "s0.mortgage_id=m0.id");
				$this->db->where('m0.cma_id', $product['id']);
				$this->db->where('m0.sts', '1');
				$this->db->group_by("m0.id");

				$images_query = $this->db->get()->result_array();
				$query[$i]['mortgage'] = $images_query;
				//get cma Bidder
				$this->db->select(" b0.*,b0.bidder_name,b0.bidder_details,b1.name as bidder_rank,b0.selected,
                            date_format(b0.pay_order_date,'%d-%b-%y %h:%i %p') as pay_order_date");
				$this->db->from('cma_auction_bidder as b0');
				$this->db->join("ref_bidder_rank as b1", "b1.id=b0.bidder_rank", "left OUTER");

				$this->db->where('b0.cma_id', $product['id']);
				$this->db->where('b0.sts', '1');

				$images_query = $this->db->get()->result_array();
				$query[$i]['bidder'] = $images_query;

			} else {
				$this->db->select("IF(DATE_FORMAT(card_iss_date,'%d%m%Y') != 0,date_format(card_iss_date,'%Y-%m-%d'),'') as card_iss_date,
                    IF(DATE_FORMAT(card_exp_date,'%d%m%Y') != 0,date_format(card_exp_date,'%Y-%m-%d'),'') as card_exp_date,
                    card_limit,outstanding_bl");
				$this->db->from('cma');
				$this->db->where('id', $product['id']);
				$this->db->where('sts', '1');
				$images_query = $this->db->get()->result_array();
				$query[$i]['facility'] = $images_query;
			}

		}
		return $query;
	}

	function get_m_guarantor_info($id) // get data for edit
	{
		if ($id != '') {
			$str = " SELECT g.* ,
            IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
            IF(g.guarantor_type='', ' ', t.name) as type_name,
            IF(g.occ_sts='', ' ', o.name) as occ_sts_name
            FROM cma_guarantor g
            LEFT OUTER JOIN ref_guar_type t on(g.guarantor_type=t.code)
            LEFT OUTER JOIN ref_guar_sts s on(g.guar_sts=s.id)
            LEFT OUTER JOIN ref_guar_occ o on(g.occ_sts=o.code)
            WHERE g.sts = '1'  AND g.cma_id= " . $this->db->escape($id) . " AND g.guarantor_type='M' ORDER BY g.id ASC";
			$query = $this->db->query($str);
			return $query->result();
		} else {return NULL;}
	}
	function get_g_guarantor_info($id) // get data for edit
	{
		if ($id != '') {
			$str = " SELECT g.* ,
            IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
            IF(g.guarantor_type='', ' ', t.name) as type_name,
            IF(g.occ_sts='', ' ', o.name) as occ_sts_name
            FROM cma_guarantor g
            LEFT OUTER JOIN ref_guar_type t on(g.guarantor_type=t.code)
            LEFT OUTER JOIN ref_guar_sts s on(g.guar_sts=s.id)
            LEFT OUTER JOIN ref_guar_occ o on(g.occ_sts=o.code)
            WHERE g.sts = '1'  AND g.cma_id= " . $this->db->escape($id) . " AND g.guarantor_type='G' ORDER BY g.id ASC";
			$query = $this->db->query($str);
			return $query->result();
		} else {return NULL;}
	}
	function get_security($id) {

		if ($id != '') {
			$str = " SELECT
                GROUP_CONCAT(j0.cs_khatian_no ORDER BY j0.id ASC SEPARATOR ',') AS cs_khat,
                GROUP_CONCAT(j0.sa_khatian_no ORDER BY j0.id ASC SEPARATOR ',') AS sa_khat,
                GROUP_CONCAT(j0.rs_khatian_no ORDER BY j0.id ASC SEPARATOR ',') AS rs_khat,
                GROUP_CONCAT(j0.mutation_khatian_no ORDER BY j0.id ASC SEPARATOR ',') AS namjari,
                GROUP_CONCAT(j0.cs_dag_no ORDER BY j0.id ASC SEPARATOR ',') AS cs_dag,
                GROUP_CONCAT(j0.sa_dag_no ORDER BY j0.id ASC SEPARATOR ',') AS sa_dag,
                GROUP_CONCAT(j0.rs_dag_no ORDER BY j0.id ASC SEPARATOR ',') AS rs_dag,
                GROUP_CONCAT(j0.bs_dp_dag_no ORDER BY j0.id ASC SEPARATOR ',') AS bs_dag
            FROM cma_facility_mortgage_security as j0
            WHERE j0.cma_id= " . $this->db->escape($id) . " AND j0.sts='1' GROUP BY j0.cma_id";
			$query = $this->db->query($str);
			return $query->result();
		} else {
			return array();
		}
	}
	function get_facility($id) {

		if ($id != '') {
			$str = "SELECT SUM(f0.outstanding_bl) as t_amount
            FROM cma_facility as f0
            WHERE f0.cma_id= " . $this->db->escape($id) . " AND f0.sts='1' GROUP BY f0.cma_id";
			$query = $this->db->query($str);
			return $query->result();
		} else {
			return array();
		}
	}

}

?>