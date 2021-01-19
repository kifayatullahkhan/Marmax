<?php
if (!isset($_SESSION)) {
	@session_start();	
}
// Initial These Variables;
 	 $BillingFirstName				=isset($_SESSION['BillingFirstName'])?$_SESSION['BillingFirstName']:"";
     $BillingLastName				=isset($_SESSION['BillingLastName'])?$_SESSION['BillingLastName']:"";
     $BillingAddressLine1			=isset($_SESSION['BillingAddressLine1'])?$_SESSION['BillingAddressLine1']:"";
     $BillingAddressLine2			=isset($_SESSION['BillingAddressLine2'])?$_SESSION['BillingAddressLine2']:"";
     $BillingCity					=isset($_SESSION['BillingCity'])?$_SESSION['BillingCity']:"";
     $BillingCountryID				=isset($_SESSION['BillingCountryID'])?$_SESSION['BillingCountryID']:"";
     $BillingPhone					=isset($_SESSION['BillingPhone'])?$_SESSION['BillingPhone']:"";
     $BillingEmail					=isset($_SESSION['BillingEmail'])?$_SESSION['BillingEmail']:"";
     $BillingCreditCardType			=isset($_SESSION['BillingCreditCardType'])?$_SESSION['BillingCreditCardType']:"";
	 $BillingCreditCardNo			=isset($_SESSION['BillingCreditCardNo'])?$_SESSION['BillingCreditCardNo']:"";
     $BillingCreditCardSecurityCode	=isset($_SESSION['BillingCreditCardSecurityCode'])?$_SESSION['BillingCreditCardSecurityCode']:"";
	 $BillingCreditCardExpiryMonth=isset($_SESSION['BillingCreditCardExpiryMonth'])?$_SESSION['BillingCreditCardExpiryMonth']:"";
	 $BillingCreditCardExpiryYear 	=isset($_SESSION['BillingCreditCardExpiryYear'])?$_SESSION['BillingCreditCardExpiryYear']:"";
	 $BillingCreditCardExpiryDate=$BillingCreditCardExpiryMonth.$BillingCreditCardExpiryYear;
	 $BillingTotalAmount			=isset($_SESSION['BillingTotalAmount'])?$_SESSION['BillingTotalAmount']:"0";
	 
	 
//The Code 	 Below will connect to Paypal and Verifiy the Credit Cart, and Do Payments.
require_once("config_inc.php");

// Store request params in an array
$request_params = array
               (
               'METHOD' => 'DoDirectPayment',
               'USER' => $api_username,
               'PWD' => $api_password,
               'SIGNATURE' => $api_signature,
               'VERSION' => $api_version,
               'PAYMENTACTION' => 'Sale',
               'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
               'CREDITCARDTYPE' => $BillingCreditCardType,
               'ACCT' => $BillingCreditCardNo,
               'EXPDATE' =>  $BillingCreditCardExpiryDate,
               'CVV2' => '456',
               'FIRSTNAME' => $BillingFirstName,
               'LASTNAME' =>  $BillingLastName,
               'STREET' =>    $BillingAddressLine1,
               'CITY' => $BillingCity,
               'STATE' => $BillingCity,
               'COUNTRYCODE' => 'US',
               'ZIP' => '33770',
               'AMT' => "4",//$BillingTotalAmount,
               'CURRENCYCODE' => 'USD',
               'DESC' => 'Sooqna Online Purchase'
               );
			   
			   
// Loop through $request_params array to generate the NVP string.
$nvp_string = '';
foreach($request_params as $var=>$val)
{
   $nvp_string .= '&'.$var.'='.urlencode($val);
}

//Send the HTTP Request to PayPal
// Send NVP string to PayPal and store response
$curl = curl_init();
      curl_setopt($curl, CURLOPT_VERBOSE, 1);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_TIMEOUT, 30);
      curl_setopt($curl, CURLOPT_URL, $api_endpoint);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
$result = curl_exec($curl);
curl_close($curl);
$result;
	
// Parse the API response
// The value that we get back in $result from the previous step will be an NVP string

// $nvp_response_array = parse_str($result);  // Use this ONLY if Variables are Required

// The Above parsing of the nvp_reponse_array will provide	following php variables.
// We would end up with access to the following PHP variables:
/*
    // Upon Sucessfull Transaction
    $TIMESTAMP
    $CORRELATIONID
    $ACK
    $VERSION
    $BUILD
    $AMT
    $CURRENCYCODE
    $AVSCODE
    $CVV2MATCH
    $TRANSACTIONID    
	
	
	//Upon Failure of a Transaction
	$TIMESTAMP
    $CORRELATIONID
    $ACK
    $VERSION
    $BUILD
    $L_ERRORCODE0
    $L_SHORTMESSAGE0
    $L_LONGMESSAGE0
    $L_SEVERITYCODE0
    $AMT
    $CURRENCYCODE
*/

/* The $ACK value is what will tell us whether or not the API call was successful or not.  Values for $ACK can be:

    Success
    SuccessWithWarning
    Failure
    FailureWithWarning
	
*/

// Use The Code Below to Convert the Results String to an Array
$results_array=NVPToArray($result);
//echo "<pre/>";
//print_r ($results_array);
if(array_key_exists("ACK",$results_array) && $results_array['ACK']=="Success"){
echo "Transaction Was SuccessFull";	
}else{
	echo "Transaction failed";	
}

//Additional Data Parsing Option
// Function to convert NTP string to an array
function NVPToArray($NVPString)
{
   $proArray = array();
   while(strlen($NVPString))
   {
      // name
      $keypos= strpos($NVPString,'=');
      $keyval = substr($NVPString,0,$keypos);
      // value
      $valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
      $valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
      // decoding the respose
      $proArray[$keyval] = urldecode($valval);
      $NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
   }
   return $proArray;
}
