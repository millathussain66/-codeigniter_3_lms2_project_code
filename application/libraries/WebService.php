<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebService 
{
	public $obj = null;
    public function __construct()
    {
       $CI =& get_instance();
		
		ini_set('soap.wsdl_cache_enabled',0);
		ini_set('soap.wsdl_cache_ttl',0);
		//libxml_disable_entity_loader(false);
    }
	
	function call_service($method=NULL,$live_dev=NULL,$url=NULL,$user_name=NULL,$channel=NULL,$password=NULL,$par_1=NULL,$par_2=NULL,$par_3=NULL)
	{
		error_reporting(0);
		$var =array();  
		$Message='';
		if($method=='GetLoanDetalsByCif' && $live_dev=='liv')
		{
      		//$url="https://fin10xtestj2ee.bracbank.com:45000/FISERVLET/fihttp";

      		$xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/FI_xcrvAcctByCif.xml");
                  // set some XML attributes (mark the request with the date/time)
                  $xml->attributes ()->timestamp = date ("Y-m-d H:i:s");
                  // obtain and set all information necessary for order data transfer
                  // may need htmlspecialchars(utf8_encode($var)) for text with &, <, >
                  // if encoding requires it and if it's not automated by simplexml version
                  $xml->Body->executeFinacleScriptRequest->executeFinacleScript_CustomData->cifId = $par_1;

                  $request = $xml->asXML (); // convert to well-formed XML output
                  //echo $request;
      		//exit;
                  $header[0] = "Host: fin10xtestj2ee.bracbank.com";

                  //$header[0] = "Host: localhost";
                  $header[1] = "Content-type: text/xml";
                  $header[2] = "Content-length: ".strlen ($request)."\r\n";
                  $header[3] = $request;
                  //$data = array('key'=>'value');
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
      		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
      		curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
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
                  //curl_setopt ($ch, CURLOPT_HTTPHEADER, $header); // send header
                  $response = curl_exec($ch);
                  //$info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
                  //print_r($info);
                  curl_close($ch);
                  $xml_result = simplexml_load_string ($response );
			$j=0;
			$i=1;
			foreach ($xml_result->Body->executeFinacleScriptResponse->executeFinacleScript_CustomData->Customer as $key) 
                  {
                  	// if($key->RelPartyType=='M'){ continue; }
      				
      			if (is_object($key->accountNo) && $key->accountNo!=''){
            		$var[$i]['accountNumber']=$key->accountNo;
                  	}else{$var[$i]['accountNumber'][0]='';}

                        if (is_object($key->sol) && $key->sol!=''){
                        $var[$i]['sol']=$key->sol;
                        }else{$var[$i]['sol'][0]='';}

                        if (is_object($key->acctClsStatus) && $key->acctClsStatus!=''){
                        $var[$i]['acctClsStatus']=$key->acctClsStatus;
                        }else{$var[$i]['acctClsStatus'][0]='';}

                  	if (is_object($key->accountName) && $key->accountName!=''){
                  		$var[$i]['accountHolderName']=ucwords(strtolower($key->accountName));
                  	}else{$var[$i]['accountHolderName'][0]='';}

                  	if (is_object($key->schmType) && $key->schmType!=''){
                  		$var[$i]['schemeType']=$key->schmType;
                  	}else{$var[$i]['schemeType'][0]='';}

                  	if (is_object($key->loanType) && $key->loanType!=''){
                  		$var[$i]['loanType']=$key->loanType;
                  	}else{$var[$i]['loanType'][0]='';}

                        if (is_object($key->dis_date) && $key->dis_date!=''){
                              $var[$i]['dis_date']=$key->dis_date;
                        }else{$var[$i]['dis_date'][0]='';}

                        if (is_object($key->lastAnyTrnDate) && $key->lastAnyTrnDate!=''){
                              $var[$i]['lastAnyTrnDate']=$key->lastAnyTrnDate;
                        }else{$var[$i]['lastAnyTrnDate'][0]='';}

                        if (is_object($key->dis_amt) && $key->dis_amt!=''){
                              $var[$i]['dis_amt']=$key->dis_amt;
                        }else{$var[$i]['dis_amt'][0]='';}

                        if (is_object($key->schmDesc) && $key->schmDesc!=''){
                              $var[$i]['schmDesc']=$key->schmDesc;
                        }else{$var[$i]['schmDesc'][0]='';}

                        if (is_object($key->corp_id) && $key->corp_id!=''){
                              $var[$i]['corp_id']=$key->corp_id;
                        }else{$var[$i]['corp_id'][0]='';}

                        if (is_object($key->mobileNo) && $key->mobileNo!=''){
                              $var[$i]['mobileNo']=$key->mobileNo;
                        }else{$var[$i]['mobileNo'][0]='';}

                        if (is_object($key->cc_code) && $key->cc_code!=''){
                        if (substr($key->cc_code, 0, 1 ) === "3") {//For Retail
                              $var[$i]['accountCifType'][0]='R';
                        }
                        else if(substr($key->cc_code, 0, 1 ) === "4")//For Corporate
                        {
                              $var[$i]['accountCifType'][0]='C';
                        }
                        else if(substr($key->cc_code, 0, 1 ) === "9")//For SME
                        {
                              $var[$i]['accountCifType'][0]='S';
                        }
                        }else{$var[$i]['accountCifType'][0]='';}

                  	$i++;
                  }

			return $var;
		}
            if ($method=='GetBorrowerDetailsByCif' && $live_dev=='liv') 
            {
                  $xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/FI_xcrvCifPro.xml");
                  // set some XML attributes (mark the request with the date/time)
                  $xml->attributes ()->timestamp = date ("Y-m-d H:i:s");
                  // obtain and set all information necessary for order data transfer
                  // may need htmlspecialchars(utf8_encode($var)) for text with &, <, >
                  // if encoding requires it and if it's not automated by simplexml version
                  $xml->Body->executeFinacleScriptRequest->executeFinacleScript_CustomData->cifId = $par_1;

                  $request = $xml->asXML (); // convert to well-formed XML output
                  //echo $request;
                  //exit;
                  $header[0] = "Host: finhttp.bracbank.com/FISERVLET/fihttp";

                  //$header[0] = "Host: localhost";
                  $header[1] = "Content-type: text/xml";
                  $header[2] = "Content-length: ".strlen ($request)."\r\n";
                  $header[3] = $request;
                  //$data = array('key'=>'value');
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
                  curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
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
                  //curl_setopt ($ch, CURLOPT_HTTPHEADER, $header); // send header
                  $response = curl_exec($ch);
                  //$info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
                  //print_r($info);
                  curl_close($ch);
                  $i=1;
                  $xml_result = simplexml_load_string ($response );
                  foreach ($xml_result->Body->executeFinacleScriptResponse->executeFinacleScript_CustomData->Customer as $key) 
                  {
                        // if($key->RelPartyType=='M'){ continue; }
                        $var[$i]['designation'][0]='';
                        $var[$i]['Occupation'][0]='';
                        $var[$i]['present_address2'][0]='';
                        $var[$i]['present_address_city'][0]='';
                        $var[$i]['present_address_country'][0]='';
                        $var[$i]['parmanent_address2'][0]='';
                        $var[$i]['parmanent_address_city'][0]='';
                        $var[$i]['parmanent_address_country'][0]='';
                        $var[$i]['business_address1'][0]='';
                        $var[$i]['business_address2'][0]='';
                        $var[$i]['business_address_city'][0]='';
                        $var[$i]['business_address_country'][0]='';

                        if (is_object($key->custrelncode) && $key->custrelncode!=''){
                        $var[$i]['cust_type'][0]=$key->custrelncode;
                        }else{$var[$i]['cust_type'][0]='';}

                        if (is_object($key->nameproprietor) && $key->nameproprietor!=''){
                        $var[$i]['nameproprietor'][0]=ucwords(strtolower($key->nameproprietor));
                        }else{$var[$i]['nameproprietor'][0]='';}

                        if (is_object($key->fathername) && $key->fathername!=''){
                        $var[$i]['father_name'][0]=ucwords(strtolower($key->fathername));
                        }else{$var[$i]['father_name'][0]='';}

                        if (is_object($key->mothername) && $key->mothername!=''){
                        $var[$i]['mother_name'][0]=ucwords(strtolower($key->mothername));
                        }else{$var[$i]['mother_name'][0]='';}

                        if (is_object($key->spousename) && $key->spousename!=''){
                        $var[$i]['spouse_name'][0]=ucwords(strtolower($key->spousename));
                        }else{$var[$i]['spouse_name'][0]='';}

                        if (is_object($key->presentaddress) && $key->presentaddress!=''){
                        $var[$i]['present_address1'][0]=ucwords(strtolower($key->presentaddress));
                        }else{$var[$i]['present_address1'][0]='';}

                        if (is_object($key->permanenetaddress) && $key->permanenetaddress!=''){
                        $var[$i]['parmanent_address1'][0]=ucwords(strtolower($key->permanenetaddress));
                        }else{$var[$i]['parmanent_address1'][0]='';}

                        $i++;
                  }

                  return $var;

            }
            if($method=='GetBorrowerDetailsByCif' && $live_dev=='dev')
            {
                  $i=1;
                  $var[$i]['nameproprietor'][0]='BBL';     
                  $var[$i]['father_name'][0]= 'Father Name'; 
                  $var[$i]['mother_name'][0]= 'Mother Name'; 
                  $var[$i]['spouse_name'][0]= 'Spouse Name'; 
                  $var[$i]['present_address1'][0]= 'Present Address'; 
                  $var[$i]['parmanent_address1'][0]= 'Permanent Address';
                  $var[$i]['cust_type'][0]='PROP';
                  $var[$i]['designation'][0]='';
                  $var[$i]['Occupation'][0]='';
                  $var[$i]['present_address2'][0]='';
                  $var[$i]['present_address_city'][0]='';
                  $var[$i]['present_address_country'][0]='';
                  $var[$i]['parmanent_address2'][0]='';
                  $var[$i]['parmanent_address_city'][0]='';
                  $var[$i]['parmanent_address_country'][0]='';
                  $var[$i]['business_address1'][0]='';
                  $var[$i]['business_address2'][0]='';
                  $var[$i]['business_address_city'][0]='';
                  $var[$i]['business_address_country'][0]='';
                  return $var;
            }
		if($method=='GetLoanDetalsByCif' && $live_dev=='dev')
		{
			$i=1;
			$var[$i]['accountNumber']=$par_2; 
                  $var[$i]['sol']='1101'; 
			$var[$i]['accountHolderName'][0]= ucwords(strtolower('BBL')); 	
			$var[$i]['schemeType'][0]= 'SBA'; 
			$var[$i]['loanType'][0]= 'TL'; 
			$var[$i]['accountCifType'][0]= 'R'; 
                  $var[$i]['dis_date'][0]= '28-09-2018'; 
                  $var[$i]['corp_id'][0]= '800000'; 
                  $var[$i]['dis_amt'][0]= '800000'; 
                  $var[$i]['lastAnyTrnDate'][0]= '28-09-2014'; 
                  $var[$i]['mobileNo']='01727390673';
                  $var[$i]['schmDesc']='APURBO LOAN -EMI - SME';
                  $var[$i]['acctClsStatus']='Y';

                  $i++;
                  $var[$i]['accountNumber']=$par_2; 
                  $var[$i]['sol']='1101';
                  $var[$i]['accountHolderName'][0]= ucwords(strtolower('BBL'));     
                  $var[$i]['schemeType'][0]= 'SBA'; 
                  $var[$i]['loanType'][0]= 'TL'; 
                  $var[$i]['accountCifType'][0]= 'R'; 
                  $var[$i]['dis_date'][0]= '28-09-2018'; 
                  $var[$i]['corp_id'][0]= '800000'; 
                  $var[$i]['dis_amt'][0]= '800000'; 
                  $var[$i]['lastAnyTrnDate'][0]= '28-09-2014'; 
                  $var[$i]['mobileNo']='01727390673';
                  $var[$i]['schmDesc']='APURBO LOAN -EMI - SME';
                  $var[$i]['acctClsStatus']='Y';
			return $var;
		}
		if($method=='GetGurantorDetailsByLoanAC' && $live_dev=='liv')
		{
			if ($par_2=='SBA' || $par_2=='LAA') 
			{
				$xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/1_c_2_ac_loan_and_guarantors/LoanAcctInq.xml");
				$xml->Body->LoanAcctInqRequest->LoanAcctInqRq->LoanAcctId->AcctId = $par_1;
			}
			else if($par_2=='CAA')
			{
				$xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/1_c_2_ac_loan_and_guarantors/Request_CAAcctInq_Inquiry.xml");
				$xml->Body->CAAcctInqRequest->CAAcctInqRq->CAAcctId->AcctId = $par_1;
			}
			else
			{
				$xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/1_c_2_ac_loan_and_guarantors/ODAcctInq.xml");
				$xml->Body->ODAcctInqRequest->ODAcctInqRq->ODAcctId->AcctId = $par_1;
			}
			$request = $xml->asXML (); // convert to well-formed XML output
                  //echo $request;
                  $header[0] = "Host: fin10xtestj2ee.bracbank.com";

                  //$header[0] = "Host: localhost";
                  $header[1] = "Content-type: text/xml";
                  $header[2] = "Content-length: ".strlen ($request)."\r\n";
                  $header[3] = $request;

                  //$data = array('key'=>'value');
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
      		curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
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
                  //curl_setopt ($ch, CURLOPT_HTTPHEADER, $header); // send header
                  //$result = curl_exec ($ch); // returned XML server result
                  //curl_close ($ch);
                   
                  $response = curl_exec($ch);
                  //$info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
                  //print_r($info);
                  curl_close($ch);
                  $xml_result = simplexml_load_string ($response );
                  $i=1;
                  foreach ($xml_result->Body->LoanAcctInqResponse->LoanAcctInqRs->RelPartyRec as $key) 
                  {
                  	// if($key->RelPartyType=='M'){ continue; }
      				
				if (is_object($key->RelPartyType) && $key->RelPartyType!=''){
            		$var[$i]['type']=$key->RelPartyType;
                  	}else{$var[$i]['type'][0]='';}
                  	if (is_object($key->CustId->CustId) && $key->CustId->CustId!=''){
                  		$var[$i]['cust_id']=$key->CustId->CustId;
                  	}else{$var[$i]['cust_id'][0]='';}
                  	if (is_object($key->CustId->PersonName->Name) && $key->CustId->PersonName->Name!=''){
                  		$var[$i]['name']=ucwords(strtolower($key->CustId->PersonName->Name));
                  	}else{$var[$i]['name'][0]='';}
                  	if (is_object($key->RelPartyContactInfo->PostAddr->Addr1) && $key->RelPartyContactInfo->PostAddr->Addr1!=''){
                  		$var[$i]['add']=$key->RelPartyContactInfo->PostAddr->Addr1;
                  	}else{$var[$i]['add'][0]='';}
                  	$i++;
                  }
      			return $var;
      	}
		if($method=='GetGurantorDetailsByLoanAC' && $live_dev=='dev')
		{
      			
                  $var[1]['type'][0]='G';
              	$var[1]['cust_id'][0]='100001';
              	$var[1]['name'][0]='Nur Nahar';
              	$var[1]['add'][0]='Dhaka';
                  $var[2]['type'][0]='M';
                  $var[2]['cust_id'][0]='100001';
                  $var[2]['name'][0]='Nur Nahar';
                  $var[2]['add'][0]='Dhaka';
      		return $var;
      	}
		if ($method=='GetGuarantorFatherInfoByCif' && $live_dev=='liv') 
		{
      		$xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/1_c_3_cif_customer_guarantors_details/Request_RetCustInq_Inquiry.xml");
                  // set some XML attributes (mark the request with the date/time)
                  $xml->attributes ()->timestamp = date ("Y-m-d H:i:s");
                  // obtain and set all information necessary for order data transfer
                  // may need htmlspecialchars(utf8_encode($var)) for text with &, <, >
                  // if encoding requires it and if it's not automated by simplexml version
                  $xml->Body->RetCustInqRequest->RetCustInqRq->CustId = $par_1;

                  $request = $xml->asXML (); // convert to well-formed XML output
                  //echo $request;
                  $header[0] = "Host: fin10xtestj2ee.bracbank.com";

                  //$header[0] = "Host: localhost";
                  $header[1] = "Content-type: text/xml";
                  $header[2] = "Content-length: ".strlen ($request)."\r\n";
                  $header[3] = $request;

                  //$data = array('key'=>'value');
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
      		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
      		curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
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
                  //curl_setopt ($ch, CURLOPT_HTTPHEADER, $header); // send header
                  //$result = curl_exec ($ch); // returned XML server result
                  //curl_close ($ch);
                   
                  $response = curl_exec($ch);
                 // $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
                  //print_r($info);
                  curl_close($ch);
                  $xml_result = simplexml_load_string ($response );
                  $var[1]['mother_name'][0]=ucwords(strtolower($xml_result->Body->RetCustInqResponse->RetCustInq_CustomData->StrUserField3));
                 	$var[1]['father_name'][0]=ucwords(strtolower($xml_result->Body->RetCustInqResponse->RetCustInq_CustomData->StrUserField2));
                  $var[1]['spouse_name'][0]=ucwords(strtolower($xml_result->Body->RetCustInqResponse->RetCustInq_CustomData->StrUserField7));
                 	$var[1]['cust_type'][0]=$xml_result->Body->RetCustInqResponse->RetCustInqRs->RetCustDtls->CustType;
                 	$var[1]['designation'][0]=$xml_result->Body->RetCustInqResponse->RetCustInqRs->RetCustDtls->Designation;
                 	$var[1]['Occupation'][0]=$xml_result->Body->RetCustInqResponse->RetCustInqRs->RetCustDtls->Occupation;
                 	$i=1;
                 	foreach ($xml_result->Body->RetCustInqResponse->RetCustInqRs->RetCustDtls->RetCustAddrInfo as $key) 
                  {
                  	if ($key->AddrCategory=='PRESENT' || $key->AddrCategory=='Mailing') //Present Address
                  	{
                  		$var[1]['present_address1'][0]=$key->AddrLine1;
                  		$var[1]['present_address2'][0]=$key->AddrLine2;
                              $var[1]['present_address3'][0]=$key->AddrLine3;
                              $var[1]['present_address_city'][0]=$key->City;
                              $var[1]['present_address_country'][0]=$key->Country;
                  	}
                  	if ($key->AddrCategory=='Home') //Parmanent Address
                  	{
                  		$var[1]['parmanent_address1'][0]=$key->AddrLine1;
                  		$var[1]['parmanent_address2'][0]=$key->AddrLine2;
                              $var[1]['parmanent_address3'][0]=$key->AddrLine3;
                              $var[1]['parmanent_address_city'][0]=$key->City;
                              $var[1]['parmanent_address_country'][0]=$key->Country;
                  	}
                  	if ($key->AddrCategory=='Work') //Business address
                  	{
                  		$var[1]['business_address1'][0]=$key->AddrLine1;
                  		$var[1]['business_address2'][0]=$key->AddrLine2;
                              $var[1]['business_address3'][0]=$key->AddrLine3;
                              $var[1]['business_address_city'][0]=$key->City;
                              $var[1]['business_address_country'][0]=$key->Country;
                  	}
                  	$i++;
                  }
      		return $var;
      	}
		if ($method=='GetGuarantorFatherInfoByCif' && $live_dev=='dev') 
		{
                  $var[1]['mother_name'][0]='mother name';
                  $var[1]['father_name'][0]='father name';
                  $var[1]['spouse_name'][0]='spouse name';
                  $var[1]['present_address1'][0]='present address';
                  $var[1]['present_address2'][0]='present addresss';
                  $var[1]['present_address_city'][0]='04';
                  $var[1]['present_address_country'][0]='0004';
                  $var[1]['parmanent_address1'][0]='parmanent address';
                  $var[1]['parmanent_address2'][0]='parmanent address';
                  $var[1]['parmanent_address_city'][0]='04';
                  $var[1]['parmanent_address_country'][0]='0004';
                  $var[1]['business_address1'][0]='business address';
                  $var[1]['business_address2'][0]='business address';
                  $var[1]['business_address_city'][0]='04';
                  $var[1]['business_address_country'][0]='0004';
                  $var[1]['cust_type'][0]='PSUG';
                 	$var[1]['designation'][0]='ADMN';
                 	$var[1]['Occupation'][0]='DIRBK';
      		return $var;
      	}
            if ($method=='GetGuarantorFatherInfocorporateByCif' && $live_dev=='liv') 
            {
                  $xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/1_c_3_cif_customer_guarantors_details/Request_getCorporateCustomerDetails_Inquiry.xml");
                  // set some XML attributes (mark the request with the date/time)
                  $xml->attributes ()->timestamp = date ("Y-m-d H:i:s");
                  // obtain and set all information necessary for order data transfer
                  // may need htmlspecialchars(utf8_encode($var)) for text with &, <, >
                  // if encoding requires it and if it's not automated by simplexml version
                  $xml->Body->getCorporateCustomerDetailsRequest->CustomerDetailsInput->cifId = $par_1;

                  $request = $xml->asXML (); // convert to well-formed XML output
                  //echo $request;
                  $header[0] = "Host: fin10xtestj2ee.bracbank.com";

                  //$header[0] = "Host: localhost";
                  $header[1] = "Content-type: text/xml";
                  $header[2] = "Content-length: ".strlen ($request)."\r\n";
                  $header[3] = $request;

                  //$data = array('key'=>'value');
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
                  curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
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
                  //curl_setopt ($ch, CURLOPT_HTTPHEADER, $header); // send header
                  //$result = curl_exec ($ch); // returned XML server result
                  //curl_close ($ch);
                   
                  $response = curl_exec($ch);
                 // $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
                  //print_r($info);
                  curl_close($ch);
                  $xml_result = simplexml_load_string ($response );
                  $var[1]['mother_name'][0]='';
                  $var[1]['father_name'][0]='';
                  $var[1]['spouse_name'][0]='';
                  $var[1]['cust_type'][0]='';
                  $var[1]['designation'][0]='';
                  $var[1]['Occupation'][0]='';
                  $i=1;
                  foreach ($xml_result->Body->getCorporateCustomerDetailsResponse->CorporateCustomerDetails->corpDet->corpaddresDet as $key) 
                  {
                        if ($key->addresscategory=='Mailing') //Present Address
                        {
                              $var[1]['present_address1'][0]=$key->address_line1;
                              $var[1]['present_address2'][0]=$key->address_line2;
                              $var[1]['present_address3'][0]=$key->address_line3;
                              $var[1]['present_address_city'][0]=$key->city;
                              $var[1]['present_address_country'][0]=$key->country;
                        }
                        if ($key->addresscategory=='Head Office') //Parmanent Address
                        {
                              $var[1]['parmanent_address1'][0]=$key->address_line1;
                              $var[1]['parmanent_address2'][0]=$key->address_line2;
                              $var[1]['parmanent_address3'][0]=$key->address_line3;
                              $var[1]['parmanent_address_city'][0]=$key->city;
                              $var[1]['parmanent_address_country'][0]=$key->country;
                        }
                        if ($key->addresscategory=='Registered') //Business address
                        {
                              $var[1]['business_address1'][0]=$key->address_line1;
                              $var[1]['business_address2'][0]=$key->address_line2;
                              $var[1]['business_address3'][0]=$key->address_line3;
                              $var[1]['business_address_city'][0]=$key->city;
                              $var[1]['business_address_country'][0]=$key->country;
                        }
                        $i++;
                  }
                  return $var;
            }
            if ($method=='GetGuarantorFatherInfocorporateByCif' && $live_dev=='dev') 
            {
                  $var[1]['mother_name'][0]='';
                  $var[1]['father_name'][0]='';
                  $var[1]['spouse_name'][0]='';
                  $var[1]['present_address1'][0]='present address';
                  $var[1]['present_address2'][0]='present addresss';
                  $var[1]['present_address_city'][0]='04';
                  $var[1]['present_address_country'][0]='0004';
                  $var[1]['parmanent_address1'][0]='parmanent address';
                  $var[1]['parmanent_address2'][0]='parmanent address';
                  $var[1]['parmanent_address_city'][0]='04';
                  $var[1]['parmanent_address_country'][0]='0004';
                  $var[1]['business_address1'][0]='business address';
                  $var[1]['business_address2'][0]='business address';
                  $var[1]['business_address_city'][0]='04';
                  $var[1]['business_address_country'][0]='0004';
                  $var[1]['cust_type'][0]='';
                  $var[1]['designation'][0]='';
                  $var[1]['Occupation'][0]='';
                  return $var;
            }
		if ($method=='GetFacilityDetailsByCifAndLoanAc' && $live_dev=='liv') 
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
			                    <v11:password>'.$password.'</v11:password>
			                    <v11:channelName>'.$channel.'</v11:channelName>
			                    <v11:channelCode>'.$channel.'</v11:channelCode>
			                    <v11:globalTransactionId>Req_1456378980963</v11:globalTransactionId>
			                </v1:header>
			                <v1:loginid/>
			                <v1:cif>'.$par_2.'</v1:cif>
			                <v1:accountNumber>'.$par_1.'</v1:accountNumber>
			                <v1:callType>DETAILS</v1:callType>
			            </v1:loanListAndDetail>
			        </v1:loanListAndDetails>
			    </soapenv:Body>
			</soapenv:Envelope>';
			
			//$url_loan_d_cif='https://172.25.0.5:4444/UBA/LoanListAndDetails/V1?wsdl';
			$url_loan_d_cif='https://esb.bracbank.com:4444/UBA/LoanListAndDetails/V1?wsdl';

			$soap_do = curl_init();
			curl_setopt($soap_do, CURLOPT_URL,$url_loan_d_cif);
			//curl_setopt($soap_do, CURLOPT_HTTPHEADER, array("Content-Type: text/xml","SOAPAction: \"/soap/action/query\"", "Content-length: ".strlen($envelope))); 
			curl_setopt($soap_do, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
			curl_setopt($soap_do, CURLOPT_FRESH_CONNECT, TRUE);

			curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);

			

			curl_setopt($soap_do, CURLOPT_POST, 1);
			curl_setopt($soap_do, CURLOPT_ENCODING, "");
			curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($soap_do, CURLOPT_POST,           true );            
			curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $envelope); 
			curl_setopt($soap_do, CURLOPT_VERBOSE, TRUE); 
			$result = curl_exec($soap_do);

			//$info =curl_errno($soap_do)>0 ? array("curl_error_".curl_errno($soap_do)=>curl_error($soap_do)) : curl_getinfo($soap_do);
			//print_r($info);
			curl_close($soap_do);
			//echo $result ;
			$xml = simplexml_load_string($result);
			$xml->registerXPathNamespace('ns2', 'http://bracbank.com/UBALoanListAndDetailsES/V1');
			$nodelist = $xml->xpath('//ns2:fetchLoanListAndDetailsRespDetail/ns2:loanAccountDetails/ns2:loanAccountDetail');
			$i=1;
			$j=0;
			foreach($nodelist as $head)
			{   
                        $tenureMonths=$head->xpath('//ns2:tenureMonths');   
                        $var[$i]['tenureMonths']= $tenureMonths[$j];
				$accountNumber=$head->xpath('//ns2:accountNumber');	
				$var[$i]['accountNumber']= $accountNumber[$j];
				$loanOpeningDate=$head->xpath('//ns2:loanOpeningDate');	
				$var[$i]['loanOpeningDate']= $loanOpeningDate[$j];
				$overdueAmount=$head->xpath('//ns2:overdueAmount');	
				$var[$i]['overdueAmount']= $overdueAmount[$j];
				$loanBalance=$head->xpath('//ns2:loanBalance');	
				$var[$i]['loanBalance']= $loanBalance[$j];
				$nextPaymentDate=$head->xpath('//ns2:nextPaymentDate');	
				$var[$i]['nextPaymentDate']= $nextPaymentDate[$j];
				$loanInterestRate=$head->xpath('//ns2:loanInterestRate');	
				$var[$i]['loanInterestRate']= $loanInterestRate[$j];
				$numberOfTotalInstallments=$head->xpath('//ns2:numberOfTotalInstallments');	
				$var[$i]['numberOfTotalInstallments']= $numberOfTotalInstallments[$j];
				$numberOfRemainingInstallments=$head->xpath('//ns2:numberOfRemainingInstallments');	
				$var[$i]['numberOfRemainingInstallments']= $numberOfRemainingInstallments[$j];
				$firstInstallmentDate=$head->xpath('//ns2:firstInstallmentDate');	
				$var[$i]['firstInstallmentDate']= $firstInstallmentDate[$j];
				$lastInstallmentDate=$head->xpath('//ns2:lastInstallmentDate');	
				$var[$i]['lastInstallmentDate']= $lastInstallmentDate[$j];
				$installmentAmount=$head->xpath('//ns2:installmentAmount');	
				$var[$i]['installmentAmount']= $installmentAmount[$j];
				$totalLimit=$head->xpath('//ns2:totalLimit');	
				$var[$i]['totalLimit']= $totalLimit[$j];
				$oustandingAmount=$head->xpath('//ns2:oustandingAmount');	
				$var[$i]['oustandingAmount']= $oustandingAmount[$j];
				$expiryDate=$head->xpath('//ns2:expiryDate');	
				$var[$i]['expiryDate']= $expiryDate[$j];
				$remainingInterestAmount=$head->xpath('//ns2:remainingInterestAmount');	
				$var[$i]['remainingInterestAmount']= $remainingInterestAmount[$j];
				$i++;
				$j++;
			}
			return $var;

		}
		if ($method=='GetFacilityDetailsByCifAndLoanAc' && $live_dev=='dev') 
		{
			$i=1;
                  $var[$i]['tenureMonths'][0]= '2';
			$var[$i]['accountNumber'][0]= '1111111111111111';
			$var[$i]['loanOpeningDate'][0]= '2001-12-31T00:00:00.000';	
			$var[$i]['nextPaymentDate'][0]= '2001-12-31T00:00:00.000';	
			$var[$i]['numberOfRemainingInstallments'][0]= '12';
			$var[$i]['remainingInterestAmount'][0]= '12,000';
			$var[$i]['overdueAmount'][0]= '12,000';
			$var[$i]['loanBalance'][0]= '12,000';
			$var[$i]['nextPaymentDate'][0]= '2001-12-31T00:00:00.000';		
			$var[$i]['loanInterestRate'][0]= '3.00';
			$var[$i]['numberOfTotalInstallments'][0]= 2;
			$var[$i]['firstInstallmentDate'][0]= '2001-12-31T00:00:00.000';	
			$var[$i]['lastInstallmentDate'][0]= '2001-12-31T00:00:00.000';
			$var[$i]['installmentAmount'][0]= '12,000';	
			$var[$i]['totalLimit'][0]= '12,000';
			$var[$i]['oustandingAmount'][0]= '12,000';	
			$var[$i]['expiryDate'][0]= '2001-12-31T00:00:00.000';

                  $i++;
                  $var[$i]['tenureMonths'][0]= '2';
                  $var[$i]['accountNumber'][0]= '1111111111111111';
                  $var[$i]['loanOpeningDate'][0]= '2001-12-31T00:00:00.000';  
                  $var[$i]['nextPaymentDate'][0]= '2001-12-31T00:00:00.000';  
                  $var[$i]['numberOfRemainingInstallments'][0]= '12';
                  $var[$i]['remainingInterestAmount'][0]= '12,000';
                  $var[$i]['overdueAmount'][0]= '12,000';
                  $var[$i]['loanBalance'][0]= '12,000';
                  $var[$i]['nextPaymentDate'][0]= '2001-12-31T00:00:00.000';        
                  $var[$i]['loanInterestRate'][0]= '3.00';
                  $var[$i]['numberOfTotalInstallments'][0]= 2;
                  $var[$i]['firstInstallmentDate'][0]= '2001-12-31T00:00:00.000';   
                  $var[$i]['lastInstallmentDate'][0]= '2001-12-31T00:00:00.000';
                  $var[$i]['installmentAmount'][0]= '12,000';     
                  $var[$i]['totalLimit'][0]= '12,000';
                  $var[$i]['oustandingAmount'][0]= '12,000';      
                  $var[$i]['expiryDate'][0]= '2001-12-31T00:00:00.000';
			return $var;

		}
            if ($method=='SendSms' && $live_dev=='liv') 
            {
                  $envelope = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmln
                        s:v1="http://bracbank.com/UBASendNotificationES/V1" xmlns:v11="http://bracbank.c
                        om/utilityCommon/V1">
                        <soapenv:Header/>
                        <soapenv:Body>
                        <v1:sendNotification>
                        <v1:sendNotificationDetails>
                        <v1:header>
                        <v11:serviceId>004</v11:serviceId>
                        <v11:serviceName>SendNotification</v11:serviceName>
                        <v11:sourceTimestamp>2020-04-
                        03T07:49:45</v11:sourceTimestamp>
                        <v11:password>'.$password.'</v11:password>
                        <v11:channelName>'.$channel.'</v11:channelName>
                        <v11:channelCode>'.$channel.'</v11:channelCode>
                        <v11:globalTransactionId>LMS0435294620210303030</v11:globalT
                        ransactionId>
                        </v1:header>
                        <v1:cif></v1:cif>
                        <v1:mobileNumber>'.$par_1.'</v1:mobileNumber>
                        <v1:smsCode>53</v1:smsCode>
                        <v1:costCenter>3456778</v1:costCenter>
                        <v1:smsTemplate>'.$par_2.'</v1:smsTemplate>
                        <v1:smsRemarks>Send Notification From LMS</v1:smsRemarks>
                        <v1:accountOrCardNumber></v1:accountOrCardNumber>
                        </v1:sendNotificationDetails>
                        </v1:sendNotification>
                        </soapenv:Body>
                        </soapenv:Envelope>';
                  
                  //$url_loan_d_cif='https://172.25.0.5:4444/UBA/LoanListAndDetails/V1?wsdl';
                  $url_loan_d_cif='https://esb.bracbank.com:4444/UBA/SendNotification/V1?wsdl';

                  $soap_do = curl_init();
                  curl_setopt($soap_do, CURLOPT_URL,$url_loan_d_cif);
                  //curl_setopt($soap_do, CURLOPT_HTTPHEADER, array("Content-Type: text/xml","SOAPAction: \"/soap/action/query\"", "Content-length: ".strlen($envelope))); 
                  curl_setopt($soap_do, CURLOPT_HTTPHEADER, array("Cache-Control: no-cache"));
                  curl_setopt($soap_do, CURLOPT_FRESH_CONNECT, TRUE);

                  curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
                  curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);

                  

                  curl_setopt($soap_do, CURLOPT_POST, 1);
                  curl_setopt($soap_do, CURLOPT_ENCODING, "");
                  curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
                  curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
                  curl_setopt($soap_do, CURLOPT_POST,           true );            
                  curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $envelope); 
                  curl_setopt($soap_do, CURLOPT_VERBOSE, TRUE); 
                  $result = curl_exec($soap_do);

                  //$info =curl_errno($soap_do)>0 ? array("curl_error_".curl_errno($soap_do)=>curl_error($soap_do)) : curl_getinfo($soap_do);
                  //print_r($info);
                  curl_close($soap_do);
                  //echo $result ;
                  $xml = simplexml_load_string($result);
                  $xml->registerXPathNamespace('ns1', 'http://bracbank.com/UBASendNotificationES/V1');
                  $nodelist = $xml->xpath('//ns1:sendNotificationRespDetails');
                  $j=0;
                  foreach($nodelist as $head)
                  {   
                        $message=$head->xpath('//ns1:errorCode');   
                        $var['message']= $message[$j];
                  }
                  return $var;

            }
            if ($method=='SendSms' && $live_dev=='dev') 
            {
                  $i=1;
                  $var['message'][0]= '000';
                  return $var;

            }
            if ($method=='GetStatementDetails' && $live_dev=='dev') 
            {
                  $i=1;
                  $var[$i]['date'][0]= '12/27/2005';
                  $var[$i]['particulars'][0]= 'SME CLD to Rojoni Hosiary of Pabna thr PBL File# 24178';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '200000';  
                  $var[$i]['deposit_amount'][0]= '';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'w';
                  $i++;
                  $var[$i]['date'][0]= '12/31/2005';
                  $var[$i]['particulars'][0]= 'Interest';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '666.67';  
                  $var[$i]['deposit_amount'][0]= '';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'w';
                  $i++;
                  $var[$i]['date'][0]= '1/25/2006';
                  $var[$i]['particulars'][0]= 'Ins Paid By Rojoni Hosiary 90363687 of Pabna thr PBL';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '';  
                  $var[$i]['deposit_amount'][0]= '13400';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'd';
                  $i++;
                  $var[$i]['date'][0]= '1/31/2006';
                  $var[$i]['particulars'][0]= 'Interest';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '4084.58';  
                  $var[$i]['deposit_amount'][0]= '';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'w';
                  $i++;
                  $var[$i]['date'][0]= '2/27/2006';
                  $var[$i]['particulars'][0]= 'Ins paid by Rojoni Hosiary 150190363687 of Pabna thr PBL(Rls.dt.26-02-06)';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '';  
                  $var[$i]['deposit_amount'][0]= '13400';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'd';
                  $i++;
                  $var[$i]['date'][0]= '2/28/2006';
                  $var[$i]['particulars'][0]= 'Interest';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '3554.02';  
                  $var[$i]['deposit_amount'][0]= '';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'w';
                  $i++;
                  $var[$i]['date'][0]= '3/27/2006';
                  $var[$i]['particulars'][0]= 'Ins paid by Rojoni Hosiary 150190363687 of Pabna thr PBL';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '';  
                  $var[$i]['deposit_amount'][0]= '13400';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'd';
                  $i++;
                  $var[$i]['date'][0]= '3/31/2006';
                  $var[$i]['particulars'][0]= 'Interest';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '3706.44';  
                  $var[$i]['deposit_amount'][0]= '';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'w';
                  $i++;
                  $var[$i]['date'][0]= '4/27/2006';
                  $var[$i]['particulars'][0]= 'Ins paid by Rojoni Hosiary 90363687 of Pabna thr PBL';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '';  
                  $var[$i]['deposit_amount'][0]= '13400';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'd';
                  $i++;
                  $var[$i]['date'][0]= '4/30/2006';
                  $var[$i]['particulars'][0]= 'Interest';
                  $var[$i]['int_amount'][0]= '';  
                  $var[$i]['withdraw_amount'][0]= '3400.5';  
                  $var[$i]['deposit_amount'][0]= '';
                  $var[$i]['belance'][0]= '';
                  $var[$i]['sts'][0]= 'w';
                  $i++;
                  return $var;

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
