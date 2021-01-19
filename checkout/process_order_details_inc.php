<?php

function fnPutShipmentDetails($CustomerOrderID,$database_Conn, $Conn){
  $insertSQL = sprintf("INSERT INTO vs_customer_order_shipment_details (CustomerOrderID,  	FullName, AddressLine1, AddressLine2, City, CountryID, Phone, Email, CompanyNameIfAny, ShipmentMethod, IsBusinessAddress) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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


function fnProcessCustomerOrder($database_Conn, $Conn){

/* ----------------------------###########################---------------------------- */
/*                             PROCESS CUSTOMER ORDER                                  */
/* ----------------------------###########################---------------------------- */
 

// Check if Session has Item in the Cart
if (isset($_SESSION["cart_Items"])&& count($_SESSION["cart_Items"])>0) {


// Generate Random Order Reference Number with Uniqute Value
$OrderReferenceNo=$GLOBALS['OrderReferenceNo']=$_SESSION['MM_UserID']."-".date('dmyHis').rand(111, 999);
$OrderStatus="PENDING";
$UserID=$_SESSION['MM_UserID'];
$OrderPaymentType=$_SESSION['OrderPaymentType']; 
if(!isset($_SESSION['OrderPaymentType']) || $_SESSION['OrderPaymentType']=='PAYONDELIVERY'){
$OrderPaymentTypeID=1;	
}else{
$OrderPaymentTypeID=2;
}
$InsertedOrderID=0;

//Create Variable to Hold Total Value of the Cart Items
$TotalCartCost=0.00;


/* ----------------------------###########################---------------------------- */
/*                             Start Creating Order ID                                 */
/* ----------------------------###########################---------------------------- */
// First of All Inset the Automatic Record to Create Customer Order ID;
	  $insertSQL = sprintf("INSERT INTO vs_customer_orders (OrderReferenceNo, OrderStatus, OrderPaymentTypeID, UserID) VALUES (%s, %s, %s,%s)",
						   
						   GetSQLValueString($OrderReferenceNo, "text"),
						   GetSQLValueString($OrderStatus, "text"),
						   GetSQLValueString($OrderPaymentTypeID, "int"),
						   GetSQLValueString($UserID, "int"));
	
	  mysql_select_db($database_Conn, $Conn);
	  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
	
/* ----------------------------###########################---------------------------- */



/* ----------------------------###########################---------------------------- */
/*                             Get Last Inserted Order ID                              */
/* ----------------------------###########################---------------------------- */
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
/* ----------------------------###########################---------------------------- */

 


  
/* ----------------------------###########################---------------------------- */
/*                             Add all Items into Order Details                        */
/* ----------------------------###########################---------------------------- */
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

 
// Start the Insert  of Items to the Order Detials Table
	  $insertSQL = sprintf("INSERT INTO vs_customer_order_details (CustomerOrderID, Quantity, UnitSalesPrice,  ItemCode,  ItemCartType) VALUES (%s, %s, %s, %s, %s)",
						   GetSQLValueString($InsertedOrderID, "int"),
						   GetSQLValueString($_SESSION['cart_Quantity'][$key], "int"),
						   GetSQLValueString( $ItemSalePrice, "double"),
						   GetSQLValueString($_SESSION['cart_Items'][$key], "text"),
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
/* ----------------------------###########################---------------------------- */
    fnPutShipmentDetails($InsertedOrderID,$database_Conn, $Conn);
	if ($_SESSION['OrderPaymentType'] =='BILLINGDETAILS'){  // Put Billing details only if not pay on delivery
	  fnPutBillingDetails($InsertedOrderID,$database_Conn, $Conn);
	}
}// End of Item Checks for Cart
}// End of Function


// The Following Function Will Destroy The Session
function fnDestroyCartSession(){
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
}// End of DestroyCartSession
 
?>