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
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Rs_Show_CategoryItems = 10;
$pageNum_Rs_Show_CategoryItems = 0;
if (isset($_GET['pageNum_Rs_Show_CategoryItems'])) {
  $pageNum_Rs_Show_CategoryItems = $_GET['pageNum_Rs_Show_CategoryItems'];
}
$startRow_Rs_Show_CategoryItems = $pageNum_Rs_Show_CategoryItems * $maxRows_Rs_Show_CategoryItems;

$colname_Rs_Show_CategoryItems = "0";
if (isset($_GET['catid'])) {
  $colname_Rs_Show_CategoryItems = $_GET['catid'];
}
mysql_select_db($database_Conn, $Conn);
if($colname_Rs_Show_CategoryItems == "0"){
$query_Rs_Show_CategoryItems = sprintf("SELECT * FROM vs_coupons ORDER BY CouponID DESC");
}else{
$query_Rs_Show_CategoryItems = sprintf("SELECT * FROM vs_coupons WHERE VSCouponsCATID = %s ORDER BY CouponID DESC", GetSQLValueString($colname_Rs_Show_CategoryItems, "int"));	
}
$query_limit_Rs_Show_CategoryItems = sprintf("%s LIMIT %d, %d", $query_Rs_Show_CategoryItems, $startRow_Rs_Show_CategoryItems, $maxRows_Rs_Show_CategoryItems);
$Rs_Show_CategoryItems = mysql_query($query_limit_Rs_Show_CategoryItems, $Conn) or die(mysql_error());
$row_Rs_Show_CategoryItems = mysql_fetch_assoc($Rs_Show_CategoryItems);

if (isset($_GET['totalRows_Rs_Show_CategoryItems'])) {
  $totalRows_Rs_Show_CategoryItems = $_GET['totalRows_Rs_Show_CategoryItems'];
} else {
  $all_Rs_Show_CategoryItems = mysql_query($query_Rs_Show_CategoryItems);
  $totalRows_Rs_Show_CategoryItems = mysql_num_rows($all_Rs_Show_CategoryItems);
}
$totalPages_Rs_Show_CategoryItems = ceil($totalRows_Rs_Show_CategoryItems/$maxRows_Rs_Show_CategoryItems)-1;

$queryString_Rs_Show_CategoryItems = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Rs_Show_CategoryItems") == false && 
        stristr($param, "totalRows_Rs_Show_CategoryItems") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Rs_Show_CategoryItems = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Rs_Show_CategoryItems = sprintf("&totalRows_Rs_Show_CategoryItems=%d%s", $totalRows_Rs_Show_CategoryItems, $queryString_Rs_Show_CategoryItems);
?>
<div style="clear:both;">&nbsp; </div>
  <?php
  if($totalRows_Rs_Show_CategoryItems>0){
   do { ?>

 
	<div class="ItemDisplay round_borders">
	<div class="ItemDisplayBorder">
        <div class="ItemImage">
            <a href="show_coupon_deal_details.php?InvItemID=<?php echo $row_Rs_Show_CategoryItems['CouponID']; ?>" class="coupons_link">
            <?php if(isset($row_Rs_Show_CategoryItems['DisplayImage']) && strlen($row_Rs_Show_CategoryItems['DisplayImage'])>3){
				?>
            <div class="ItemDisplayImage">
            <img src="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_Show_CategoryItems['DisplayImage']; ?>">
            <?php } ?>
 			</div>
                    
                    <div class="ItemPopUpDetails">
                       
                    <div class="show_item_hover">
                    
                    </div>
					
                    </div>
            </a>
        </div>

        <div class="ItemDescription">
            <div class="Title"><?php echo $row_Rs_Show_CategoryItems['CouponName2']; ?></div>	
               <?php echo $row_Rs_Show_CategoryItems['CouponShortDescription']; ?> 
            <div class="AddToCartButton">
              <a href="" Quantity="1" ItemCartType="CouponDeals" InvItemID="<?php echo $row_Rs_Show_CategoryItems['CouponItemCode']; ?>"></a>
            </div>
            <div class="PriceTag">SAR <?php echo $row_Rs_Show_CategoryItems['NewPrice']; ?></div> 

      </div>
 
    </div>
    </div>

    
    <?php } while ($row_Rs_Show_CategoryItems = mysql_fetch_assoc($Rs_Show_CategoryItems)); 
  }else{
	echo " Sorry No Items Found";  
  }?>

<!-- Start of Data Paging section -->
<div class="clear_all"></div>
<div class="DataPagination">

<table border="0">
  <tr>
    <td><?php if ($pageNum_Rs_Show_CategoryItems > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Rs_Show_CategoryItems=%d%s", $currentPage, 0, $queryString_Rs_Show_CategoryItems); ?>" class="First"></a>
        <?php } // Show if not first page 
				else { // Show if not first page ?>
       				 <a class="First" onclick="ShowErrorMessage('Sorry no further items found');"></a>
      	  <?php } // Show if not first page ?>        
        </td>
    <td><?php if ($pageNum_Rs_Show_CategoryItems > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Rs_Show_CategoryItems=%d%s", $currentPage, max(0, $pageNum_Rs_Show_CategoryItems - 1), $queryString_Rs_Show_CategoryItems); ?>" class="Previous"></a>
        <?php } // Show if not first page  
				else { // Show if not first page ?>
       				 <a class="Previous" onclick="ShowErrorMessage('Sorry no further items found');"></a>
      	  <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Rs_Show_CategoryItems < $totalPages_Rs_Show_CategoryItems) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Rs_Show_CategoryItems=%d%s", $currentPage, min($totalPages_Rs_Show_CategoryItems, $pageNum_Rs_Show_CategoryItems + 1), $queryString_Rs_Show_CategoryItems); ?>" class="Next"></a>
        <?php } // Show if not last page   
				else { // Show if not first page ?>
       				 <a class="Next" onclick="ShowErrorMessage('Sorry no further items found');"></a>
      	  <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Rs_Show_CategoryItems < $totalPages_Rs_Show_CategoryItems) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Rs_Show_CategoryItems=%d%s", $currentPage, $totalPages_Rs_Show_CategoryItems, $queryString_Rs_Show_CategoryItems); ?>" class="Last"></a>
        <?php } // Show if not last page    
				else { // Show if not first page ?>
       				 <a class="Last"  onclick="ShowErrorMessage('Sorry no further items found');"></a>
      	  <?php } // Show if not first page ?></td>
  </tr>
</table>
</div>
<!-- End of Data Paging Section -->
<?php
mysql_free_result($Rs_Show_CategoryItems);
?>
<?php 

if(file_exists("php_code_files/shopping_cart/add_item_cart_jquery_inc_ar.php")) {
		require_once('php_code_files/shopping_cart/add_item_cart_jquery_inc_ar.php'); 
   }else
   if(file_exists("../shopping_cart/add_item_cart_jquery_inc_ar.php")) {
		require_once('../shopping_cart/add_item_cart_jquery_inc_ar.php'); 
	  }