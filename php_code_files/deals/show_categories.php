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
$query_Rs_GetvStoreCategories = "SELECT * FROM vs_coupons_categories";
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
                          <a href="" couponscatid="<?php echo $row_Rs_GetvStoreCategories['VSCouponsCATID'];  ?>" class="vscouponslink">
                          <?php if(isset($row_Rs_GetvStoreCategories['VSCouponsCategoryDisplayImage'])){?> 
                         <img src="images/categories/<?php echo $row_Rs_GetvStoreCategories['VSCouponsCategoryDisplayImage']; ?>">
                         <?php } ?>
                            <div class="Item_CategoryPopUpDetails griadent_saima">
                              <?php echo $row_Rs_GetvStoreCategories['VSCouponsCategoryName']; ?> 
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
			 	   
		   	var CatID=$(this).attr('couponscatid');		   	 
			$.get("php_code_files/deals/show_category_items.php?catid="+CatID, function(data){
					$("#page_contents").html(data);		 
			});		  

  });
 
</script>