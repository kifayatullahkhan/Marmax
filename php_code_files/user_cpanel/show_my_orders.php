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

$maxRows_Rs_GetMyOrders = 20;
$pageNum_Rs_GetMyOrders = 0;
if (isset($_GET['pageNum_Rs_GetMyOrders'])) {
  $pageNum_Rs_GetMyOrders = $_GET['pageNum_Rs_GetMyOrders'];
}
$startRow_Rs_GetMyOrders = $pageNum_Rs_GetMyOrders * $maxRows_Rs_GetMyOrders;

$colname_Rs_GetMyOrders = "-1";
if (isset($_SESSION['MM_UserID'])) {
  $colname_Rs_GetMyOrders = $_SESSION['MM_UserID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetMyOrders = sprintf("SELECT * FROM vs_customer_orders WHERE UserID = %s ORDER BY CustomerOrderID DESC", GetSQLValueString($colname_Rs_GetMyOrders, "int"));
$query_limit_Rs_GetMyOrders = sprintf("%s LIMIT %d, %d", $query_Rs_GetMyOrders, $startRow_Rs_GetMyOrders, $maxRows_Rs_GetMyOrders);
$Rs_GetMyOrders = mysql_query($query_limit_Rs_GetMyOrders, $Conn) or die(mysql_error());
$row_Rs_GetMyOrders = mysql_fetch_assoc($Rs_GetMyOrders);

if (isset($_GET['totalRows_Rs_GetMyOrders'])) {
  $totalRows_Rs_GetMyOrders = $_GET['totalRows_Rs_GetMyOrders'];
} else {
  $all_Rs_GetMyOrders = mysql_query($query_Rs_GetMyOrders);
  $totalRows_Rs_GetMyOrders = mysql_num_rows($all_Rs_GetMyOrders);
}
$totalPages_Rs_GetMyOrders = ceil($totalRows_Rs_GetMyOrders/$maxRows_Rs_GetMyOrders)-1;

$queryString_Rs_GetMyOrders = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Rs_GetMyOrders") == false && 
        stristr($param, "totalRows_Rs_GetMyOrders") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Rs_GetMyOrders = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Rs_GetMyOrders = sprintf("&totalRows_Rs_GetMyOrders=%d%s", $totalRows_Rs_GetMyOrders, $queryString_Rs_GetMyOrders);
?>
<div class="DetailView" >
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr class="header_row">
      <td>CustomerOrderID</td>
      <td>OrderReferenceNo</td>
      <td>OrderTimeStamp</td>
      <td>OrderStatus</td>
    </tr>
<?php 
	$RowNo=0;
	do {
		$RowNo++;
		if($RowNo%2==0)
		$data_row_class="data_row_even";
		else
		$data_row_class="data_row_odd";			
    ?>
      <tr  class="<?php echo $data_row_class; ?>">
      
        <td><?php echo $row_Rs_GetMyOrders['CustomerOrderID']; ?></td>
        <td><a href="show_my_order_details.php?OrderRefrenceID=<?php echo urlencode($row_Rs_GetMyOrders['OrderReferenceNo']); ?>"><?php echo $row_Rs_GetMyOrders['OrderReferenceNo']; ?></a></td>
        <td><?php echo $row_Rs_GetMyOrders['OrderTimeStamp']; ?></td>
        <td><?php echo $row_Rs_GetMyOrders['OrderStatus']; ?></td>
      </tr>
      <?php } while ($row_Rs_GetMyOrders = mysql_fetch_assoc($Rs_GetMyOrders)); ?>
  </table>
<div>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_Rs_GetMyOrders > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Rs_GetMyOrders=%s", $currentPage, 0, $queryString_Rs_GetMyOrders); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Rs_GetMyOrders > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Rs_GetMyOrders=%s", $currentPage, max(0, $pageNum_Rs_GetMyOrders - 1), $queryString_Rs_GetMyOrders); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Rs_GetMyOrders < $totalPages_Rs_GetMyOrders) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Rs_GetMyOrders=%s", $currentPage, min($totalPages_Rs_GetMyOrders, $pageNum_Rs_GetMyOrders + 1), $queryString_Rs_GetMyOrders); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_Rs_GetMyOrders < $totalPages_Rs_GetMyOrders) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Rs_GetMyOrders=%s", $currentPage, $totalPages_Rs_GetMyOrders, $queryString_Rs_GetMyOrders); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
</div>
</div>

<?php
mysql_free_result($Rs_GetMyOrders);
?>
