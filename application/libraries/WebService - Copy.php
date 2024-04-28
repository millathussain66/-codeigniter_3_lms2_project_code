<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebService 
{
	public $obj = null;

	public $url = 'http://10.156.0.105/eDocSrv/Oradbaccess.asmx?wsdl';
	public $user_id = 'e-DocSystem';
	public $password = 'eD0CSyst3mL';
	public $live_dev = 'dev';
	// public $live_dev = 'liv';
    
    public function __construct()
    {
        $this->obj =& get_instance();
		
		ini_set('soap.wsdl_cache_enabled',0);
		ini_set('soap.wsdl_cache_ttl',0);
		libxml_disable_entity_loader(false);
    }
	
	function call_service($method=NULL,$par_1=NULL,$par_2=NULL)
	{
		error_reporting(0);
		$live_dev='dev'; //liv
		$var =array();  
		$Message='';
		if($live_dev=='liv'){			
			$url = $this->config->item('web_service_url');
			$client = new SoapClient($url);
		}
		
		if($method=='GetCustomerInfoByCardNo' && $live_dev=='liv')
		{
			$this->CI=& get_instance();

			$secound_db= $this->CI->load->database('oracle', TRUE);

			$exist2 = $secound_db->query("SELECT X.CB_FIN_ACCTNO,
				  CB_CIF_NO  CIF_NO,
				  CB_INDIVIDUAL_ACCTNO INDIVIDUAL_ACCTNO,
				  X.cb_cardholder_no CARDHOLDER_NO,
				  --concat(concat(substr(LT_CARDHDR_NO,1,6),'******'),substr(LT_CARDHDR_NO,13,4))  CARDHOLDER_NO
				  cb_idno Customer_id,
				  CB_BASIC_SUPP_IND  BASIC_SUPPLE_IND,
				  CARD_TYPE,
				  CARD_BRAND,
				  PRODCT_GROUP,
				  PR_DESC Product_DESC,
				   CURR_CODE,
				  CB_STATUS_CD STATUS_CD,
				  cb_plastic_Cd plastic_Cd,
				  CB_BILL_CYCLE BILL_CYCLE,
				  CB_TITLE TITLE,
				  CB_CARDHOLDER_NAME CARDHOLDER_NAME,
				  FATHER_NAME,
				  nid,
				  cb_mother_name mother_name,
				  CB_SPOUSE_NAME SPOUSE_NAME,
				  cb_mobile_no mobile_no,
				  CREDIT_LIMIT,
				  OUTSTD_BAL,
				  cb_DOB  DOB,
				  cb_email email,
				  CB_EMAIL2  EMAIL2,
				  CB_EMAIL3  EMAIL3,
				  CB_SEX  gender,
				  CB_NATIONALITY NATIONALITY,
				  -----Home address---
				  CB_HOME_ADDR1  HOME_ADDR1,
				  CB_HOME_ADDR2 HOME_ADDR2,
				  CB_HOME_ADDR3 HOME_ADDR3,
				  CB_HOME_ADDR4  HOME_ADDR4,
				  CB_HOME_ADDR5  HOME_ADDR5,
				  CB_HOME_CITY  HOME_CITY,
				  CB_HOME_STATE HOME_STATE,
				  CB_HOME_CNTRY_CD HOME_CNTRY_CD,
				 CB_HOME_POSTCODE HOME_POSTCODE,
				 CB_HOME_PHONE HOME_PHONE,
				 CB_HOME_OWNERSHIP HOME_OWNERSHIP,
				 CB_HOUSE_TYPE HOUSE_TYPE,
				 ------company address------------
				 CB_CO_ADDR1 CO_ADDR1,
				 CB_CO_ADDR2 CO_ADDR2,
				 CB_CO_ADDR3 CO_ADDR3,
				 CB_CO_ADDR4 CO_ADDR4,
				 CB_CO_ADDR5 CO_ADDR5,
				 CB_CO_CITY CO_CITY,
				 CB_CO_STATE CO_STATE,
				 CB_CO_CNTRY_CD CO_CNTRY_CD,
				 CB_CO_POSTCODE CO_POSTCODE,
				 CB_CO_PHONE CO_PHONE,
				 CB_CO_FAXNO CO_FAXNO,
				 CB_CO_DESGN CO_DESGN,
				 ------------parmanent address---------------
				 CB_ALT1_BILL_ADDR1 ALT1_BILL_ADDR1,
				 CB_ALT1_BILL_ADDR2 ALT1_BILL_ADDR2,
				 CB_ALT1_BILL_ADDR3 ALT1_BILL_ADDR3,
				 CB_ALT1_BILL_ADDR4 ALT1_BILL_ADDR4,
				 CB_ALT1_BILL_ADDR5 ALT1_BILL_ADDR5,
				 CB_ALT1_BILL_CITY ALT1_BILL_CITY,
				 CB_ALT1_BILL_STATE ALT1_BILL_STATE,
				 CB_ALT1_BILL_CNTRY_CD ALT1_BILL_CNTRY_CD,
				 CB_ALT1_BILL_ADDR_POSTCODE ALT1_BILL_ADDR_POSTCODE,
				 ---------need to confirm from operation team what type of data keep below fields.----------------------
				 CB_ALT2_BILL_ADDR1 ALT2_BILL_ADDR1,
				 CB_ALT2_BILL_ADDR2 ALT2_BILL_ADDR2,
				 CB_ALT2_BILL_ADDR3 ALT2_BILL_ADDR3,
				 CB_ALT2_BILL_ADDR4 ALT2_BILL_ADDR4,
				 CB_ALT2_BILL_ADDR5 ALT2_BILL_ADDR5,
				 CB_ALT2_BILL_CITY ALT2_BILL_CITY,
				 CB_ALT2_BILL_STATE ALT2_BILL_STATE,
				 CB_ALT2_BILL_CNTRY_CD ALT2_BILL_CNTRY_CD,
				 CB_ALT2_BILL_ADDR_POSTCODE ALT2_BILL_ADDR_POSTCODE,
				  --reference information:  --reference information:
				   CB_REL_NAME   REL_NAME,
				   CB_REL_NRIC   REL_NRIC,
				   CB_REL_DOB   REL_DOB,
				   CB_REL_SEX   REL_SEX,
				   CB_REL_RELATION_TO_CH   REL_RELATION_TO_CH,
				   CB_REL_DESGN   REL_DESGN,
				   CB_REL_ADDR1   REL_ADDR1,
				   CB_REL_ADDR2   REL_ADDR2,
				   CB_REL_ADDR3   REL_ADDR3,
				   CB_REL_ADDR4   REL_ADDR4,
				   CB_REL_ADDR5   REL_ADDR5,
				   CB_REL_CITY   REL_CITY,
				   CB_REL_TELNO   REL_TELNO,
				   
				  CARD_DELIVERY_ADDR,
				  mailing_Address,
				  CB_LEGAL_ADDR_CD,
				  ISSUING_BRANCH_ID,
				   CREATION_DATE,
				   EXPIRY_DATE
				FROM
				  (SELECT C.CB_FIN_ACCTNO,
				C.CB_INDIVIDUAL_ACCTNO,
				    CB_CIF_NO,
				    cb_cardholder_no,
				    cb_idno,
				    CB_BASIC_SUPP_IND,
				    CB_PRD_CATEGORY CARD_TYPE,
				    CB_STATUS_CD,
				    cb_plastic_Cd,
				    CB_BILL_CYCLE,
				    CB_TITLE,
				    CB_CARDHOLDER_NAME,
				    CB_ADL_FIELD_NAME01 FATHER_NAME,
				    CB_ADL_FIELD_NAME02 nid,
				    cb_mother_name,
				    CB_SPOUSE_NAME,
				    cb_mobile_no,
				    CB_LINE_LIMIT CREDIT_LIMIT,
				    cb_DOB,
				    cb_email,
				    CB_EMAIL2,
				    CB_EMAIL3,
				    CB_SEX,
				    CB_NATIONALITY,
				    CB_CURMTH_PAYDUE_DATE CURMTH_PAYDUE_DATE,
				    CB_HOME_ADDR1,
				    CB_HOME_ADDR2,
				    CB_HOME_ADDR3,
				    CB_HOME_ADDR4,
				    CB_HOME_ADDR5,
				    CB_HOME_CITY,
				    CB_HOME_STATE,
				    CB_HOME_CNTRY_CD,
				    CB_HOME_POSTCODE,
				    CB_HOME_PHONE,
				    CB_HOME_OWNERSHIP,
				    CB_HOUSE_TYPE,
				    CB_CO_ADDR1,
				    CB_CO_ADDR2,
				    CB_CO_ADDR3,
				    CB_CO_ADDR4,
				    CB_CO_ADDR5,
				    CB_CO_CITY,
				    CB_CO_STATE,
				    CB_CO_CNTRY_CD,
				    CB_CO_POSTCODE,
				    CB_CO_PHONE,
				    CB_CO_FAXNO,
				    CB_CO_DESGN,
				    CB_ALT1_BILL_ADDR1,
				    CB_ALT1_BILL_ADDR2,
				    CB_ALT1_BILL_ADDR3,
				    CB_ALT1_BILL_ADDR4,
				    CB_ALT1_BILL_ADDR5,
				    CB_ALT1_BILL_CITY,
				    CB_ALT1_BILL_STATE,
				    CB_ALT1_BILL_CNTRY_CD,
				    CB_ALT1_BILL_ADDR_POSTCODE,
				    CB_ALT2_BILL_ADDR1,
				    CB_ALT2_BILL_ADDR2,
				    CB_ALT2_BILL_ADDR3,
				    CB_ALT2_BILL_ADDR4,
				    CB_ALT2_BILL_ADDR5,
				    CB_ALT2_BILL_CITY,
				    CB_ALT2_BILL_STATE,
				    CB_ALT2_BILL_CNTRY_CD,
				    CB_ALT2_BILL_ADDR_POSTCODE,
				    --reference information:
				    CB_REL_NAME,
				    CB_REL_NRIC,
				    CB_REL_DOB,
				    CB_REL_SEX,
				    CB_REL_RELATION_TO_CH,
				    CB_REL_DESGN,
				    CB_REL_ADDR1,
				    CB_REL_ADDR2,
				    CB_REL_ADDR3,
				    CB_REL_ADDR4,
				    CB_REL_ADDR5,
				    CB_REL_CITY,
				    CB_REL_TELNO,
				    CB_CARD_DELIVERY_ADDR CARD_DELIVERY_ADDR,
				    CB_BILL_ADDR_CD mailing_Address,
				    CB_LEGAL_ADDR_CD,
				    PR_CARD_BRAND CARD_BRAND,
				    E.PR_PRODCT_GROUP PRODCT_GROUP,
				    PR_DESC,
				    PR_BILL_CURR_CODE CURR_CODE,
				    CB_CENTRE_CD ISSUING_BRANCH_ID,
				    CB_APPLCATION_DATE CREATION_DATE,
				    CB_EXPIRY_CCYYMM EXPIRY_DATE
				  FROM cardpro.cp_crdtbl G,
				    cardpro.cp_csttbl a ,
				    cardpro.cp_cstadl b ,
				    cardpro.cp_indacc C,
				    CARDPRO.CP_FINTBL D,
				    cardpro.cp_prodct E,
				    cardpro.cp_prdgrp F
				  WHERE cb_idno         =a.cb_customer_idno
				  AND b.cb_customer_idno=a.cb_customer_idno
				  AND cb_cardholder_no  =cb_ind_Cardholder_no
				  AND D.CB_FIN_ACCTNO   =C.CB_FIN_ACCTNO
				  and E.PR_PRODCT_GROUP=F.PR_PRODCT_GROUP
				  and G.CB_CARD_PRDCT_GROUP=E.PR_PRODCT_GROUP

				 and (CB_cardholder_no =RPAD('".$par_1."', 19, ' '))
				  
				 
				  ))X

				LEFT JOIN
				  (select CB_FIN_ACCTNO,sum(CB_OUTSTD_BAL) OUTSTD_BAL from  CARDPRO.CP_INDACC P  --@BOSDB_LINK P
				   group by CB_FIN_ACCTNO
				  )B
				ON B.CB_FIN_ACCTNO=X.CB_FIN_ACCTNO")->row();

				//print_r($exist2 );
			
				if(is_object($exist2))
					{
						$var['CB_FIN_ACCTNO']=$exist2->CB_FIN_ACCTNO;
						$var['CIF_NO']=$exist2->CIF_NO;
						$var['INDIVIDUAL_ACCTNO']=$exist2->INDIVIDUAL_ACCTNO;
						$var['CARDHOLDER_NO']=$exist2->CARDHOLDER_NO;
						$var['CUSTOMER_ID']=$exist2->CUSTOMER_ID;  //substr($exist2->DOB,0,10); 1989-10-24
						$var['BASIC_SUPPLE_IND']=$exist2->BASIC_SUPPLE_IND;
						$var['CARD_TYPE']=$exist2->CARD_TYPE;
						$var['CARD_BRAND']=$exist2->CARD_BRAND;
						$var['PRODCT_GROUP']=$exist2->PRODCT_GROUP;
						$var['PRODUCT_DESC']=$exist2->PRODUCT_DESC;
						$var['CURR_CODE']=$exist2->CURR_CODE;
						
						$var['STATUS_CD']=$exist2->STATUS_CD;
						$var['PLASTIC_CD']=$exist2->PLASTIC_CD;
						$var['BILL_CYCLE']=$exist2->BILL_CYCLE;
						$var['TITLE']=$exist2->TITLE;
						$var['CARDHOLDER_NAME']=$exist2->CARDHOLDER_NAME;
						$var['FATHER_NAME']=$exist2->FATHER_NAME;
						$var['NID']=$exist2->NID;
						$var['MOTHER_NAME']=$exist2->MOTHER_NAME;
						$var['SPOUSE_NAME']=$exist2->SPOUSE_NAME;
						$var['MOBILE_NO']=$exist2->MOBILE_NO;
						$var['CREDIT_LIMIT']=$exist2->CREDIT_LIMIT;
						$var['OUTSTD_BAL']=$exist2->OUTSTD_BAL;
						$var['DOB']=$exist2->DOB;
						$var['EMAIL']=$exist2->EMAIL;
						$var['EMAIL2']=$exist2->EMAIL2;
						$var['EMAIL3']=$exist2->EMAIL3;
						$var['GENDER']=$exist2->GENDER;
						$var['NATIONALITY']=$exist2->NATIONALITY;
						$var['HOME_ADDR1']=$exist2->HOME_ADDR1;
						$var['HOME_ADDR2']=$exist2->HOME_ADDR2;
						$var['HOME_ADDR3']=$exist2->HOME_ADDR3;
						$var['HOME_ADDR4']=$exist2->HOME_ADDR4;
						$var['HOME_ADDR5']=$exist2->HOME_ADDR5;
						$var['HOME_CITY']=$exist2->HOME_CITY;
						$var['HOME_STATE']=$exist2->HOME_STATE;
						$var['HOME_CNTRY_CD']=$exist2->HOME_CNTRY_CD;
						$var['CO_ADDR1']=$exist2->CO_ADDR1;
						$var['CO_ADDR2']=$exist2->CO_ADDR2;
						$var['CO_ADDR3']=$exist2->CO_ADDR3;
						$var['ALT1_BILL_ADDR1']=$exist2->ALT1_BILL_ADDR1;
						$var['ALT1_BILL_ADDR2']=$exist2->ALT1_BILL_ADDR2;
						$var['ALT1_BILL_ADDR3']=$exist2->ALT1_BILL_ADDR3;
						$var['CREATION_DATE']=$exist2->CREATION_DATE;
						$var['EXPIRY_DATE']=$exist2->EXPIRY_DATE;
					}
					else{
						$Message='Invalid Service Response:';
					}
			
			
			$var['Message']=$Message;
			return $var;
		}
		if($method=='GetCustomerInfoByCardNo' && $live_dev=='dev')
		{
			$var['CB_FIN_ACCTNO'] = '00000000000000243102'; 
			$var['CIF_NO'] = '02909790'; 
			$var['INDIVIDUAL_ACCTNO'] = '00000000000000148090'; 
			$var['CARDHOLDER_NO'] = '4321470000688936'; 
			$var['CUSTOMER_ID'] = '64001512700200'; 
			$var['BASIC_SUPPLE_IND'] = 'B';
			$var['CARD_TYPE'] = 'CONV';
			$var['CARD_BRAND'] = 'V'; 
			$var['PRODCT_GROUP'] = '1301'; 
			$var['PRODUCT_DESC'] = 'GOLD CREDIT CARD- STAFF'; 
			$var['CURR_CODE'] = '50'; 
			$var['STATUS_CD'] = '';
			$var['PLASTIC_CD'] = '';
			$var['BILL_CYCLE'] = '10'; 
			$var['TITLE'] = 'MR'; 
			$var['CARDHOLDER_NAME'] = 'SHAH MD. NAZMUS SHAKIB'; 
			$var['FATHER_NAME'] = 'TAIBUR RAHMAN'; 
			$var['NID'] = '19916919115000302 ';
			$var['MOTHER_NAME'] = 'UMME SALMA MOSA NAZMA SHIRIN'; 
			$var['SPOUSE_NAME'] = '';
			$var['MOBILE_NO'] = '+8801787669336'; 
			$var['CREDIT_LIMIT'] = '100000 ';
			$var['OUTSTD_BAL'] = '-1222262983.82 ';
			$var['DOB'] = '19911125 ';
			$var['EMAIL'] = 'bbluba2020@gmail.com'; 
			$var['EMAIL2'] = '';
			$var['EMAIL3'] = '';
			$var['GENDER'] = 'M ';
			$var['NATIONALITY'] = 'BD'; 
			$var['HOME_ADDR1'] = '93/1,GOLARTAK,MIRPUR-1'; 
			$var['HOME_ADDR2'] = 'DHAKA'; 
			$var['HOME_ADDR3'] = '';
			$var['HOME_ADDR4'] = '';
			$var['HOME_ADDR5'] = '';
			$var['HOME_CITY'] = 'DHAKA ';
			$var['HOME_STATE'] = 'DHAKA'; 
			$var['HOME_CNTRY_CD'] = 'BD ';
			$var['HOME_POSTCODE'] = '';
			$var['HOME_PHONE'] = '';
			$var['HOME_OWNERSHIP'] = '';
			$var['HOUSE_TYPE'] = '';
			$var['CO_ADDR1'] = 'HOUSE#115,ROAD#5,BLOCK#B'; 
			$var['CO_ADDR2'] = 'NIKETON SOCIETY,P.S.-GULSHAN ';
			$var['CO_ADDR3'] = 'DHAKA'; 
			$var['CO_ADDR4'] = '';
			$var['CO_ADDR5'] = '';
			$var['CO_CITY'] = 'DHAKA ';
			$var['CO_STATE'] = 'DHAKA ';
			$var['CO_CNTRY_CD'] = 'BD ';
			$var['CO_POSTCODE'] = '';
			$var['CO_PHONE'] = '';
			$var['CO_FAXNO'] = '';
			$var['CO_DESGN'] = 'ANALYST,APPLICATION MANAGMENT SERVICE'; 
			$var['ALT1_BILL_ADDR1'] = 'VILL-SATERBARIA ';
			$var['ALT1_BILL_ADDR2'] = 'P.O.-KARICHMARIA,P.S-SINGRA NATORE'; 
			$var['ALT1_BILL_ADDR3'] = 'RAJSHAHI ';
			$var['ALT1_BILL_ADDR4'] = '';
			$var['ALT1_BILL_ADDR5'] = '';
			$var['ALT1_BILL_CITY'] = 'RAJSHAHI ';
			$var['ALT1_BILL_STATE'] = 'RAJSHAHI'; 
			$var['ALT1_BILL_CNTRY_CD'] = 'BD ';
			$var['ALT1_BILL_ADDR_POSTCODE'] = '';
			$var['ALT2_BILL_ADDR1'] = '';
			$var['ALT2_BILL_ADDR2'] = '';
			$var['ALT2_BILL_ADDR3'] = '';
			$var['ALT2_BILL_ADDR4'] = '';
			$var['ALT2_BILL_ADDR5'] = '';
			$var['ALT2_BILL_CITY'] = '';
			$var['ALT2_BILL_STATE'] = '';
			$var['ALT2_BILL_CNTRY_CD'] = 'BD ';
			$var['ALT2_BILL_ADDR_POSTCODE'] = '';
			$var['REL_NAME'] = 'RUKSAT HOSSAIN ';
			$var['REL_NRIC'] = '';
			$var['REL_DOB'] = '';
			$var['REL_SEX'] = 'M ';
			$var['REL_RELATION_TO_CH'] = '';
			$var['REL_DESGN'] = '';
			$var['REL_ADDR1'] = 'H#11,R#3,MOHAMMADPUR,DHAKA ';
			$var['REL_ADDR2'] = '';
			$var['REL_ADDR3'] = '01729295995';
			$var['REL_ADDR4'] = '';
			$var['REL_ADDR5'] = '';
			$var['REL_CITY'] = 'DHAKA ';
			$var['REL_TELNO'] = '';
			$var['CARD_DELIVERY_ADDR'] = 'C ';
			$var['MAILING_ADDRESS'] = 'C ';
			$var['CB_LEGAL_ADDR_CD'] = 'H ';
			$var['ISSUING_BRANCH_ID'] = '9099 ';
			$var['CREATION_DATE'] = '20150507 ';
			$var['EXPIRY_DATE'] = '20250507 ';
			$Message='OK';
			
			
			$var['Message']=$Message;
			return $var;
		}
		if($method=='GetLoanDetalsByCif' && $live_dev=='liv')
		{
			$envelope = '<?xml version="1.0" encoding="UTF-8"?>
			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:v1="http://bracbank.com/UBALoanListAndDetailsES/V1" xmlns:v11="http://bracbank.com/utilityCommon/V1">
			    <soapenv:Header/>
			    <soapenv:Body>
			        <v1:loanListAndDetails>
			            <v1:loanListAndDetail>
			                <v1:header>
			                    <v11:serviceId>UC-019</v11:serviceId>
			                    <v11:serviceName>UBALoanListAndDetailsES</v11:serviceName>
			                    <v11:sourceTimestamp>2008-09-29T07:49:45</v11:sourceTimestamp>
			                    <v11:password>Ahj67#12i89kT!z</v11:password>
			                    <v11:channelName>LMS</v11:channelName>
			                    <v11:channelCode>LMS</v11:channelCode>
			                    <v11:globalTransactionId>Req_1456378980963</v11:globalTransactionId>
			                </v1:header>
			                <v1:loginid/>
			                <v1:cif>'.$par_1.'</v1:cif>
			                <v1:accountNumber>'.$par_2.'</v1:accountNumber>
			                <v1:callType>DETAILS</v1:callType>
			            </v1:loanListAndDetail>
			        </v1:loanListAndDetails>
			    </soapenv:Body>
			</soapenv:Envelope>';

			$soap_do = curl_init();
			curl_setopt($soap_do, CURLOPT_URL,"https://172.25.0.5:4444/UBA/LoanListAndDetails/V1?wsdl" );
			curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);

			//curl_setopt($soap_do, CURLOPT_SSLCERT, "/opt/lampp/etc/cbs_api/myCertificate.crt");
			//curl_setopt($soap_do, CURLOPT_SSLKEY, "/opt/lampp/etc/cbs_api/myPrivateKey.pem");
			//curl_setopt($soap_do, CURLOPT_CAINFO, "/opt/lampp/etc/cbs_api/BBLWildCard08012020.crt");

			curl_setopt($soap_do, CURLOPT_POST, 1);
			curl_setopt($soap_do, CURLOPT_ENCODING, "");
			curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($soap_do, CURLOPT_POST,           true );            
			curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $envelope); 
			curl_setopt($soap_do, CURLOPT_VERBOSE, TRUE); 
			curl_setopt($soap_do, CURLOPT_HTTPHEADER, array("Content-Type: text/xml","SOAPAction: \"/soap/action/query\"", "Content-length: ".strlen($envelope))); 

			$result = curl_exec($soap_do);

			$info =curl_errno($soap_do)>0 ? array("curl_error_".curl_errno($soap_do)=>curl_error($soap_do)) : curl_getinfo($soap_do);
			//print_r($info);
			curl_close($soap_do);
			//echo $result ;
			$xml = simplexml_load_file ($result);
			$xml->registerXPathNamespace('ns2', 'http://bracbank.com/UBALoanListAndDetailsES/V1');
			$nodelist = $xml->xpath('//ns2:fetchLoanListAndDetailsRespDetail/ns2:loanAccountDetails/ns2:loanAccountDetail');

			foreach($nodelist as $head)
			{   
					$accountNumber=$head->xpath('//ns2:accountNumber');	
					$var['accountNumber'] = $accountNumber[0]; 
					$accountHolderName=$head->xpath('//ns2:accountHolderName');
					$var['accountHolderName'] = $accountHolderName[0]; 	
					$schemeType=$head->xpath('//ns2:schemeType');
					//$var['schemeType'] = $schemeType[0];
					echo $accountHolderName;
					echo $schemeType;
					echo $accountNumber;
					//$this->load->helper('form');
					// load XML client request template
					$xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/1_c_2_ac_loan_and_guarantors/LoanAcctInq.xml");
					// set some XML attributes (mark the request with the date/time)
					$xml->attributes ()->timestamp = date ("Y-m-d H:i:s");
					// obtain and set all information necessary for order data transfer
					// may need htmlspecialchars(utf8_encode($var)) for text with &, <, >
					// if encoding requires it and if it's not automated by simplexml version
					$xml->Body->LoanAcctInqRequest->LoanAcctInqRq->LoanAcctId->AcctId = $accountNumber[0];

					$request = $xml->asXML (); // convert to well-formed XML output

					$header[0] = "Host: fin10xtestj2ee.bracbank.com";

					//$header[0] = "Host: localhost";
					$header[1] = "Content-type: text/xml";
					$header[2] = "Content-length: ".strlen ($request)."\r\n";
					$header[3] = $request;

					//$data = array('key'=>'value');
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "https://fin10xtestj2ee.bracbank.com:45000/FISERVLET/fihttp");
					//curl_setopt($ch, CURLOPT_PORT , 443);
					curl_setopt($ch, CURLOPT_VERBOSE, 0);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					//curl_setopt($ch, CURLOPT_SSLCERT, getcwd() . "/public_cert.pem");
					//curl_setopt($ch, CURLOPT_SSLKEY, getcwd() . "/private.pem");
					curl_setopt($ch, CURLOPT_SSLCERT, "/opt/lampp/etc/cbs_api/myCertificate.crt");
					curl_setopt($ch, CURLOPT_SSLKEY, "/opt/lampp/etc/cbs_api/myPrivateKey.pem");
					curl_setopt($ch, CURLOPT_CAINFO, "/opt/lampp/etc/cbs_api/cbs_api.crt");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt ($ch, CURLOPT_POSTFIELDS, $request);
					//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
					curl_setopt ($ch, CURLOPT_HTTPHEADER, $header); // send header
					//$result = curl_exec ($ch); // returned XML server result
					//curl_close ($ch);
					 
					$response = curl_exec($ch);
					$info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
					print_r($info);
					curl_close($ch);
					$xml_result = simplexml_load_string ($response ); // obtain XML server result
					//return $xml_result->ServerID;
					//echo $response;
					//$g_cif=$xml_result->Body->LoanAcctInqResponse->LoanAcctInqRs->RelPartyRec->RelPartyType;
					//print_r($xml_result->Body->LoanAcctInqResponse->LoanAcctInqRs->RelPartyRec->RelPartyType);
					foreach ($xml_result->Body->LoanAcctInqResponse->LoanAcctInqRs->RelPartyRec as $key) 
					{
						//echo $key->CustId->CustId;
						$xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/1_c_3_cif_customer_guarantors_details/Request_RetCustInq_Inquiry.xml");
						// set some XML attributes (mark the request with the date/time)
						$xml->attributes ()->timestamp = date ("Y-m-d H:i:s");
						// obtain and set all information necessary for order data transfer
						// may need htmlspecialchars(utf8_encode($var)) for text with &, <, >
						// if encoding requires it and if it's not automated by simplexml version
						$xml->Body->RetCustInqRequest->RetCustInqRq->CustId = $key->CustId->CustId;

						$request = $xml->asXML (); // convert to well-formed XML output
						//echo $request;
						$header[0] = "Host: fin10xtestj2ee.bracbank.com";

						//$header[0] = "Host: localhost";
						$header[1] = "Content-type: text/xml";
						$header[2] = "Content-length: ".strlen ($request)."\r\n";
						$header[3] = $request;

						//$data = array('key'=>'value');
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, "https://fin10xtestj2ee.bracbank.com:45000/FISERVLET/fihttp");
						//curl_setopt($ch, CURLOPT_PORT , 443);
						curl_setopt($ch, CURLOPT_VERBOSE, 0);
						curl_setopt($ch, CURLOPT_HEADER, 0);
						//curl_setopt($ch, CURLOPT_SSLCERT, getcwd() . "/public_cert.pem");
						//curl_setopt($ch, CURLOPT_SSLKEY, getcwd() . "/private.pem");
						curl_setopt($ch, CURLOPT_SSLCERT, "/opt/lampp/etc/cbs_api/myCertificate.crt");
						curl_setopt($ch, CURLOPT_SSLKEY, "/opt/lampp/etc/cbs_api/myPrivateKey.pem");
						curl_setopt($ch, CURLOPT_CAINFO, "/opt/lampp/etc/cbs_api/cbs_api.crt");
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt ($ch, CURLOPT_POSTFIELDS, $request);
						//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
						curl_setopt ($ch, CURLOPT_HTTPHEADER, $header); // send header
						//$result = curl_exec ($ch); // returned XML server result
						//curl_close ($ch);
						 
						$response = curl_exec($ch);
						$info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
						print_r($info);
						curl_close($ch);
						$xml_result = simplexml_load_string ($response );
						echo $xml_result->Body->RetCustInqResponse->RetCustInqRs->RetCustDtls->CustId;
						echo "<br/>";
					}
			}
			

			//return $var;
		}
	}
	
	function makeXmlObject($raw_data){
		$xml ='<?xml version="1.0" encoding="UTF-8"?>
				<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">
					<soap-env:Header>
					'.$raw_data.'
					</soap-env:Header>
				</soap-env:Envelope>	 
			 ';
		$xml = simplexml_load_string($xml);
		$xml->registerXPathNamespace('diffgr', 'urn:schemas-microsoft-com:xml-diffgram-v1');
		return $xml->xpath('//diffgr:diffgram');
	}
}
