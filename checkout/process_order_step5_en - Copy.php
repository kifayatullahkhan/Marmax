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
require_once("../paypal/process_credit_card.php");

function fnPutShipmentDetails($CustomerOrderID,$database_Conn, $Conn){
  $insertSQL = sprintf("INSERT INTO vs_customer_order_shipment_details (CustomerOrderID, FirstName, AddressLine1, AddressLine2, City, CountryID, Phone, Email, CompanyNameIfAny, ShipmentMethod, IsBusinessAddress) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($CustomerOrderID, "int"),
                       GetSQLValueString($_SESSION['ShipmentFirstName'] ." ".$_SESSION['ShipmentLastName'], "text"),
                       GetSQLValueString($_SESSION['ShipmentAddressLine1'], "text"),
                       GetSQLValueString($_SESSION['ShipmentAddressLine2'], "text"),
                       GetSQLValueString($_SESSION['ShipmentCity'], "text"),
                       GetSQLValueString($_SESSION['ShipmentCountryID'], "int"),
                       GetSQLValueString($_SESSION['ShipmentPhone'], "text"),
                       GetSQLValueString($_SESSION['ShipmentEmail'], "text"),
                       GetSQLValueString($_SESSION['ShipmentCompanyNameIfAny'], "text"),
                       GetSQLValueString($_SESSION['ShipmentShipmentMethod'], "text"),
                       GetSQLValueString(isset($_SESSION['ShipmentIsBusinessAddress'])?1:0, "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
return true;
}
 
 
function fnPutBillingDetails($CustomerOrderID,$database_Conn, $Conn){	
	  $insertSQL = sprintf("INSERT INTO vs_customer_payment_details (UserID, FirstName, LastName, AddressLine1, AddressLine2, City, CountryID, Phone, Email, CreditCardType, CreditCardNo, CreditCardSecurityCode, CreditCardExpiryMonth, CreditCardExpiryYear) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION['MM_UserID'], "int"),
                       GetSQLValueString($GLOBALS['BillingFirstName'], "text"),
                       GetSQLValueString($GLOBALS['BillingLastName'], "text"),
                       GetSQLValueString($GLOBALS['BillingAddressLine1'], "text"),
                       GetSQLValueString($GLOBALS['BillingAddressLine2'], "text"),
                       GetSQLValueString($GLOBALS['BillingCity'], "text"),
                       GetSQLValueString($GLOBALS['BillingCountryID'], "int"),
                       GetSQLValueString($GLOBALS['BillingPhone'], "text"),
                       GetSQLValueString($GLOBALS['BillingEmail'], "text"),
                       GetSQLValueString($GLOBALS['BillingCreditCardType'], "text"),
                       GetSQLValueString($GLOBALS['BillingCreditCardNo'], "text"),
                       GetSQLValueString($GLOBALS['BillingCreditCardSecurityCode'], "text"),
					   GetSQLValueString($GLOBALS['BillingCreditCardExpiryMonth'], "text"),
					   GetSQLValueString($GLOBALS['BillingCreditCardExpiryYear'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
return true;
}


@mysql_select_db($database_Conn, $Conn);
$query_Rs_GetCountryNamesList = "SELECT * FROM country_names ORDER BY CountryID ASC";
@$Rs_GetCountryNamesList = mysql_query($query_Rs_GetCountryNamesList, $Conn) or die(mysql_error());
@$row_Rs_GetCountryNamesList = mysql_fetch_assoc($Rs_GetCountryNamesList);
@$totalRows_Rs_GetCountryNamesList = mysql_num_rows($Rs_GetCountryNamesList);


$OrderReferenceNo=$_SESSION['MM_UserID']."-".date('mymds').rand(111, 999);
$OrderStatus="PENDING";
$UserID=$_SESSION['MM_UserID'];
$InsertedOrderID=0;

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
     $BillingCity					=isset($_SESSION['BillingCity'])?$_SESSION['BillingCity']:"";
     $BillingCountryID				=isset($_SESSION['BillingCountryID'])?$_SESSION['BillingCountryID']:"";
     $BillingPhone					=isset($_SESSION['BillingPhone'])?$_SESSION['BillingPhone']:"";
     $BillingEmail					=isset($_SESSION['BillingEmail'])?$_SESSION['BillingEmail']:"";
     $BillingCreditCardType			=isset($_SESSION['BillingCreditCardType'])?$_SESSION['BillingCreditCardType']:"";
	 $BillingCreditCardNo			=isset($_SESSION['BillingCreditCardNo'])?$_SESSION['BillingCreditCardNo']:"";
     $BillingCreditCardSecurityCode	=isset($_SESSION['BillingCreditCardSecurityCode'])?$_SESSION['BillingCreditCardSecurityCode']:"0";
	 $BillingCreditCardExpiryMonth=isset($_SESSION['BillingCreditCardExpiryMonth'])?$_SESSION['BillingCreditCardExpiryMonth']:"";
	 $BillingCreditCardExpiryYear 	=isset($_SESSION['BillingCreditCardExpiryYear'])?$_SESSION['BillingCreditCardExpiryYear']:"";
// End of Billing Details



// Now Process The Order
$OrderReferenceNo=$_SESSION['MM_UserID']."-".date('dmyHis').rand(111, 999);
$OrderStatus="PENDING";
$UserID=$_SESSION['MM_UserID'];
$InsertedOrderID=0;

// Start of Order Processing

// First of All Inset the Automatic Record to Create Customer Order ID;
	  $insertSQL = sprintf("INSERT INTO vs_customer_orders (OrderReferenceNo, OrderStatus, UserID) VALUES (%s, %s, %s)",
						   
						   GetSQLValueString($OrderReferenceNo, "text"),
						   GetSQLValueString($OrderStatus, "text"),
						   GetSQLValueString($UserID, "int"));
	
	  mysql_select_db($database_Conn, $Conn);
	  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
	
	
	$colname_RsGetNewCustomerOrderID = "-1";
	if (isset($_SESSION['MM_UserID'])) {
	  $colname_RsGetNewCustomerOrderID = $_SESSION['MM_UserID'];
	}
	mysql_select_db($database_Conn, $Conn);
	$query_RsGetNewCustomerOrderID = sprintf("SELECT  LAST_INSERT_ID() AS CustomerOrderID, OrderReferenceNo FROM vs_customer_orders WHERE UserID = %s", GetSQLValueString($colname_RsGetNewCustomerOrderID, "int"));
	$RsGetNewCustomerOrderID = mysql_query($query_RsGetNewCustomerOrderID, $Conn) or die(mysql_error());
	$row_RsGetNewCustomerOrderID = mysql_fetch_assoc($RsGetNewCustomerOrderID);
	$totalRows_RsGetNewCustomerOrderID = mysql_num_rows($RsGetNewCustomerOrderID);
	$InsertedOrderID=$row_RsGetNewCustomerOrderID['CustomerOrderID'];
// End of Order Processing
// Add Items into Order

 
?>
<!-- ================================================-->


<?php
 
$TotalCartCost=0.00;

if (isset($_SESSION["cart_Items"])&& count($_SESSION["cart_Items"])>0) {

$ItemName="";
$ItemCode="";
$ItemSalePrice=0.00;
foreach($_SESSION['cart_Items'] as $key=>$value)
    {
 
	
	// Read All Cart Details
    $ItemCode=$_SESSION['cart_Items'][$key];
	if (isset($_SESSION['cart_ItemCartType'][$key]) && $_SESSION['cart_ItemCartType'][$key]=="VirtualStore"){
	mysql_select_db($database_Conn, $Conn);
$query_RsGetCartDetails = "SELECT * FROM vs_users_virtual_stores_inventory WHERE VSInvItemCode = '".$value."'";
$RsGetCartDetails = mysql_query($query_RsGetCartDetails, $Conn) or die(mysql_error());
$row_RsGetCartDetails = mysql_fetch_assoc($RsGetCartDetails);
$totalRows_RsGetCartDetails = mysql_num_rows($RsGetCartDetails);
	  $TotalCartCost=$TotalCartCost + ($_SESSION['cart_Quantity'][$key] *$row_RsGetCartDetails['VSInvItemSalesPrice']);
	  $ItemName=$row_RsGetCartDetails['VSInvItemName'] ;
	  $ItemImageFileName=$row_RsGetCartDetails['DisplayImage'];
	  $ItemSalePrice=(double)$row_RsGetCartDetails['VSInvItemSalesPrice'];
	}else{
		mysql_select_db($database_Conn, $Conn);
$query_RsGetCartDetails = "SELECT * FROM vs_coupons WHERE CouponItemCode = '".$value."'";
$RsGetCartDetails = mysql_query($query_RsGetCartDetails, $Conn) or die(mysql_error());
$row_RsGetCartDetails = mysql_fetch_assoc($RsGetCartDetails);
$totalRows_RsGetCartDetails = mysql_num_rows($RsGetCartDetails);
	  if(isset($_SESSION['cart_ItemCartType'][$key]))
	  $TotalCartCost=$TotalCartCost + ($_SESSION['cart_Quantity'][$key] *$row_RsGetCartDetails['NewPrice']);	
	  $ItemName=$row_RsGetCartDetails['CouponTitle'] ;
	  $ItemImageFileName=$row_RsGetCartDetails['DisplayImage'];
	  $ItemSalePrice=(double)$row_RsGetCartDetails['NewPrice'];
	}



 

 
      // $_SESSION['cart_Items'][$key];
	  //VSInvItemCode is the Item Code  of the items  for Virtual stores 
	  //CouponItemCode is the Item Code for the item in Coupons
	  
	   //if(isset($_SESSION['cart_Quantity'][$key]))
	//$ItemTotalSalePrice=$_SESSION['cart_Quantity'][$key]*$ItemSalePrice;
// Start the Insert  of Items to the Order Detials Table
  $insertSQL = sprintf("INSERT INTO vs_customer_order_details (CustomerOrderID, Quantity, UnitSalesPrice,  ItemCode,  ItemCartType) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($InsertedOrderID, "int"),
                       GetSQLValueString($_SESSION['cart_Quantity'][$key], "int"),
                       GetSQLValueString( $ItemSalePrice, "double"),
                       GetSQLValueString($_SESSION['cart_Items'][$key], "text"),//$_POST['VSInvItemID']
                       GetSQLValueString($_SESSION['cart_ItemCartType'][$key], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
// End the Insert of Items to the Order Details Table
    
     }// end of for each  

// Get User Email Address so it can be used in sending Email
	$colname_RsGetEmail = "-1";
	if (isset($_SESSION['MM_UserID'])) {
	  $colname_RsGetEmail = $_SESSION['MM_UserID'];

	}
	mysql_select_db($database_Conn, $Conn);
	$query_RsGetEmail = sprintf("SELECT  Username, Email FROM user_accounts WHERE UserID = %s", GetSQLValueString($colname_RsGetEmail, "int"));
	$RsGetEmail = mysql_query($query_RsGetEmail, $Conn) or die(mysql_error());
	$row_RsGetEmail = mysql_fetch_assoc($RsGetEmail);
	$totalRows_RsGetEmail = mysql_num_rows($RsGetEmail);
	$UserEmail=$row_RsGetEmail['Username'];
	fnPutShipmentDetails($InsertedOrderID,$database_Conn, $Conn);
	fnPutBillingDetails($InsertedOrderID,$database_Conn, $Conn);
// End of Order Processing

// End of Get User Email Address
// Start Sending Email


 /* ========== Start of Sending the Emal ==========*/
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





	 
mysql_free_result($RsGetCartDetails);
}// check if isset Session Cart
?>

<!-- =============================================== -->
<!-- Start of Checkout Order Summery -->
<?php require_once("checkout/checkout_order_summery_ar.php"); ?>
<!-- End of Checkout Order Summer -->

<div>
You Order ID=<?php echo $OrderReferenceNo;?>
</div>
<?php
// Now Clear All Session Verabiles related to Order Process.

// Start Shipment Details 
if(isset($_SESSION['ShipmentFirstName'])){unset($_SESSION['ShipmentFirstName']);}
if(isset($_SESSION['ShipmentLastName'])){unset($_SESSION['ShipmentLastName']);}
if(isset($_SESSION['ShipmentAddressLine1'])){unset($_SESSION['ShipmentAddressLine1']);}
if(isset($_SESSION['ShipmentAddressLine2'])){unset($_SESSION['ShipmentAddressLine2']);}
if(isset($_SESSION['ShipmentCity'])){unset($_SESSION['ShipmentCity']);}
if(isset($_SESSION['ShipmentCountryID'])){unset($_SESSION['ShipmentCountryID']);}
if(isset($_SESSION['ShipmentPhone'])){unset($_SESSION['ShipmentPhone']);}
if(isset($_SESSION['ShipmentEmail'])){unset($_SESSION['ShipmentEmail']);}
if(isset($_SESSION['ShipmentCompanyNameIfAny'])){unset($_SESSION['ShipmentCompanyNameIfAny']);}
if(isset($_SESSION['ShipmentShipmentMethod'])){unset($_SESSION['ShipmentShipmentMethod']);};
if(isset($_SESSION['ShipmentIsBusinessAddress'])){unset($_SESSION['ShipmentIsBusinessAddress']);}
// End of Shipment Details

// Start of Billing Details 
if(isset($_SESSION['BillingFirstName'])){unset($_SESSION['BillingFirstName']);}
if(isset($_SESSION['BillingLastName'])){unset($_SESSION['BillingLastName']);}
if(isset($_SESSION['BillingAddressLine1'])){unset($_SESSION['BillingAddressLine1']);}
if(isset($_SESSION['BillingAddressLine2'])){unset($_SESSION['BillingAddressLine2']);}
if(isset($_SESSION['BillingCity'])){unset($_SESSION['BillingCity']);}
if(isset($_SESSION['BillingCountryID'])){unset($_SESSION['BillingCountryID']);}
if(isset($_SESSION['BillingPhone'])){unset($_SESSION['BillingPhone']);}
if(isset($_SESSION['BillingEmail'])){unset($_SESSION['BillingEmail']);}
if(isset($_SESSION['BillingCreditCardType'])){unset($_SESSION['BillingCreditCardType']);}
if(isset($_SESSION['BillingCreditCardNo'])){unset($_SESSION['BillingCreditCardNo']);}
if(isset($_SESSION['BillingCreditCardSecurityCode'])){unset($_SESSION['BillingCreditCardSecurityCode']);}
if(isset($_SESSION['BillingCreditCardExpiryMonth'])){unset($_SESSION['BillingCreditCardExpiryMonth']);}
if(isset($_SESSION['BillingCreditCardExpiryYear'])){unset($_SESSION['BillingCreditCardExpiryYear']);}


// Also destroy the Shopping cart completly
if(isset($_SESSION['cart_Items'])) { unset($_SESSION['cart_Items']); }
if(isset($_SESSION['cart_Quantity'])) { unset($_SESSION['cart_Quantity']); }
if(isset($_SESSION['cart_ItemCartType'])) { unset($_SESSION['cart_ItemCartType']); }

?>

