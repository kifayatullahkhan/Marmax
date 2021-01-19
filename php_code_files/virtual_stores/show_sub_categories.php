<?php

if (file_exists("../../Connections/Conn.php")) {
    require_once("../../Connections/Conn.php");
}else if (file_exists("Connections/Conn.php")) {
    require_once("Connections/Conn.php");
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

$colname_Rs_GetvStoreCategories = "1";
if (isset($_GET['catid'])) {
  $colname_Rs_GetvStoreCategories = $_GET['catid'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetvStoreCategories = sprintf("SELECT * FROM vs_items_sub_category WHERE VSItemCATID = %s", GetSQLValueString($colname_Rs_GetvStoreCategories, "int"));
$Rs_GetvStoreCategories = mysql_query($query_Rs_GetvStoreCategories, $Conn) or die(mysql_error());
$row_Rs_GetvStoreCategories = mysql_fetch_assoc($Rs_GetvStoreCategories);
$totalRows_Rs_GetvStoreCategories = mysql_num_rows($Rs_GetvStoreCategories);
?>



<div id="data_entry_form" class="round_borders">
	
	<?php
	if($totalRows_Rs_GetvStoreCategories>0){
	 do { ?>   
    <div id="item_categories"> 
        <div class="Item_Sub_Category_Display">
             
                          
                          <a href="?catid=<?php echo $row_Rs_GetvStoreCategories['VSItemCATID']; ?>&subcatid=<?php echo $row_Rs_GetvStoreCategories['VSItemSubCATID']; ?>" subcatid="<?php echo $row_Rs_GetvStoreCategories['VSItemSubCATID']; ?>">
                          <div class="dot"> </div>
						  <?php echo $row_Rs_GetvStoreCategories['VSItemsSubCategoryName2']; ?>
 
                         </a>
                      
             
        </div>
    </div>
    <?php } while ($row_Rs_GetvStoreCategories = mysql_fetch_assoc($Rs_GetvStoreCategories));
	}else {
	echo "No sub-categories found";	
	}
	 ?>
</div>
<?php
mysql_free_result($Rs_GetvStoreCategories);
?>
