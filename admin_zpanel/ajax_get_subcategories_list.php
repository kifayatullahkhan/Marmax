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

$colname_RsGetSubCategoryList = "-1";
if (isset($_GET['CATID'])) {
  $colname_RsGetSubCategoryList = $_GET['CATID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RsGetSubCategoryList = sprintf("SELECT VSItemSubCATID, VSItemsSubCategoryName FROM vs_items_sub_category WHERE VSItemCATID = %s", GetSQLValueString($colname_RsGetSubCategoryList, "int"));
$RsGetSubCategoryList = mysql_query($query_RsGetSubCategoryList, $Conn) or die(mysql_error());
$row_RsGetSubCategoryList = mysql_fetch_assoc($RsGetSubCategoryList);
$totalRows_RsGetSubCategoryList = mysql_num_rows($RsGetSubCategoryList);

	if($totalRows_RsGetSubCategoryList>0){ 
	do {  
		   echo "<option value=\"". $row_RsGetSubCategoryList['VSItemSubCATID']."\">";        
		   echo $row_RsGetSubCategoryList['VSItemsSubCategoryName'] ."</option>";
     	} while ($row_RsGetSubCategoryList = mysql_fetch_assoc($RsGetSubCategoryList));	
	}else{		
       echo "<option value=\"0\">No Sub Cat Found</option>";
	}

mysql_free_result($RsGetSubCategoryList);
?>
