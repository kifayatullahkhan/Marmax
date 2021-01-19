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

$colname_Rs_GetMainCategoryList = "-1";
if (isset($_GET['MainCATID'])) {
  $colname_Rs_GetMainCategoryList = $_GET['MainCATID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetMainCategoryList = sprintf("SELECT * FROM   vs_items_sub_category WHERE VSItemMainCATID = %s", GetSQLValueString($colname_Rs_GetMainCategoryList, "int"));
$Rs_GetMainCategoryList = mysql_query($query_Rs_GetMainCategoryList, $Conn) or die(mysql_error());
$row_Rs_GetMainCategoryList = mysql_fetch_assoc($Rs_GetMainCategoryList);
$totalRows_Rs_GetMainCategoryList = mysql_num_rows($Rs_GetMainCategoryList);

	if($totalRows_Rs_GetMainCategoryList>0){ 
	do {  
		   echo "<option value=\"".$row_Rs_GetMainCategoryList['VSItemSubCATID'] ."\">";        
		   echo $row_Rs_GetMainCategoryList['VSItemSubCategoryName']."</option>";
     	} while ($row_Rs_GetMainCategoryList = mysql_fetch_assoc($Rs_GetMainCategoryList));	
	}else{		
       echo "<option value=\"0\">No Sub Cat Found</option>";
	}

mysql_free_result($Rs_GetMainCategoryList);
?>
