<?php
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

function fnGetCouponName($strItemCode,$database_Conn, $Conn){
	$vItemCode_RsGetCouponsName = "-1";
	if (isset($strItemCode)) {
	  $vItemCode_RsGetCouponsName = $strItemCode;
	}
	mysql_select_db($database_Conn, $Conn);
	$query_RsGetCouponsName = sprintf("SELECT vs_coupons.CouponTitle,vs_coupons.CouponTitle2 FROM vs_coupons WHERE vs_coupons.CouponItemCode=%s", GetSQLValueString($vItemCode_RsGetCouponsName, "text"));
	$RsGetCouponsName = mysql_query($query_RsGetCouponsName, $Conn) or die(mysql_error());
	$row_RsGetCouponsName = mysql_fetch_assoc($RsGetCouponsName);
	$totalRows_RsGetCouponsName = mysql_num_rows($RsGetCouponsName);
	$strItemName=$row_RsGetCouponsName['CouponTitle'];
	mysql_free_result($RsGetCouponsName);	
	return $strItemName;
}
function fnGetItemName($strItemCode,$database_Conn, $Conn){
	$vItemCode_RsGetItemName = "-1";
	if (isset($strItemCode)) {
	  $vItemCode_RsGetItemName = $strItemCode;
	}
	mysql_select_db($database_Conn, $Conn);
	$query_RsGetItemName = sprintf("SELECT vs_users_virtual_stores_inventory.VSInvItemName,vs_users_virtual_stores_inventory.VSInvItemName2 FROM vs_users_virtual_stores_inventory WHERE vs_users_virtual_stores_inventory.VSInvItemCode=%s", GetSQLValueString($vItemCode_RsGetItemName, "text"));
	$RsGetItemName = mysql_query($query_RsGetItemName, $Conn) or die(mysql_error());
	$row_RsGetItemName = mysql_fetch_assoc($RsGetItemName);
	$totalRows_RsGetItemName = mysql_num_rows($RsGetItemName);
	$strItemName=$row_RsGetItemName['VSInvItemName'];
	mysql_free_result($RsGetItemName);	
	return $strItemName;
}
$SessionUserID_RsGetOrderDetails = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $SessionUserID_RsGetOrderDetails = $_SESSION['MM_UserID'];
}
$OrderRefrenceID_RsGetOrderDetails = "-1";
if (isset($_GET['OrderRefrenceID'])) {
  $OrderRefrenceID_RsGetOrderDetails = $_GET['OrderRefrenceID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RsGetOrderDetails = sprintf("SELECT vs_customer_order_details.*, vs_customer_orders.CustomerOrderID, (vs_customer_order_details.UnitSalesPrice* vs_customer_order_details.Quantity) AS TotalItemAmount FROM vs_customer_order_details, vs_customer_orders WHERE vs_customer_orders.CustomerOrderID =vs_customer_order_details.CustomerOrderID AND vs_customer_orders.UserID=%s  AND vs_customer_orders.OrderReferenceNo=%s", GetSQLValueString($SessionUserID_RsGetOrderDetails, "int"),GetSQLValueString($OrderRefrenceID_RsGetOrderDetails, "text"));
$RsGetOrderDetails = mysql_query($query_RsGetOrderDetails, $Conn) or die(mysql_error());
$row_RsGetOrderDetails = mysql_fetch_assoc($RsGetOrderDetails);
$totalRows_RsGetOrderDetails = mysql_num_rows($RsGetOrderDetails);
?>
<?php if ($totalRows_RsGetOrderDetails > 0) { // Show if recordset not empty ?>
  <div class="DetailView" >
    <table width="100%" border="0" cellpadding="2" cellspacing="2">
      <tr class="header_row">
        <td>ItemCode</td>
        <td>Item Name</td>
        <td>Quantity</td>
        <td>UnitSalesPrice</td>
        <td>Total Amount</td>
        <td>Item Type</td>
      </tr>
  <?php 
	$RowNo=0;
	$TotalOrderAmount=0;
	do {
		$RowNo++;
		if($RowNo%2==0)
		$data_row_class="data_row_even";
		else
		$data_row_class="data_row_odd";			
    ?>
      <tr  class="<?php echo $data_row_class; ?>">
        <td><?php echo $row_RsGetOrderDetails['ItemCode']; ?></td>
        <td><?php echo $row_RsGetOrderDetails['ItemCartType']=="VirtualStore"?fnGetItemName($row_RsGetOrderDetails['ItemCode'],$database_Conn, $Conn):fnGetCouponName($row_RsGetOrderDetails['ItemCode'],$database_Conn, $Conn);?></td>
        <td><?php echo $row_RsGetOrderDetails['Quantity']; ?></td>
        <td><?php echo $row_RsGetOrderDetails['UnitSalesPrice']; ?></td>
        <td><?php echo $row_RsGetOrderDetails['TotalItemAmount']; ?></td>
        <td><?php echo $row_RsGetOrderDetails['ItemCartType']=="VirtualStore"?"Regular Item":"Deal Coupon" ?></td>
        </tr>
      <?php
	  $TotalOrderAmount+= $row_RsGetOrderDetails['TotalItemAmount'];
	   } while ($row_RsGetOrderDetails = mysql_fetch_assoc($RsGetOrderDetails)); ?>
      <tr  class="<?php
	  $RowNo++;
		if($RowNo%2==0)
		$data_row_class="data_row_even";
		else
		$data_row_class="data_row_odd";		
	   echo $data_row_class; ?>">
        <td></td>
        <td></td>
        <td></td>
        <td>Total Order Amount</td>
        <td><?php echo $TotalOrderAmount; ?></td>
        <td></td>
        </tr>      
    </table>
  </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_RsGetOrderDetails == 0) { // Show if recordset empty ?>
    <div class="explaination_note" >
         We could not find any order matching your request.
    </div>
  <?php } // Show if recordset empty ?>
<?php
mysql_free_result($RsGetOrderDetails);
?>
