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
$query_Rs_GetProductsList = "SELECT ProductID, ProductName, ProductDescription,LinkTag  FROM products_list ORDER BY ProductName DESC";
$Rs_GetProductsList = mysql_query($query_Rs_GetProductsList, $Conn) or die(mysql_error());
$row_Rs_GetProductsList = mysql_fetch_assoc($Rs_GetProductsList);
$totalRows_Rs_GetProductsList = mysql_num_rows($Rs_GetProductsList);
?>

<div id="services">
  <h3>Products Detail &amp; Trial Downloads</h3>
            
             <ul><li>
             
             <?php
			 $Count=1;
			  do { ?>

              		<?php
					
	               if(($Count%5)==0) {
					 echo "<h4> <a href=\"?LinkTag=" .$row_Rs_GetProductsList['LinkTag']. "\">".ucfirst($row_Rs_GetProductsList['ProductName'])."</a></h4>"; 
					 echo "</li><li>";
				   }
				   else
					 {
 echo "<h4> <a href=\"?LinkTag=" .$row_Rs_GetProductsList['LinkTag']. "\">".ucfirst($row_Rs_GetProductsList['ProductName'])."</a></h4>";            		     }
                 $Count++;
					 ?>
  	
  <?php } while ($row_Rs_GetProductsList = mysql_fetch_assoc($Rs_GetProductsList)); ?>
		      </li> 
             </ul>
</div>
<?php
mysql_free_result($Rs_GetProductsList);
?>
