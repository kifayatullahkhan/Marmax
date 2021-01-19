<?php
if(!isset($_SESSION)){
	session_start();
}
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

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

$TotalCartCost=0.00;

if (isset($_SESSION["cart_Items"]) && count($_SESSION["cart_Items"])>0) {

foreach($_SESSION['cart_Items'] as $key=>$value)
    {
	 
		if($_SESSION['cart_ItemCartType'][$key]=="VirtualStore"){		
		// and print out the values
		mysql_select_db($database_Conn, $Conn);
	$query_RsGetTotalCartCost = "SELECT VSInvItemCode, VSInvItemSalesPrice FROM vs_users_virtual_stores_inventory WHERE VSInvItemCode ='" .$value."'";
	$RsGetTotalCartCost = mysql_query($query_RsGetTotalCartCost, $Conn) or die(mysql_error());
	$row_RsGetTotalCartCost = mysql_fetch_assoc($RsGetTotalCartCost);
	$totalRows_RsGetTotalCartCost = mysql_num_rows($RsGetTotalCartCost);
		//echo 'ItemID='.$value."'".' Quantity=' . $_SESSION['cart_Quantity'][$key]."'".' <br />';
	  $TotalCartCost=$TotalCartCost + ($_SESSION['cart_Quantity'][$key] *$row_RsGetTotalCartCost['VSInvItemSalesPrice']);
		}elseif($_esSESSION['cart_ItemCartType'][$key]=="CouponDeals"){		
		// and print out the valu
		mysql_select_db($database_Conn, $Conn);
	$query_RsGetTotalCartCost = "SELECT CouponItemCode, NewPrice FROM vs_coupons WHERE CouponItemCode ='" .$value."'";
	$RsGetTotalCartCost = mysql_query($query_RsGetTotalCartCost, $Conn) or die(mysql_error());
	$row_RsGetTotalCartCost = mysql_fetch_assoc($RsGetTotalCartCost);
	$totalRows_RsGetTotalCartCost = mysql_num_rows($RsGetTotalCartCost);
		//echo 'ItemID='.$value."'".' Quantity=' . $_SESSION['cart_Quantity'][$key]."'".' <br />';
	  $TotalCartCost=$TotalCartCost + ($_SESSION['cart_Quantity'][$key] *$row_RsGetTotalCartCost['NewPrice']);
		}
	}
@mysql_free_result($RsGetTotalCartCost);	
}// check if isset Session Cart
$_SESSION['BillingTotalAmount']=$TotalCartCost;
echo  $TotalCartCost;

?>