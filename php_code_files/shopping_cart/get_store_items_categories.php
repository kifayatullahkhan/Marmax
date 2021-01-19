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

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetInventoryItemCategories = "SELECT * FROM erp_inventoryitemstypes";
$Rs_GetInventoryItemCategories = mysql_query($query_Rs_GetInventoryItemCategories, $Conn) or die(mysql_error());
$row_Rs_GetInventoryItemCategories = mysql_fetch_assoc($Rs_GetInventoryItemCategories);
$totalRows_Rs_GetInventoryItemCategories = mysql_num_rows($Rs_GetInventoryItemCategories);
?>
        <ul>
 
          <?php do { ?>
           <li><a href="#" class="red"><span><?php echo $row_Rs_GetInventoryItemCategories['InvItemTypeName']; ?></span></a></li>  
          
            <?php } while ($row_Rs_GetInventoryItemCategories = mysql_fetch_assoc($Rs_GetInventoryItemCategories)); ?>
 
        </ul>
<?php
mysql_free_result($Rs_GetInventoryItemCategories);
?>
