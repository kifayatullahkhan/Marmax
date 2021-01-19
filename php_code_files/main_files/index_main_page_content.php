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



$colname_Rs_GetPageContent = "-1";
$PageLinkTag="-1";
if (isset($_GET['PageID'])) {
  $colname_Rs_GetPageContent = $_GET['PageID'];
}else{
	
	if(isset($_GET['LinkTag'])) {
		//**********************************************************************
		// This code will check that the LinkTag Page is allredy existed or not
		//**********************************************************************
		$PageLinkTag=$_GET['LinkTag'];
		// Select Default Page if no Page has been Given
		mysql_select_db($database_Conn, $Conn);
		$query_Rs_GetDefaultPage = "SELECT PageID FROM cms_web_pages WHERE LinkTag = '$PageLinkTag'";
		$Rs_GetDefaultPage = mysql_query($query_Rs_GetDefaultPage, $Conn) or die(mysql_error());
		$row_Rs_GetDefaultPage = mysql_fetch_assoc($Rs_GetDefaultPage);
		$totalRows_Rs_GetDefaultPage = mysql_num_rows($Rs_GetDefaultPage);
 	   	if($row_Rs_GetDefaultPage['PageID']==NULL) {
						
						//******************************************************************************************
						// Linked Page Not Found
						//******************************************************************************************
		 	
						 $PageLinkTag="404error";  // Show Page Not Found 
						
						//******************************************************************************************
		}
			
	}else{
		//******************************************************************************************
		// Select Default Page if no Page has been Given
		//******************************************************************************************
		
		mysql_select_db($database_Conn, $Conn);
		$query_Rs_GetDefaultPage = "SELECT PageID FROM cms_web_pages WHERE IsDefault = 1";
		$Rs_GetDefaultPage = mysql_query($query_Rs_GetDefaultPage, $Conn) or die(mysql_error());
		$row_Rs_GetDefaultPage = mysql_fetch_assoc($Rs_GetDefaultPage);
		$totalRows_Rs_GetDefaultPage = mysql_num_rows($Rs_GetDefaultPage);
	
		if($row_Rs_GetDefaultPage['PageID']!=NULL) {
		 $colname_Rs_GetPageContent=$row_Rs_GetDefaultPage['PageID'];
		}
	}
	 	
	
}

mysql_select_db($database_Conn, $Conn);
if($PageLinkTag=="-1"){
$query_Rs_GetPageContent = sprintf("SELECT * FROM cms_web_pages WHERE PageID = %s", GetSQLValueString($colname_Rs_GetPageContent, "int"));
}else{
	$query_Rs_GetPageContent = sprintf("SELECT * FROM cms_web_pages WHERE LinkTag = %s", GetSQLValueString($PageLinkTag, "text"));
}
$Rs_GetPageContent = mysql_query($query_Rs_GetPageContent, $Conn) or die(mysql_error());
$row_Rs_GetPageContent = mysql_fetch_assoc($Rs_GetPageContent);
$totalRows_Rs_GetPageContent = mysql_num_rows($Rs_GetPageContent);

?>
<div id="PageCenterArea">
  <h3 id="why"><?php echo $row_Rs_GetPageContent['PageName']; ?></h3>
    <div id="CenterText">
    <?php echo $row_Rs_GetPageContent['PageText']; ?>
    </div>
</div>
<?php
@mysql_free_result($Rs_GetPageContent);
if(isset($Rs_GetDefaultPage)) mysql_free_result($Rs_GetDefaultPage);
?>
