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

$colname_Rs_GetvStoreCategories = "-1";
if (isset($_GET['golobalcatid'])) {
  $colname_Rs_GetvStoreCategories = $_GET['golobalcatid'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetvStoreCategories = sprintf("SELECT * FROM vs_items_main_category WHERE VSItemCATID = %s", GetSQLValueString($colname_Rs_GetvStoreCategories, "int"));
$Rs_GetvStoreCategories = mysql_query($query_Rs_GetvStoreCategories, $Conn) or die(mysql_error());
$row_Rs_GetvStoreCategories = mysql_fetch_assoc($Rs_GetvStoreCategories);
$totalRows_Rs_GetvStoreCategories = mysql_num_rows($Rs_GetvStoreCategories);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetGlobalCategories = "SELECT * FROM vs_items_category";
$Rs_GetGlobalCategories = mysql_query($query_Rs_GetGlobalCategories, $Conn) or die(mysql_error());
$row_Rs_GetGlobalCategories = mysql_fetch_assoc($Rs_GetGlobalCategories);
$totalRows_Rs_GetGlobalCategories = mysql_num_rows($Rs_GetGlobalCategories);
?>

 
<div class="GlobalMenu">
<h3>Global Categories</h3>
<ul class="GlobalMenuItem">
  <?php do { ?>
 <li><a href="" golobalcatid="<?php echo $row_Rs_GetGlobalCategories['VSItemCATID']; ?>"  class="GlobalCategoryLink"><?php echo $row_Rs_GetGlobalCategories['VSItemCategoryName2']; ?></a></li>
      

    <?php } while ($row_Rs_GetGlobalCategories = mysql_fetch_assoc($Rs_GetGlobalCategories)); ?>
    
    </ul>
</div>

<!-- Start of Main Menus Loaded By Ajax -->
 
<!-- Start of Main Menus Loaded By Ajax -->
<div id="Main_Sub_Menus">
<?php require_once("ajax_get_sub_category_list_ar.php"); ?>
</div>
<!-- End of Main Menus Loaded By Ajax -->
<script type="text/javascript">
  
   $('.GlobalMenu a').click(function(event) {
           event.preventDefault();	
 		   var GlobalCatID=$(this).attr('golobalcatid'); 
			//alert("globalid="+GlobalCatID);
			 
		   $.get("php_code_files/virtual_stores/ajax_get_sub_category_list_ar.php?golobalcatid="+GlobalCatID, function(data){
			    $("#Main_Sub_Menus").html(data);	
		   });	  

  });
</script>


