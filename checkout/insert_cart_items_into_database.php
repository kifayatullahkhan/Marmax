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
	  $ItemSalePrice=$row_RsGetCartDetails['VSInvItemSalesPrice'];
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
	  $ItemSalePrice=$row_RsGetCartDetails['NewPrice'];
	}



 

 
      
	   //if(isset($_SESSION['cart_Quantity'][$key]))
	//$ItemTotalSalePrice=$_SESSION['cart_Quantity'][$key]*$ItemSalePrice;
// Start the Insert  of Items to the Order Detials Table
  $insertSQL = sprintf("INSERT INTO vs_customer_order_details (CustomerOrderID, Quantity, Calculated_Sales_Price_Per_Unit, VSInvItemID,  ItemCartType) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($InsertedOrderID, "int"),
                       GetSQLValueString($_SESSION['cart_Quantity'][$key], "int"),
                       GetSQLValueString( $ItemSalePrice, "double"),
                       GetSQLValueString($_SESSION['cart_Items'][$key], "int"),//$_POST['VSInvItemID']
                       GetSQLValueString($_SESSION['cart_ItemCartType'][$key], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
// End the Insert of Items to the Order Details Table
    
     }// end of for each  
	 
mysql_free_result($RsGetCartDetails);
}// check if isset Session Cart
?>
