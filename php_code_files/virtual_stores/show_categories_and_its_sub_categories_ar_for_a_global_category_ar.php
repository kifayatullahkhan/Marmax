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

 
?>

 
<!-- Start of Main Menus Loaded By Ajax -->
<div id="Main_Sub_Menus">
<ul>
   <?php do { ?> 
     <!-- Start of Category Item -->
     <li class="MainMenu">
       <h3> <?php echo $row_Rs_GetvStoreCategories['VSItemMainCategoryName2']; ?></h3>
       <ul  class="SubMenus">
         <?php
	    // Code to Generate Sub Category List 
	 	$colname_RsGetSubCategories = $row_Rs_GetvStoreCategories['VSItemMainCATID']; 
		mysql_select_db($database_Conn, $Conn);
		$query_RsGetSubCategories = sprintf("SELECT * FROM vs_items_sub_category WHERE VSItemMainCATID = %s", GetSQLValueString($colname_RsGetSubCategories, "int"));
		$RsGetSubCategories = mysql_query($query_RsGetSubCategories, $Conn) or die(mysql_error());
		$row_RsGetSubCategories = mysql_fetch_assoc($RsGetSubCategories);
		$totalRows_RsGetSubCategories = mysql_num_rows($RsGetSubCategories);
		do { ?>
          <li><a href="" catid="<?php echo $row_Rs_GetvStoreCategories['VSItemMainCATID'];  ?>" subcatid="<?php echo $row_RsGetSubCategories['VSItemSubCATID']; ?>"  class="VSvirtualstorelink"><?php echo $row_RsGetSubCategories['VSItemSubCategoryName2']; ?></a></li>
          <?php } while ($row_RsGetSubCategories = mysql_fetch_assoc($RsGetSubCategories)); ?>
       </ul>
    </li>  
     <!-- End of Category Item -->
    <?php } while ($row_Rs_GetvStoreCategories = mysql_fetch_assoc($Rs_GetvStoreCategories)); ?>
</ul>



<script type="text/javascript">
  
  $('.SubMenus a').click(function(event) {
           event.preventDefault();		   
		   var CatID=$(this).attr('catid');
		   var SubCatID=$(this).attr('subcatid');
			//alert("CatID="+CatID+" and "+ SubCatID);
		   $.get("php_code_files/virtual_stores/show_category_items_<?php echo $_SESSION['ln'];?>.php?catid="+CatID+"&subcatid="+SubCatID, function(data){
			    $("#page_contents").html(data);		
				// Now Scrool Down to the Start of the Cat List
			   $('body,html').animate({
					scrollTop: 600
				}, 800); 
		   });	  

  });
  
</script>
<?php 
@mysql_free_result($RsGetSubCategories);
@mysql_free_result($Rs_GetvStoreCategories);

?>
</div>

