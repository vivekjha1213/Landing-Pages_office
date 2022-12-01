<?php
if(isset($_REQUEST['msisdn'])&&isset($_REQUEST['pin']))
{
    $msisdn=$_REQUEST['msisdn'];
    $pin=$_REQUEST['pin'];
    $cid=$_REQUEST['cid'];
    launcher($msisdn,$pin,$cid);
}
function aes128Encrypt($key, $data)
{
    if (16 !== strlen($key)) $key = hash('MD5', $key, true);
    $padding = 16 - (strlen($data) % 16);
    $data .= str_repeat(chr($padding), $padding);
    return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_ECB, str_repeat("\0", 16)));
}

function launcher($msisdn,$pin,$clickid) {
    include("connect.php");
	$msisdn=$msisdn;
	$otp=$pin;
	$clickid=$clickid;
    include("connect.php");
    $date=date('Y-m-d h:i:s');
    $fp=fopen("pin_verify".date("Y-m-d"),"a");
    fwrite($fp,"\n[$date]  Inside the launcher function MSISDN  $msisdn , otp $otp and clickid $clickid\n");
	if ($otp != '') {
        $default_timeZone1 = date("Y-m-d H:i:s");
        $trackingid = rand(1, 234567891011121557);
        $external_id = rand(1, 23456789101112155);
		//for authentication parameter
		date_default_timezone_set('UTC');
		$default_timeZone = date();
		$unix_time = date('Ymdhis', strtotime($default_timeZone)); 
		$key1 = "0dDivO0AB8ypZFMK";
		$timestamp = $unix_time;
		$plaintext = '3575#' . $timestamp;
        //$plaintext = '17788#' . $timestamp;
        $authen = aes128Encrypt($key1, $plaintext);

        $headers2 = array();
        $headers2[0] = "apikey:4f3c8be4591246e3b63ffa606a748bd9";
        $headers2[1] = "external-tx-id:" . $external_id;
        $headers2[2] = "authentication:" . $authen;
        $headers2[3] = "Content-type: application/json";

        $arrayData['userIdentifier'] =$msisdn;
        $arrayData['userIdentifierType'] = "MSISDN";
        $arrayData['catalogId'] ="39";
        $arrayData['mcc'] ="420";
        $arrayData['mnc'] ="01";
        //$arrayData['entryChannel'] = "WEB";
        //$arrayData['clientIP'] ="";
        $arrayData['transactionAuthCode'] =$otp;
        $content = json_encode($arrayData);

        $url = "https://unified-ma.timwetech.com/mea/subscription/optin/confirm/3652";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        curl_close($curl);

        $json_response1 = json_decode($json_response);
        $message = $json_response1->message;
        $inError = $json_response1->inError;
        $requestId = $json_response1->requestId;
        $code = $json_response1->code;
        $transactionId = $json_response1->responseData->transactionId;
        $externalTxId = $json_response1->responseData->externalTxId;
        $subscriptionResult = $json_response1->responseData->subscriptionResult;
        $subscriptionError = $json_response1->responseData->subscriptionError;
        $subscriptionError1 = urldecode("$subscriptionError");
        //$otp = $_GET['otp'];
		fwrite($fp,"\n[$date]  hitting the api $url with payload $content and receieved $json_response\n");
		

        $json_response1 = json_decode($json_response, TRUE);
        $message = $json_response1['code'];
        $subscriptionResult = $json_response1['responseData']['subscriptionResult'];
        $subscriptionError = $json_response1['responseData']['subscriptionError'];
		
		//TABLE ADDED BY RAJENDRA
        date_default_timezone_set('Asia/Kolkata');
        $time_india = date('Y-m-d H:i:s');
        date_default_timezone_set('Asia/Riyadh');
        $date_saudi_arabia = date('Y-m-d H:i:s');
		$sql_subscription = "INSERT INTO `funzstation_timwe_ksa_stc_pin_verify`(`cid`, `msisdn`, `subscriptionResult`, `message`,`date_india`,`date_saudi_arabia`) VALUES ('$clickid', '$msisdn', '$subscriptionResult', '$message','$date_india','$date_saudi_arabia')";
        mysql_query($sql_subscription);
        fwrite($fp,"\n[$date]  received MSISDN  $msisdn1 query $sql_subscription is triggered\n");
		//TABLE CLOSED BY RAJENDRA
		if ($subscriptionResult == "OPTIN_WAIT_FOR_ACTIVE_AND_CHARGING") {
				$status=0;
				$message='Successfull Pin verification';
                fwrite($fp,"\n[$date]  for this $msisdn1 the following status $status and message $message is received\n");
				$output = array('status'=>$status,
								'errorMessage'=>$message,
								);
                //ADDED BY RAJENDRA ON 04-06-2021
                $result=file_get_contents('http://beyondhealth.info/Services/Filter/chk.php?id=19&op=FUNZSTATION_STC_ZA');
                if($result==0)//MEANS PASS
                {
                    //Callback for offer 18 opened
                    $digi_tid_url2 = "http://df3.o18.click/p?mid=1395&auth_token=43643&tid=".$clickid;
                    $digi_tid_ch2 = curl_init(); 
                    curl_setopt($digi_tid_ch2, CURLOPT_URL, $digi_tid_url2); 
                    curl_setopt($digi_tid_ch2, CURLOPT_RETURNTRANSFER, 1); 
                    $digi_tid_output2 = curl_exec($digi_tid_ch2); 
                    curl_close($digi_tid_ch2);
                    //Callback for offer 18 closed
                
                }
                send_message($msisdn,$clickid);               			
				echo json_encode($output, JSON_PRETTY_PRINT);
				exit();
        } else if ($subscriptionResult == "OPTIN_CONF_WRONG_PIN") {
				$status=1;
				$message='Wrong Pin try again (OTP خاطئ حاول مرة أخرى)';
                fwrite($fp,"\n[$date]  for this $msisdn1 the following status $status and message $message is received\n");
				$output = array('status'=>$status,
								'errorMessage'=>$message,
								);			
				echo json_encode($output, JSON_PRETTY_PRINT);
				exit();
        } else {
				$status=2;
				$message=$subscriptionResult;
				$output = array('status'=>$status,
								'errorMessage'=>$message,
								);	
                fwrite($fp,"\n[$date]  for this $msisdn1 the following status $status and message $message is received\n");                		
				echo json_encode($output, JSON_PRETTY_PRINT);
				exit();
        }

    }
}

function send_message($msisdn,$clickid)
{
        $date=date('Y-m-d h:i:s');
        $fp=fopen("pin_verify".date("Y-m-d"),"a");
        fwrite($fp,"\n[$date]  Inside the send_message block and the msisdn is $msisdn and clickid is $clickid\n");
        $default_timeZone1 = date("Y-m-d H:i:s");
        $trackingid = rand(1, 234567891011121557);
        $external_id = rand(1, 23456789101112155);
        //for authentication parameter
        date_default_timezone_set('UTC');
        $default_timeZone = date();
        $unix_time = date('Ymdhis', strtotime($default_timeZone)); 
        $key1 = "GgXMw4i4hte01VYo";
        $timestamp = $unix_time;
        $plaintext = '17788#' . $timestamp;
        $authen = aes128Encrypt($key1, $plaintext);

        $headers2 = array();
        $headers2[0] = "apikey:12320e2141c34c7b94f117b8d03febde";
        $headers2[1] = "external-tx-id:" . $external_id;
        $headers2[2] = "authentication:" . $authen;
        $headers2[3] = "Content-type: application/json";

        //$arrayData['userIdentifier'] = $msisdn;
        //$arrayData['userIdentifierType'] = "MSISDN";
        $Message="You have been subscribed in Funzstation for 3 days free trial after that 1 SR /Daily.To use service, go to URL http://funzstation.com/saudi_arabia/ .To cancel your subscription, for STC Saudi Arabia subscribers please send STOP FUNZ to 801471 .For any inquires please contact us on support@arshiyainfosolutions.com.";
        $arrayData['catalogId'] ="39";
        $arrayData['pricepointId']="52399";
        $arrayData['mcc'] = "420";
        $arrayData['mnc'] = "01";
        $arrayData['text']=$Message;
        $arrayData['msisdn']=$msisdn;
        //$arrayData['largeAccount']="709222";
        //$arrayData['priority']="NORMAL";
        //$arrayData['timezone']="Asia/Riyadh";
        $arrayData['context']="STATELESS";
        //$arrayData['mtType'] = "WAP";
        //$arrayData['clientIP'] = "";
        //$arrayData['transactionAuthCode'] =$otp;
        //$content = json_encode($arrayData);
        $content=json_encode($arrayData,JSON_UNESCAPED_SLASHES+JSON_UNESCAPED_UNICODE);//Concept learned In Tpay Integration
        
		
		$url = "https://unified-ma.timwetech.com/mea/SMS/send/mt/3652";
		
		//msisdn logic
		
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);
        curl_close($curl);
        $json_response1 = json_decode($json_response);
        fwrite($fp,"\n[$date]  Inside the send_message block msisdn $msisdn hitted the $url with $content and received the output $json_response\n");

}

?>