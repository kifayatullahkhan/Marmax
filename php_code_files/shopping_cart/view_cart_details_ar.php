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

if (isset($_SESSION["cart_Items"])&& count($_SESSION["cart_Items"])>0) {
?>
<div class="shopping_cart_form">
      <table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr class="DarkHeaderRow">
    <th>الصورة</th>
    <th>رقم المنتج</th>
    <th>اسم المنتج</th>
    <th width="200" align="center" valign="middle">الكمية</th>
    <th align="center" valign="middle">سعر الوحدة</th>
    <th align="center" valign="middle">المجموع</th>
    <th align="center" valign="middle">حذف</th>
    </tr>
<?php
$ItemName="";
$ItemCode=$_SESSION["cart_Items"];
$ItemImageFileName="none.jpg";
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
	  ?>
      

  <?php do { ?>
    <tr>
      <td><img src="user_uploads/files/deals_virtual_store_images/<?php echo $ItemImageFileName; ?>" width="140" height="90"></td>
      <td><?php echo $_SESSION['cart_Items'][$key]; ?></td>
      <td><?php echo $ItemName; ?></td>
      <td width="200" align="center" valign="middle"><form action="php_code_files/shopping_cart/update_item_quantity_in_cart.php" method="post" id="frmUpdateQty" name="frmUpdateQty">
      <input name="cart_Quantity" type="text" value="<?php
	   if(isset($_SESSION['cart_ItemCartType'][$key]))
	   echo $_SESSION['cart_Quantity'][$key]; ?>" size="5" maxlength="3"  />
       <input name="BtnUpdate" type="submit" value="تحديث"  />
       <input name="ItemCode" type="hidden" value="<?php echo $ItemCode; ?>"   />
     
      </form>
      </td>
      <td align="center" valign="middle"><?php echo $ItemSalePrice; ?></td>
      <td align="center" valign="middle"><?php 
	   if(isset($_SESSION['cart_Quantity'][$key]))
	  echo $_SESSION['cart_Quantity'][$key]*$ItemSalePrice; ?></td>
      <td align="center" valign="middle"><form action="php_code_files/shopping_cart/remove_item_from_cart.php" method="post" name="formRemoveItem" id="formRemoveItem">
        <input type="hidden" name="RemoveItemID" id="RemoveItemID" value="<?php echo $ItemCode; ?>">
        <input type="submit" name="Remove" id="Remove" value="حذف">
      </form></td>
      </tr>
    <?php } while ($row_RsGetCartDetails = mysql_fetch_assoc($RsGetCartDetails)); ?>
    <?php }// end of for each  ?>
    
    
    
    
    
</table>
      </div>
    <?php
mysql_free_result($RsGetCartDetails);
}// check if isset Session Cart
?>
