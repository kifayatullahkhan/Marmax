<?php 
if (!isset($_SESSION)) {
	session_start();	
}
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

if(file_exists('php_code_files/global_configurations_and_functions/global_define_constants.php')){ require_once('php_code_files/global_configurations_and_functions/global_define_constants.php'); }
if(file_exists('../php_code_files/global_configurations_and_functions/global_define_constants.php')){ require_once('../php_code_files/global_configurations_and_functions/global_define_constants.php'); }


if(file_exists('php_code_files/global_configurations_and_functions/global_functions.php')){ require_once('php_code_files/global_configurations_and_functions/global_functions.php'); }
if(file_exists('../php_code_files/global_configurations_and_functions/global_functions.php')){ require_once('../php_code_files/global_configurations_and_functions/global_functions.php'); }


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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	// Make Sure that All Required Form Fields are Fillled In
	
   $insertSQL = sprintf("INSERT INTO vs_users_virtual_stores_inventory (UserID, VSInvItemCode, VSInvItemName, VSInvItemShortDescription, VSInvItemDescription, VSInvItemName2, VSInvItemShortDescription2, VSInvItemDescription2, ActualPrice, DescountPercentage, VSInvItemSalesPrice, VSStockPositionQuantity, VSWarningLevelStockPositionQty, VSItemCATID, VSItemMainCATID, VSItemSubCATID,  DisplayImage, GallaryImage1, GallaryImage2, GallaryImage3, GallaryImage4, GallaryImage5, GallaryImage6,TargetedGroupID,BrandID) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,  %s,  %s, %s)",
                       GetSQLValueString($_SESSION['MM_UserID'], "int"),
                       GetSQLValueString($_POST['VSInvItemCode'], "text"),
                       GetSQLValueString($_POST['VSInvItemName'], "text"),
                       GetSQLValueString($_POST['VSInvItemShortDescription'], "text"),
                       GetSQLValueString($_POST['VSInvItemDescription'], "text"),
                       GetSQLValueString($_POST['VSInvItemName2'], "text"),
                       GetSQLValueString($_POST['VSInvItemShortDescription2'], "text"),
                       GetSQLValueString($_POST['VSInvItemDescription2'], "text"),
                       GetSQLValueString($_POST['ActualPrice'], "double"),
                       GetSQLValueString($_POST['DescountPercentage'], "int"),
                       GetSQLValueString($_POST['VSInvItemSalesPrice'], "double"),
                       GetSQLValueString($_POST['VSStockPositionQuantity'], "int"),
                       GetSQLValueString($_POST['VSWarningLevelStockPositionQty'], "int"),
                       GetSQLValueString($_POST['GlobalCategoryListID'], "int"),
                       GetSQLValueString($_POST['VSItemMainCATID'], "int"),
                       GetSQLValueString($_POST['VSItemSubCATID'], "int"),
                       GetSQLValueString(is_uploaded_file($_FILES['DisplayImage']['tmp_name'])?fnUploadFileToPath($_FILES['DisplayImage']['tmp_name'],$_FILES['DisplayImage']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH):"none.jpg", "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage1']['tmp_name'],$_FILES['GallaryImage1']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage2']['tmp_name'],$_FILES['GallaryImage2']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage3']['tmp_name'],$_FILES['GallaryImage3']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage4']['tmp_name'],$_FILES['GallaryImage4']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage5']['tmp_name'],$_FILES['GallaryImage5']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage6']['tmp_name'],$_FILES['GallaryImage6']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
					   GetSQLValueString($_POST['TargetedGroupID'], "int"),
					   GetSQLValueString($_POST['BrandID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());

}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE vs_users_virtual_stores_inventory SET VSInvItemCode=%s, VSInvItemName=%s, VSInvItemName2=%s, VSInvItemShortDescription=%s, VSInvItemDescription=%s, VSInvItemShortDescription2=%s, VSInvItemDescription2=%s, ActualPrice=%s, DescountPercentage=%s, VSInvItemSalesPrice=%s, VSStockPositionQuantity=%s, VSWarningLevelStockPositionQty=%s, VSItemCATID=%s, VSItemMainCATID=%s, VSItemSubCATID=%s, DisplayImage=%s, GallaryImage1=%s, GallaryImage2=%s, GallaryImage3=%s, GallaryImage4=%s, GallaryImage5=%s, GallaryImage6=%s TargetedGroupID=%s BrandID=%s WHERE VSInvItemID=%s",
                       GetSQLValueString($_POST['VSInvItemCode'], "text"),
                       GetSQLValueString($_POST['VSInvItemName'], "text"),
                       GetSQLValueString($_POST['VSInvItemName2'], "text"),
                       GetSQLValueString($_POST['VSInvItemShortDescription'], "text"),
                       GetSQLValueString($_POST['VSInvItemDescription'], "text"),
                       GetSQLValueString($_POST['VSInvItemShortDescription2'], "text"),
                       GetSQLValueString($_POST['VSInvItemDescription2'], "text"),
                       GetSQLValueString($_POST['ActualPrice'], "double"),
                       GetSQLValueString($_POST['DescountPercentage'], "int"),
                       GetSQLValueString($_POST['VSInvItemSalesPrice'], "double"),
                       GetSQLValueString($_POST['VSStockPositionQuantity'], "int"),
                       GetSQLValueString($_POST['VSWarningLevelStockPositionQty'], "int"),
                       GetSQLValueString($_POST['GlobalCategoryListID'], "int"),
                       GetSQLValueString($_POST['VSItemMainCATID'], "int"),
                       GetSQLValueString($_POST['VSItemSubCATID'], "int"),
                       GetSQLValueString($_POST['DisplayImage'], "text"),
                       GetSQLValueString($_POST['GallaryImage1'], "text"),
                       GetSQLValueString($_POST['GallaryImage2'], "text"),
                       GetSQLValueString($_POST['GallaryImage3'], "text"),
                       GetSQLValueString($_POST['GallaryImage4'], "text"),
                       GetSQLValueString($_POST['GallaryImage5'], "text"),
                       GetSQLValueString($_POST['GallaryImage6'], "text"),
					   GetSQLValueString($_POST['TargetedGroupID'], "int"),
 					   GetSQLValueString($_POST['BrandID'], "int"),
                       GetSQLValueString($_POST['VSInvItemID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM vs_users_virtual_stores_inventory WHERE VSInvItemID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

$maxRows_Rs_GetItemsList = 100;
$pageNum_Rs_GetItemsList = 0;
if (isset($_GET['pageNum_Rs_GetItemsList'])) {
  $pageNum_Rs_GetItemsList = $_GET['pageNum_Rs_GetItemsList'];
}
$startRow_Rs_GetItemsList = $pageNum_Rs_GetItemsList * $maxRows_Rs_GetItemsList;

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetItemsList = "SELECT  distinct vs_users_virtual_stores_inventory.VSInvItemID, vs_users_virtual_stores_inventory.UserID, vs_users_virtual_stores_inventory.VSInvItemCode, vs_users_virtual_stores_inventory.VSInvItemName, vs_users_virtual_stores_inventory.VSInvItemName2, vs_users_virtual_stores_inventory.VSInvItemShortDescription, vs_users_virtual_stores_inventory.ActualPrice, vs_users_virtual_stores_inventory.DescountPercentage, vs_users_virtual_stores_inventory.VSInvItemSalesPrice, vs_users_virtual_stores_inventory.VSStockPositionQuantity, vs_users_virtual_stores_inventory.PostDateTime, vs_items_category.VSItemCategoryName, vs_items_sub_category.VSItemSubCategoryName FROM  vs_users_virtual_stores_inventory, vs_items_category, vs_items_sub_category WHERE vs_users_virtual_stores_inventory.VSItemCATID=vs_items_category.VSItemCATID AND vs_users_virtual_stores_inventory.VSItemSubCATID = vs_users_virtual_stores_inventory.VSItemSubCATID  =vs_items_sub_category.VSItemSubCATID ORDER BY VSInvItemID DESC";
$query_limit_Rs_GetItemsList = sprintf("%s LIMIT %d, %d", $query_Rs_GetItemsList, $startRow_Rs_GetItemsList, $maxRows_Rs_GetItemsList);
$Rs_GetItemsList = mysql_query($query_limit_Rs_GetItemsList, $Conn) or die(mysql_error());
$row_Rs_GetItemsList = mysql_fetch_assoc($Rs_GetItemsList);

if (isset($_GET['totalRows_Rs_GetItemsList'])) {
  $totalRows_Rs_GetItemsList = $_GET['totalRows_Rs_GetItemsList'];
} else {
  $all_Rs_GetItemsList = mysql_query($query_Rs_GetItemsList);
  $totalRows_Rs_GetItemsList = mysql_num_rows($all_Rs_GetItemsList);
}
$totalPages_Rs_GetItemsList = ceil($totalRows_Rs_GetItemsList/$maxRows_Rs_GetItemsList)-1;$maxRows_Rs_GetItemsList = 100;
$pageNum_Rs_GetItemsList = 0;
if (isset($_GET['pageNum_Rs_GetItemsList'])) {
  $pageNum_Rs_GetItemsList = $_GET['pageNum_Rs_GetItemsList'];
}
$startRow_Rs_GetItemsList = $pageNum_Rs_GetItemsList * $maxRows_Rs_GetItemsList;

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetItemsList = "SELECT  vs_users_virtual_stores_inventory.*,  vs_items_category.VSItemCategoryName, vs_items_main_category.VSItemMainCategoryName, vs_items_sub_category.VSItemSubCategoryName FROM vs_users_virtual_stores_inventory, vs_items_category, vs_items_main_category, vs_items_sub_category WHERE  vs_users_virtual_stores_inventory.VSItemCATID = vs_items_category.VSItemCATID  AND  vs_users_virtual_stores_inventory.VSItemMainCATID = vs_items_main_category.VSItemMainCATID AND  vs_users_virtual_stores_inventory.VSItemSubCATID=vs_items_sub_category.VSItemSubCATID";
$query_limit_Rs_GetItemsList = sprintf("%s LIMIT %d, %d", $query_Rs_GetItemsList, $startRow_Rs_GetItemsList, $maxRows_Rs_GetItemsList);
$Rs_GetItemsList = mysql_query($query_limit_Rs_GetItemsList, $Conn) or die(mysql_error());
$row_Rs_GetItemsList = mysql_fetch_assoc($Rs_GetItemsList);

if (isset($_GET['totalRows_Rs_GetItemsList'])) {
  $totalRows_Rs_GetItemsList = $_GET['totalRows_Rs_GetItemsList'];
} else {
  $all_Rs_GetItemsList = mysql_query($query_Rs_GetItemsList);
  $totalRows_Rs_GetItemsList = mysql_num_rows($all_Rs_GetItemsList);
}
$totalPages_Rs_GetItemsList = ceil($totalRows_Rs_GetItemsList/$maxRows_Rs_GetItemsList)-1;

mysql_select_db($database_Conn, $Conn);
$query_Rs_Categories = "SELECT VSItemCATID, VSItemCategoryName FROM vs_items_category ORDER BY VSItemCATID DESC";
$Rs_Categories = mysql_query($query_Rs_Categories, $Conn) or die(mysql_error());
$row_Rs_Categories = mysql_fetch_assoc($Rs_Categories);
$totalRows_Rs_Categories = mysql_num_rows($Rs_Categories);

$colname_RsGetSelectedItem = "-1";
if (isset($_GET['EditID'])) {
  $colname_RsGetSelectedItem = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RsGetSelectedItem = sprintf("SELECT * FROM vs_users_virtual_stores_inventory WHERE VSInvItemID = %s", GetSQLValueString($colname_RsGetSelectedItem, "int"));
$RsGetSelectedItem = mysql_query($query_RsGetSelectedItem, $Conn) or die(mysql_error());
$row_RsGetSelectedItem = mysql_fetch_assoc($RsGetSelectedItem);
$totalRows_RsGetSelectedItem = mysql_num_rows($RsGetSelectedItem);

mysql_select_db($database_Conn, $Conn);
$query_RsGetTargetedGroup = "SELECT * FROM vs_targetedgroup ORDER BY TargetedGroupID ASC";
$RsGetTargetedGroup = mysql_query($query_RsGetTargetedGroup, $Conn) or die(mysql_error());
$row_RsGetTargetedGroup = mysql_fetch_assoc($RsGetTargetedGroup);
$totalRows_RsGetTargetedGroup = mysql_num_rows($RsGetTargetedGroup);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetBrands = "SELECT * FROM vs_brands ORDER BY BrandName ASC";
$Rs_GetBrands = mysql_query($query_Rs_GetBrands, $Conn) or die(mysql_error());
$row_Rs_GetBrands = mysql_fetch_assoc($Rs_GetBrands);
$totalRows_Rs_GetBrands = mysql_num_rows($Rs_GetBrands);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetMainCategoryID = "SELECT * FROM vs_items_main_category ORDER BY VSItemMainCategoryName ASC";
$Rs_GetMainCategoryID = mysql_query($query_Rs_GetMainCategoryID, $Conn) or die(mysql_error());
$row_Rs_GetMainCategoryID = mysql_fetch_assoc($Rs_GetMainCategoryID);
$totalRows_Rs_GetMainCategoryID = mysql_num_rows($Rs_GetMainCategoryID);

$queryString_Rs_GetItemsList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Rs_GetItemsList") == false && 
        stristr($param, "totalRows_Rs_GetItemsList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Rs_GetItemsList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Rs_GetItemsList = sprintf("&totalRows_Rs_GetItemsList=%d%s", $totalRows_Rs_GetItemsList, $queryString_Rs_GetItemsList);
?>



  <!-- Start of section_wrapper -->
  <?php if ($totalRows_RsGetSelectedItem == 0) { // Show if recordset empty ?>
   <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
   <div class="DataEntryForm">
     <div class="box_like_section_wrapper">
    <h2> Add New Item </h2>
    <table width="100%">
        <tr valign="baseline">
          <td width="15%">Global Category:</td>
          <td width="16%">Main Gategory</td>
          <td width="28%">SubCat:</td>
          <td width="23%">Item Code:</td>
          </tr>
        <tr valign="baseline">
          <td><select name="GlobalCategoryListID" id="GlobalCategoryListID">
            <?php 
do {  
?>
            <option value="<?php echo $row_Rs_Categories['VSItemCATID']?>" ><?php echo $row_Rs_Categories['VSItemCategoryName']?></option>
            <?php
} while ($row_Rs_Categories = mysql_fetch_assoc($Rs_Categories));
?>
            </select>    
            </td>
          <td><select name="VSItemMainCATID" id="VSItemMainCATID">
            <?php
do {  
?>
            <option value="<?php echo $row_Rs_GetMainCategoryID['VSItemMainCATID']?>"><?php echo $row_Rs_GetMainCategoryID['VSItemMainCategoryName']?></option>
            <?php
} while ($row_Rs_GetMainCategoryID = mysql_fetch_assoc($Rs_GetMainCategoryID));
  $rows = mysql_num_rows($Rs_GetMainCategoryID);
  if($rows > 0) {
      mysql_data_seek($Rs_GetMainCategoryID, 0);
	  $row_Rs_GetMainCategoryID = mysql_fetch_assoc($Rs_GetMainCategoryID);
  }
?>
          </select></td>
          <td><select name="VSItemSubCATID" id="VSItemSubCATID">
            <option value="0">None</option>
          </select></td>
          <td><input type="text" name="VSInvItemCode" value="" size="32" /></td>
          </tr>
        <tr valign="baseline">
          <td>Brand Name</td>
          <td>Targeted Group</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        <tr valign="baseline">
          <td><select name="BrandID" id="BrandID">
            <?php
do {  
?>
            <option value="<?php echo $row_Rs_GetBrands['BrandID']?>"><?php echo $row_Rs_GetBrands['BrandName']?></option>
            <?php
} while ($row_Rs_GetBrands = mysql_fetch_assoc($Rs_GetBrands));
  $rows = mysql_num_rows($Rs_GetBrands);
  if($rows > 0) {
      mysql_data_seek($Rs_GetBrands, 0);
	  $row_Rs_GetBrands = mysql_fetch_assoc($Rs_GetBrands);
  }
?>
          </select></td>
          <td><select name="TargetedGroupID" id="TargetedGroupID">
            <?php
do {  
?>
            <option value="<?php echo $row_RsGetTargetedGroup['TargetedGroupID']?>"><?php echo $row_RsGetTargetedGroup['TargetedGroup']?></option>
            <?php
} while ($row_RsGetTargetedGroup = mysql_fetch_assoc($RsGetTargetedGroup));
  $rows = mysql_num_rows($RsGetTargetedGroup);
  if($rows > 0) {
      mysql_data_seek($RsGetTargetedGroup, 0);
	  $row_RsGetTargetedGroup = mysql_fetch_assoc($RsGetTargetedGroup);
  }
?>
          </select></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
          </table>
      </div>
     </div>
          
  
   <div class="DataEntryForm SplitScreenWrapper" >
     <div class="box_like_section_wrapper">
    <h2> Item Description </h2>
    <table width="100%">
        <tr valign="baseline">
          <td align="left">Item Name:</td>
          <td align="left">Short Description:</td>
        </tr>
        <tr valign="baseline">
          <td align="left"><input type="text" name="VSInvItemName" value="" size="32" /></td>
          <td align="left"><input type="text" name="VSInvItemShortDescription" value="" size="32" /></td>
      </tr>
        <tr valign="baseline">
          <td align="left">Description:</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td colspan="2" align="left"><textarea name="VSInvItemDescription"></textarea></td>
          </tr>
        </table>
     </div>
     </div>
 <div class="DataEntryForm SplitScreenWrapper">
   <div class="box_like_section_wrapper">
    <h2> Item Description (Arabic) </h2>
    <table width="100%">
        <tr valign="baseline">
          <td align="right">Item Name (Arabic):</td>
          <td align="right">ShortDescription(Arabic):</td>
          </tr>
        <tr valign="baseline">
          <td align="right"><input type="text" name="VSInvItemName2" value="" size="32" /></td>
          <td align="right"><input type="text" name="VSInvItemShortDescription2" value="" size="32" /></td>
          </tr>
        <tr valign="baseline">
          <td align="right">&nbsp;</td>
          <td align="right">Description (Arabic):</td>
        </tr>
        <tr valign="baseline">
          <td colspan="2" align="right"><textarea name="VSInvItemDescription2"></textarea></td>
          </tr>
        </table>
      </div>
      </div>
	<div class="clear_all"></div>
   <div class="DataEntryForm">
     <div class="box_like_section_wrapper">
    <h2> Item Pricing </h2>
    <table width="100%">      
        <tr valign="baseline">
          <td>ActualPrice:</td>
          <td>Descount%:</td>
          <td>Sales Price:</td>
      </tr>
        <tr valign="baseline">
          <td><input type="text" name="ActualPrice" size="32" /></td>
          <td><input type="text" name="DescountPercentage" size="32" /></td>
          <td><input type="text" name="VSInvItemSalesPrice" size="32" /></td>
      </tr>
        <tr valign="baseline">
          <td>Stock</td>
          <td>Warning</td>
          <td>&nbsp;</td>
      </tr>
        <tr valign="baseline">
          <td><input type="text" name="VSStockPositionQuantity" size="32" /></td>
          <td><input type="text" name="VSWarningLevelStockPositionQty" size="32" /></td>
          <td>&nbsp;</td>
      </tr>
      </table>
      </div>
      </div>


   <div class="DataEntryForm">
     <div class="box_like_section_wrapper">
    <h2> Item Image Gallery </h2>
    <table width="100%">      
        <tr valign="baseline">
          <td>Display Image:</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
      </tr>
        <tr valign="baseline">
          <td><input type="file" name="DisplayImage" value="" size="32" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
      </tr>
        <tr valign="baseline">
          <td>Gallary Image1:</td>
          <td>Gallary Image2:</td>
          <td>Gallary Image3:</td>
      </tr>
        <tr valign="baseline">
          <td><input type="file" name="GallaryImage1" value="" size="32" c /></td>
          <td><input type="file" name="GallaryImage2" value="" size="32" /></td>
          <td><input type="file" name="GallaryImage3" value="" size="32" /></td>
      </tr>
        <tr valign="baseline">
          <td>Gallary Image4:</td>
          <td>Gallary Image5:</td>
          <td>Gallary Image6:</td>
      </tr>
        <tr valign="baseline">
          <td><input type="file" name="GallaryImage4" value="" size="32" /></td>
          <td><input type="file" name="GallaryImage5" value="" size="32" /></td>
          <td><input type="file" name="GallaryImage6" value="" size="32" /></td>
      </tr>
        <tr valign="baseline">
          <td><input name="BtnSave" type="submit" id="BtnSave" value="Save" class="button_misbah" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
      </tr>
     </table>
      <input type="hidden" name="MM_insert" value="form1" />

    
  </div>
  </div>
    </form>
  <?php } // Show if recordset empty ?>
<!-- End of section_wrapper-->


   <!-- Start Edit Selected Category -->
   <?php if ($totalRows_RsGetSelectedItem > 0) { // Show if recordset not empty ?>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <div class="DataEntryForm">
    <div class="box_like_section_wrapper"> 
       <h2> Update Item Details </h2>
       
         <table width="100%">
           <tr valign="baseline">
             <td width="19%" nowrap="nowrap">Choose Category</td>
             <td width="19%">Choose Sub Category</td>
             <td width="27%">Item Code</td>
             <td width="18%">Brand Name</td>
             <td width="17%">Targeted Group</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap"><select name="VSItemCATID" id="VSItemCATID">
               <?php 
do {  
?>
               <option value="<?php echo $row_Rs_Categories['VSItemCATID']?>" <?php if (!(strcmp($row_Rs_Categories['VSItemCATID'], htmlentities($row_RsGetSelectedItem['VSItemCATID'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_Rs_Categories['VSItemCategoryName']?></option>
               <?php
} while ($row_Rs_Categories = mysql_fetch_assoc($Rs_Categories));
?>
             </select></td>
             <td><select name="VSItemSubCATID" id="VSItemSubCATID">
               <option value="0" <?php if (!(strcmp(0, htmlentities($row_RsGetSelectedItem['VSItemSubCATID'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>>None</option>
             </select></td>
             <td><input type="text" name="VSInvItemCode" value="<?php echo htmlentities($row_RsGetSelectedItem['VSInvItemCode'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><select name="BrandID" id="BrandID">
               <?php
do {  
?>
               <option value="<?php echo $row_Rs_GetBrands['BrandID']?>"<?php if (!(strcmp($row_Rs_GetBrands['BrandID'], $row_RsGetSelectedItem['BrandID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Rs_GetBrands['BrandName']?></option>
               <?php
} while ($row_Rs_GetBrands = mysql_fetch_assoc($Rs_GetBrands));
  $rows = mysql_num_rows($Rs_GetBrands);
  if($rows > 0) {
      mysql_data_seek($Rs_GetBrands, 0);
	  $row_Rs_GetBrands = mysql_fetch_assoc($Rs_GetBrands);
  }
?>
             </select></td>
             <td><select name="TargetedGroupID" id="TargetedGroupID">
               <?php
do {  
?>
               <option value="<?php echo $row_RsGetTargetedGroup['TargetedGroupID']?>"<?php if (!(strcmp($row_RsGetTargetedGroup['TargetedGroupID'], $row_RsGetSelectedItem['TargetedGroupID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RsGetTargetedGroup['TargetedGroup']?></option>
               <?php
} while ($row_RsGetTargetedGroup = mysql_fetch_assoc($RsGetTargetedGroup));
  $rows = mysql_num_rows($RsGetTargetedGroup);
  if($rows > 0) {
      mysql_data_seek($RsGetTargetedGroup, 0);
	  $row_RsGetTargetedGroup = mysql_fetch_assoc($RsGetTargetedGroup);
  }
?>
          </select></td>
           </tr>
          
      </table>
        </div>
      </div>
    <div class="DataEntryForm SplitScreenWrapper">
    <div class="box_like_section_wrapper"> 
      <h2> Update Item Description </h2>       
         <table width="100%">
           <tr valign="baseline">
             <td nowrap="nowrap">Item Name</td>
             <td>Short Description</td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap"><input type="text" name="VSInvItemName" value="<?php echo htmlentities($row_RsGetSelectedItem['VSInvItemName'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="text" name="VSInvItemShortDescription" value="<?php echo htmlentities($row_RsGetSelectedItem['VSInvItemShortDescription'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap">Description</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td colspan="2" nowrap="nowrap"><textarea name="VSInvItemDescription"><?php echo htmlentities($row_RsGetSelectedItem['VSInvItemDescription'], ENT_COMPAT, ''); ?></textarea></td>
             <td>&nbsp;</td>
           </tr>
           </table>
             </div>
           </div>
  <div class="DataEntryForm SplitScreenWrapper">
    <div class="box_like_section_wrapper"> 
       <h2> Update Item Description (Arabic)</h2>       
         <table width="100%">
           <tr valign="baseline">
             <td nowrap="nowrap">Item Name (Arabic):</td>
             <td>Short Description (Arabic)</td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap"><input type="text" name="VSInvItemName2" value="<?php echo htmlentities($row_RsGetSelectedItem['VSInvItemName2'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="text" name="VSInvItemShortDescription2" value="<?php echo htmlentities($row_RsGetSelectedItem['VSInvItemShortDescription2'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap">Description (Arabic)</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td colspan="3" nowrap="nowrap"><textarea name="VSInvItemDescription2"><?php echo htmlentities($row_RsGetSelectedItem['VSInvItemDescription2'], ENT_COMPAT, ''); ?></textarea></td>
           </tr>
           </table>
             </div>
           </div>
	<div class="clear_all"></div>           
  <div class="DataEntryForm">
    <div class="box_like_section_wrapper"> 
       <h2> Update Item Pricing &amp; Stock</h2>       
         <table width="100%">           
           <tr valign="baseline">
             <td nowrap="nowrap">Actua Price</td>
             <td>Descount Percentage</td>
             <td>Sales Price</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap"><input type="text" name="ActualPrice" value="<?php echo htmlentities($row_RsGetSelectedItem['ActualPrice'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="text" name="DescountPercentage" value="<?php echo htmlentities($row_RsGetSelectedItem['DescountPercentage'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="text" name="VSInvItemSalesPrice" value="<?php echo htmlentities($row_RsGetSelectedItem['VSInvItemSalesPrice'], ENT_COMPAT, ''); ?>" size="32" /></td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap">Stock</td>
             <td>Warning</td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap"><input type="text" name="VSStockPositionQuantity" value="<?php echo htmlentities($row_RsGetSelectedItem['VSStockPositionQuantity'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="text" name="VSWarningLevelStockPositionQty" value="<?php echo htmlentities($row_RsGetSelectedItem['VSWarningLevelStockPositionQty'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td>&nbsp;</td>
           </tr>
           </table>
             </div>
           </div>
  <div class="DataEntryForm">
    <div class="box_like_section_wrapper"> 
       <h2> Update Item Image Gallery </h2>       
         <table width="100%">           
           <tr valign="baseline">
             <td nowrap="nowrap">Display Image</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap"><input type="file" name="DisplayImage" value="<?php echo htmlentities($row_RsGetSelectedItem['DisplayImage'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap">Gallary Image1</td>
             <td>Gallary Image2</td>
             <td>Gallary Image3</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap"><input type="file" name="GallaryImage1" value="<?php echo htmlentities($row_RsGetSelectedItem['GallaryImage1'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="file" name="GallaryImage2" value="<?php echo htmlentities($row_RsGetSelectedItem['GallaryImage2'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="file" name="GallaryImage3" value="<?php echo htmlentities($row_RsGetSelectedItem['GallaryImage3'], ENT_COMPAT, ''); ?>" size="32" /></td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap">Gallary Image4</td>
             <td>Gallary Image5</td>
             <td>Gallary Image6</td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap"><input type="file" name="GallaryImage4" value="<?php echo htmlentities($row_RsGetSelectedItem['GallaryImage4'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="file" name="GallaryImage5" value="<?php echo htmlentities($row_RsGetSelectedItem['GallaryImage5'], ENT_COMPAT, ''); ?>" size="32" /></td>
             <td><input type="file" name="GallaryImage6" value="<?php echo htmlentities($row_RsGetSelectedItem['GallaryImage6'], ENT_COMPAT, ''); ?>" size="32" /></td>
           </tr>
           <tr valign="baseline">
             <td nowrap="nowrap">&nbsp;</td>
             <td><input type="submit" value="Save Changes"  class="button_misbah"/></td>
             <td>&nbsp;</td>
           </tr>
         </table>
         <input type="hidden" name="MM_update" value="form2" />
         <input type="hidden" name="VSInvItemID" value="<?php echo $row_RsGetSelectedItem['VSInvItemID']; ?>" />


	 </div>
</div>
         </form>
     <?php } // Show if recordset not empty ?>
<!-- End of section_wrapper -->
 

<!-- End of Data Entery Form -->

<!-- Start of Detail View -->
<div class="DetailView" >
<div class="box_like_section_wrapper"> 
<h2> Items List </h2> 
<table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr class="header_row">
    <td colspan="2">Action</td>
    <td>UserID</td>
    <td>Code</td>
    <td>Name</td>
    <td>Name (Arabic)</td>
    <td>Short Description</td>
    <td>Actual Price</td>
    <td>Descount %</td>
    <td>Sales Price</td>
    <td>Stock Position</td>
    <td>Post Date</td>
    <td>Global Category Name</td>
    <td>Main Category</td>
    <td>Sub Category Name</td>
  </tr>
<?php 
	$RowNo=0;
	do {
		$RowNo++;
		if($RowNo%2==0)
		$data_row_class="data_row_even";
		else
		$data_row_class="data_row_odd";			
    ?>
      <tr  class="<?php echo $data_row_class; ?>">
      
      
             <td><a href="#" class="ajax_link" ActionMenu="Delete" SelectedRecordID="<?php echo $row_Rs_GetItemsList['VSInvItemID']; ?>"><img src="images/admin_zpanel/icons/delete.gif" alt="Delete" name="Delete" width="16" height="16" id="Delete" /></a></td>
        <td><a href="#"  class="ajax_link" ActionMenu="Edit" SelectedRecordID="<?php echo $row_Rs_GetItemsList['VSInvItemID']; ?>" ><img src="images/admin_zpanel/icons/edit.gif" alt="Edit" name="Edit" width="16" height="16" id="Edit" /></a></td>
      <td><?php echo $row_Rs_GetItemsList['UserID']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSInvItemCode']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSInvItemName']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSInvItemName2']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSInvItemShortDescription']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['ActualPrice']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['DescountPercentage']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSInvItemSalesPrice']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSStockPositionQuantity']; ?></td>
      <td><?php echo date_format(date_create($row_Rs_GetItemsList['PostDateTime']),"y-m-d"); ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSItemCategoryName']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSItemMainCategoryName']; ?></td>
      <td><?php echo $row_Rs_GetItemsList['VSItemSubCategoryName']; ?></td>
    </tr>
      <?php } while ($row_Rs_GetItemsList = mysql_fetch_assoc($Rs_GetItemsList)); ?>
</table>
    <div class="record_pagination">
      <table border="0">
        <tr>
          <td><?php if ($pageNum_Rs_GetItemsList > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Rs_GetItemsList=%d%s", $currentPage, 0, $queryString_Rs_GetItemsList); ?>">First</a>
              <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_Rs_GetItemsList > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_Rs_GetItemsList=%d%s", $currentPage, max(0, $pageNum_Rs_GetItemsList - 1), $queryString_Rs_GetItemsList); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
          <td><?php if ($pageNum_Rs_GetItemsList < $totalPages_Rs_GetItemsList) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_Rs_GetItemsList=%d%s", $currentPage, min($totalPages_Rs_GetItemsList, $pageNum_Rs_GetItemsList + 1), $queryString_Rs_GetItemsList); ?>">Next</a>
              <?php } // Show if not last page ?></td>
          <td><?php if ($pageNum_Rs_GetItemsList < $totalPages_Rs_GetItemsList) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_Rs_GetItemsList=%d%s", $currentPage, $totalPages_Rs_GetItemsList, $queryString_Rs_GetItemsList); ?>">Last</a>
              <?php } // Show if not last page ?></td>
        </tr>
      </table>
    </div>
    </div>    

<!-- End of Details View -->

 
<script type="text/javascript">

// Load the Main Categroy for the Selected Global Category 
  $("#GlobalCategoryListID").change(function (event) {
           event.preventDefault();	
		    var GlobalCATID=$("#GlobalCategoryListID option:selected").val();
			//alert("CatID="+GlobalCATID);
		   $.get("admin_zpanel/ajax_get_main_category_list_for_selected_global_category.php?GlobalCATID="+GlobalCATID, function(data){
			    $("#VSItemMainCATID").html(data); 
		   });	  

  }).change();
 
// Load the Sub Category List for the Selected Main Category   
  $("#VSItemMainCATID").change(function (event) {
           event.preventDefault();	
		    var MainCATID=$("#VSItemMainCATID option:selected").val();
			//alert("CatID="+CatID);
		   $.get("admin_zpanel/ajax_get_sub_category_list_for_selected_main_category.php?MainCATID="+MainCATID, function(data){
			    $("#VSItemSubCATID").html(data); 
		   });	  

  }).change();
 


$(".DetailView a.ajax_link").click(function(event) {
  event.preventDefault();
//page_contents
	
 
	 var ActionMenu=$(this).attr('ActionMenu');  
	 var SelectedRecordID=$(this).attr('SelectedRecordID'); 
	 //alert("ActionMenu="+ActionMenu);
	 //alert("SelectedRecordID="+SelectedRecordID);
		   switch (ActionMenu) {
                    case "Edit":
					if(confirm('Are you sure to edit this record')){
							 $.get("admin_zpanel/vs_users_virtual_stores_inventory_management.php?EditID="+SelectedRecordID, function(data){
			    				$("#page_contents").html(data);		 
		  					 });
					}
                    break; 
                    case "Delete":
						if(confirm('Are you sure to Delete this record')){
							 $.get("admin_zpanel/vs_users_virtual_stores_inventory_management.php?DeleteID="+SelectedRecordID, function(data){
			    				$("#page_contents").html(data);		 
		  					 });
						}
							 
                    break;												                  
                    default:
                        alert('Could not complete your request.');
                }

	
	
});

</script>
<?php
// This will Incldude the Code to Enable the Simple Form to Act as Ajax Form
require_once("../scripts/jquery_forms_ajax/jquery_form_include_in_each_page.php"); 

@mysql_free_result($Rs_GetItemsList);

@mysql_free_result($Rs_Categories);

@mysql_free_result($RsGetSelectedItem);

mysql_free_result($RsGetTargetedGroup);

mysql_free_result($Rs_GetBrands);

mysql_free_result($Rs_GetMainCategoryID);
?>