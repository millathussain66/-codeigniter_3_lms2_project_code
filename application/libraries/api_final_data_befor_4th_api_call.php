<?php
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
                <v1:cif>03079789</v1:cif>
                <v1:accountNumber>1501603079789004</v1:accountNumber>
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
//echo "<br/>";
$xml_result = simplexml_load_string ($result); // obtain XML server result
//echo $xml_result;
$xml = simplexml_load_string ($result);
            $xml->registerXPathNamespace('ns2', 'http://bracbank.com/UBALoanListAndDetailsES/V1');
            $nodelist = $xml->xpath('//ns2:fetchLoanListAndDetailsRespDetail/ns2:loanAccountDetails/ns2:loanAccountDetail');
            foreach($nodelist as $head)
            {   
                    $accountNumber=$head->xpath('//ns2:accountNumber'); 
                    $var['accountNumber'] = $accountNumber[0]; 
                    $accountHolderName=$head->xpath('//ns2:accountHolderName');
                    $var['accountHolderName'] = $accountHolderName[0];  
                    $schemeType=$head->xpath('//ns2:schemeType');
                    $var['schemeType'] = $schemeType[0];
                    //$this->load->helper('form');
                    // load XML client request template
                    $xml = simplexml_load_file ("/app/lms/api_templates/cbsapi/1_c_2_ac_loan_and_guarantors/LoanAcctInq.xml");
                    
                    // set some XML attributes (mark the request with the date/time)
                    //$xml->attributes ()->timestamp = date ("Y-m-d H:i:s");
                    // obtain and set all information necessary for order data transfer
                    // may need htmlspecialchars(utf8_encode($var)) for text with &, <, >
                    // if encoding requires it and if it's not automated by simplexml version
                    $xml->Body->LoanAcctInqRequest->LoanAcctInqRq->LoanAcctId->AcctId = $accountNumber[0];

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
                    //print_r($info);
                    curl_close($ch);
                    $xml_result = simplexml_load_string ($response ); // obtain XML server result
                    //echo $xml_result->Body->LoanAcctInqResponse->LoanAcctInqRs->RelPartyRec->CustId->CustId;
                    foreach ($xml_result->Body->LoanAcctInqResponse->LoanAcctInqRs->RelPartyRec as $key) 
                    {
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
                        //print_r($info);
                        curl_close($ch);
                        $xml_result = simplexml_load_string ($response );
                        echo $xml_result->Body->RetCustInqResponse->RetCustInqRs->RetCustDtls->BirthDt;
                        echo "<br/>";
                    }
                    }
            }
?>