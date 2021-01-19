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
$query_Rs_GetDealsCouponsCategories = "SELECT * FROM vs_coupons_categories";
$Rs_GetDealsCouponsCategories = mysql_query($query_Rs_GetDealsCouponsCategories, $Conn) or die(mysql_error());
$row_Rs_GetDealsCouponsCategories = mysql_fetch_assoc($Rs_GetDealsCouponsCategories);
$totalRows_Rs_GetDealsCouponsCategories = mysql_num_rows($Rs_GetDealsCouponsCategories);
?> 

  <ul>
   <?php do { ?> 
    <!-- Start of Category Item -->
    <li class="MainMenu">
       <a href="" catid="<?php echo $row_Rs_GetDealsCouponsCategories['VSCouponsCATID']; ?>"> <?php echo $row_Rs_GetDealsCouponsCategories['VSCouponsCategoryName2']; ?> </a>
    </li>  
     <!-- End of Category Item -->                  
     <?php } while ($row_Rs_GetDealsCouponsCategories = mysql_fetch_assoc($Rs_GetDealsCouponsCategories)); ?>
 
  </ul>


 
<script type="text/javascript">
  
  $('.MainMenu a').click(function(event) {
           event.preventDefault();		   
		   var CatID=$(this).attr('catid');
		   var SubCatID=$(this).attr('subcatid');
			//alert("CatID="+CatID+" and "+ SubCatID);
		   $.get("php_code_files/virtual_stores/show_category_items.php?catid="+CatID+"&subcatid="+SubCatID, function(data){
			    $("#page_contents").html(data);		
				// Now Scrool Down to the Start of the Cat List
			   $('body,html').animate({
					scrollTop: 600
				}, 800); 
		   });	  

  });
 
</script>