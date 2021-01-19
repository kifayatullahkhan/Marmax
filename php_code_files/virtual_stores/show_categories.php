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

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetvStoreCategories = "SELECT * FROM vs_items_category";
$Rs_GetvStoreCategories = mysql_query($query_Rs_GetvStoreCategories, $Conn) or die(mysql_error());
$row_Rs_GetvStoreCategories = mysql_fetch_assoc($Rs_GetvStoreCategories);
$totalRows_Rs_GetvStoreCategories = mysql_num_rows($Rs_GetvStoreCategories);
?>
<div id="data_entry_form" class="round_borders">
	<?php do { ?>   
    <div id="item_categories"> 
        <div class="Item_Category_Display round_borders">
            <div class="Item_Category_DisplayBorder">
                     <div class="Item_CategoryImage">
                          <a href="" catid="<?php echo $row_Rs_GetvStoreCategories['VSItemCATID'];  ?>"  class="VSvirtualstorelink">
                         <img src="images/categories/<?php echo $row_Rs_GetvStoreCategories['CategoryDisplayImage']; ?>">
                            <div class="Item_CategoryPopUpDetails griadent_saima">
                              <?php echo $row_Rs_GetvStoreCategories['VSItemCategoryName2']; ?> 
                            </div>
                         </a>
                     </div>
            </div>
        </div>
    </div>
    <?php } while ($row_Rs_GetvStoreCategories = mysql_fetch_assoc($Rs_GetvStoreCategories)); ?>
</div>

<?php
mysql_free_result($Rs_GetvStoreCategories);
?>

<script type="text/javascript">
  
  $('#show_categories a').click(function(event) {
           event.preventDefault();		   
		   var CatID=$(this).attr('catid');  
			
		   $.get("php_code_files/virtual_stores/show_sub_categories.php?catid="+CatID, function(data){
			    $("#show_sub_categories").html(data);		 
		   });	  

  });
 
</script>
