<?php
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

mysql_select_db($database_Conn, $Conn);
$query_RsGetItemsGategories = "SELECT * FROM erp_inventoryitemstypes";
$RsGetItemsGategories = mysql_query($query_RsGetItemsGategories, $Conn) or die(mysql_error());
$row_RsGetItemsGategories = mysql_fetch_assoc($RsGetItemsGategories);
$totalRows_RsGetItemsGategories = mysql_num_rows($RsGetItemsGategories);


?>

<?php

 do { 
// $row_RsGetItemsGategories['InvItemTypeID'];
?>
  <!-- First Tab Content -->
  
  <div class="tab-content" style="display:block;">
    <div class="items">
      <div class="cl">&nbsp;</div>
      <ul>
      <!-- Start of Category Items -->

  <?php
  	  
	  mysql_select_db($database_Conn, $Conn);
$query_RsGetCategoryItems = "SELECT * FROM erp_inventoryitems WHERE InvItemTypeID =".$row_RsGetItemsGategories['InvItemTypeID'];
$RsGetCategoryItems = mysql_query($query_RsGetCategoryItems, $Conn) or die(mysql_error());
$row_RsGetCategoryItems = mysql_fetch_assoc($RsGetCategoryItems);
$totalRows_RsGetCategoryItems = mysql_num_rows($RsGetCategoryItems);
if($totalRows_RsGetCategoryItems>0) { //Category Empty Check
   do { ?>

     
    <li>
        <div class="image"> <a href="#">
        <img src="user_uploads/files/online_store_product_images/<?php echo $row_RsGetCategoryItems['ItemImageFileName']; ?>" alt="" /></a>
        </div>
        
        <p> Item Code: 
        <span><?php echo $row_RsGetCategoryItems['InvItemCode']; ?></span>
        <br />
                    
        Name: <a href="#"><?php echo $row_RsGetCategoryItems['InvItemName']; ?></a> </p>
         <form method="post" action="../shoping_cart/php_code_files/shoping_cart/add_item_to_cart.php">
        <p class="price">
        Price: 
        <strong>$<?php echo $row_RsGetCategoryItems['InvItemSalesPrice']; ?> USD</strong>
        <br />
        <label for="Qty">Quantity:</label>
        <input name="Quantity" type="text" id="Quantity" value="1" size="3" maxlength="3" />
        <input name="InvItemID" type="hidden" id="ItemID" size="3"  value="<?php echo $row_RsGetCategoryItems['InvItemID']; ?>"/>
        <input type="submit" name="btnCart" id="btnCart" value="Add to Cart" />
        </p>
           
            </form>
    </li>

    <?php } while ($row_RsGetCategoryItems = mysql_fetch_assoc($RsGetCategoryItems));
	
} // End of Category Empty Check;
?>

<!-- End of Category Items -->
        
      </ul>
      <div class="cl">&nbsp;</div>
    </div>
  </div>
  <!-- End First Tab Content -->
  <?php } while ($row_RsGetItemsGategories = mysql_fetch_assoc($RsGetItemsGategories)); ?>
<?php
mysql_free_result($RsGetItemsGategories);

mysql_free_result($RsGetCategoryItems);
?>
          