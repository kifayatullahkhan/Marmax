<?php 
if (!isset($_SESSION)) {
	@session_start();	
}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
// Define Some Global Access Varaiables
$OrderReferenceNo="";
$OrderStatus="PENDING";
$UserEmail="";

// Start Shipment Details 
	$ShipmentFirstName           =isset($_SESSION['ShipmentFirstName'])?$_SESSION['ShipmentFirstName']:"";
	$ShipmentLastName            =isset($_SESSION['ShipmentLastName'])?$_SESSION['ShipmentLastName']:"";
	$ShipmentAddressLine1        =isset($_SESSION['ShipmentAddressLine1'])?$_SESSION['ShipmentAddressLine1']:"";
	$ShipmentAddressLine2        =isset($_SESSION['ShipmentAddressLine2'])?$_SESSION['ShipmentAddressLine2']:"";
	$ShipmentCity                =isset($_SESSION['ShipmentCity'])?$_SESSION['ShipmentCity']:"";
	$ShipmentCountryID           =isset($_SESSION['ShipmentCountryID'])?$_SESSION['ShipmentCountryID']:"";
	$ShipmentPhone               =isset($_SESSION['ShipmentPhone'])?$_SESSION['ShipmentPhone']:"";
	$ShipmentEmail               =isset($_SESSION['ShipmentEmail'])?$_SESSION['ShipmentEmail']:"";
	$ShipmentCompanyNameIfAny    =isset($_SESSION['ShipmentCompanyNameIfAny'])?$_SESSION['ShipmentCompanyNameIfAny']:"";
	$ShipmentShipmentMethod      =isset($_SESSION['ShipmentShipmentMethod'])?$_SESSION['ShipmentShipmentMethod']:"";;
	$ShipmentIsBusinessAddress   =isset($_SESSION['ShipmentIsBusinessAddress'])?$_SESSION['ShipmentIsBusinessAddress']:"";
// End of Shipment Details

// Start of Billing Details 
 	 $BillingFirstName				=isset($_SESSION['BillingFirstName'])?$_SESSION['BillingFirstName']:"";
     	$BillingLastName				=isset($_SESSION['BillingLastName'])?$_SESSION['BillingLastName']:"";
     	$BillingAddressLine1			=isset($_SESSION['BillingAddressLine1'])?$_SESSION['BillingAddressLine1']:"";
     	$BillingAddressLine2			=isset($_SESSION['BillingAddressLine2'])?$_SESSION['BillingAddressLine2']:"";
     	$BillingCity				=isset($_SESSION['BillingCity'])?$_SESSION['BillingCity']:"";
     	$BillingCountryID				=isset($_SESSION['BillingCountryID'])?$_SESSION['BillingCountryID']:"";
     	$BillingPhone				=isset($_SESSION['BillingPhone'])?$_SESSION['BillingPhone']:"";
    	 $BillingEmail				=isset($_SESSION['BillingEmail'])?$_SESSION['BillingEmail']:"";
    	 $BillingCreditCardType			=isset($_SESSION['BillingCreditCardType'])?$_SESSION['BillingCreditCardType']:"";
	 $BillingCreditCardNo			=isset($_SESSION['BillingCreditCardNo'])?$_SESSION['BillingCreditCardNo']:"";
     	$BillingCreditCardSecurityCode	=isset($_SESSION['BillingCreditCardSecurityCode'])?$_SESSION['BillingCreditCardSecurityCode']:"0";
	 $BillingCreditCardExpiryMonth=isset($_SESSION['BillingCreditCardExpiryMonth'])?$_SESSION['BillingCreditCardExpiryMonth']:"";
	 $BillingCreditCardExpiryYear 	=isset($_SESSION['BillingCreditCardExpiryYear'])?$_SESSION['BillingCreditCardExpiryYear']:"";
	 $BillingCreditCardExpiryDate=$BillingCreditCardExpiryMonth.$BillingCreditCardExpiryYear;
	 $BillingTotalAmount			=isset($_SESSION['BillingTotalAmount'])?$_SESSION['BillingTotalAmount']:"0";

// End of Billing Details


/* ----------------------------###########################---------------------------- */
/*                             PROCESS CREDIT CARD DETAILS                             */
/* ----------------------------###########################---------------------------- */
	
//	require_once("paypal/process_credit_card.php");

/* ----------------------------###########################---------------------------- */

/* ----------------------------###########################---------------------------- */
/*                             PROCESS CUSTOMER ORDER                                  */
/* ----------------------------###########################---------------------------- */
	
	require_once("process_order_details_inc.php");

/* ----------------------------###########################---------------------------- */
// Check if Session has Item in the Cart
if (isset($_SESSION["cart_Items"])&& count($_SESSION["cart_Items"])>0) {
	// Disable due to Paypal Check Error 
	//if(fnExecutePaymentTransaction()) {
		if(1) {
	    fnProcessCustomerOrder($database_Conn, $Conn);
		fnDestroyCartSession();
		// Confirmation Messages Starts Here
		/* ----------#####################------------ */
			 /* ==========###########################==========*/
			 /* ========== Start of Sending the Emal ==========*/
			 /* ==========###########################==========*/
			  
			 $FromEmail="orders@sooqna.com";
			 $ToEmail=$UserEmail;
			 $CC="";
			 $BCC="";
			 $Subject="Order Confirmation [".$OrderReferenceNo."]";
			 
			
			ob_start();
			eval("?>". file_get_contents('checkout/email_html_body_for_order_confirmation.php')."<?php");
			$contents = ob_get_contents();
			ob_end_clean();
			
			$MailMessage=$contents;
			
			if(fnZorkifSendMail($FromEmail,$ToEmail,$CC,$BCC,$Subject,$MailMessage)){
			//echo " Email Send.......";	
			}
			
			/* End of Sending Email  */
		//End of Confirmation Messages
	}else{
		
	echo " Sorry Your Transaction Can not be Completed, Please Check your Credit Cart Details";	
	}
}// End of Cart Items Count Check
// End of Order Processing
?>

 

<div class="DetailView">
You Order ID=<?php echo $OrderReferenceNo;?>
</div>
 

