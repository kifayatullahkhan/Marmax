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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO vs_coupons (CouponItemCode, VSCouponsCATID, CouponName, CouponShortDescription, CouponLongDescription, CouponName2, CouponShortDescription2, CouponLongDescription2, ActualPrice, DescountPercentage, NewPrice, ActiveDays, MinimumNumberOfBuyers, StoreUserID, DisplayImage, GallaryImage1, GallaryImage2, GallaryImage3, GallaryImage4, GallaryImage5, GallaryImage6, BrandID, TargetedGroupID) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['CouponItemCode'], "text"),
                       GetSQLValueString($_POST['VSCouponsCATID'], "int"),
                       GetSQLValueString($_POST['CouponName'], "text"),
                       GetSQLValueString($_POST['CouponShortDescription'], "text"),
                       GetSQLValueString($_POST['CouponLongDescription'], "text"),
                       GetSQLValueString($_POST['CouponName2'], "text"),
                       GetSQLValueString($_POST['CouponShortDescription2'], "text"),
                       GetSQLValueString($_POST['CouponLongDescription2'], "text"),
                       GetSQLValueString($_POST['ActualPrice'], "double"),
                       GetSQLValueString($_POST['DescountPercentage'], "int"),
                       GetSQLValueString($_POST['NewPrice'], "double"),
                       GetSQLValueString($_POST['ActiveDays'], "int"),
                       GetSQLValueString($_POST['MinimumNumberOfBuyers'], "int"),
                       GetSQLValueString($_SESSION['MM_UserID'], "int"),
                       GetSQLValueString(is_uploaded_file($_FILES['DisplayImage']['tmp_name'])?fnUploadFileToPath($_FILES['DisplayImage']['tmp_name'],$_FILES['DisplayImage']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH):"none.jpg", "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage1']['tmp_name'],$_FILES['GallaryImage1']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage2']['tmp_name'],$_FILES['GallaryImage2']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage3']['tmp_name'],$_FILES['GallaryImage3']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage4']['tmp_name'],$_FILES['GallaryImage4']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage5']['tmp_name'],$_FILES['GallaryImage5']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage6']['tmp_name'],$_FILES['GallaryImage6']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString($_POST['BrandID'], "int"),
                       GetSQLValueString($_POST['TargetedGroupID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE vs_coupons SET CouponItemCode=%s, CouponName=%s, CouponShortDescription=%s, CouponLongDescription=%s, CouponName2=%s, CouponShortDescription2=%s, CouponLongDescription2=%s, ActualPrice=%s, DescountPercentage=%s, NewPrice=%s, ActiveDays=%s, MinimumNumberOfBuyers=%s,  VSCouponsCATID=%s, DisplayImage=%s, GallaryImage1=%s, GallaryImage2=%s, GallaryImage3=%s, GallaryImage4=%s, GallaryImage5=%s, GallaryImage6=%s, TargetedGroupID=%s, BrandID=%s WHERE CouponID=%s",
                       GetSQLValueString($_POST['CouponItemCode'], "text"),
                       GetSQLValueString($_POST['CouponName'], "text"),
                       GetSQLValueString($_POST['CouponShortDescription'], "text"),
                       GetSQLValueString($_POST['CouponLongDescription'], "text"),
                       GetSQLValueString($_POST['CouponName2'], "text"),
                       GetSQLValueString($_POST['CouponShortDescription2'], "text"),
                       GetSQLValueString($_POST['CouponLongDescription2'], "text"),
                       GetSQLValueString($_POST['ActualPrice'], "double"),
                       GetSQLValueString($_POST['DescountPercentage'], "int"),
                       GetSQLValueString($_POST['NewPrice'], "double"),
                       GetSQLValueString($_POST['ActiveDays'], "int"),
                       GetSQLValueString($_POST['MinimumNumberOfBuyers'], "int"),
                       GetSQLValueString($_POST['VSCouponsCATID'], "int"),
                       GetSQLValueString(is_uploaded_file($_FILES['DisplayImage']['tmp_name'])?fnUploadFileToPath($_FILES['DisplayImage']['tmp_name'],$_FILES['DisplayImage']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH):"none.jpg", "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage1']['tmp_name'],$_FILES['GallaryImage1']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage2']['tmp_name'],$_FILES['GallaryImage2']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage3']['tmp_name'],$_FILES['GallaryImage3']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage4']['tmp_name'],$_FILES['GallaryImage4']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage5']['tmp_name'],$_FILES['GallaryImage5']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString(fnUploadFileToPath($_FILES['GallaryImage6']['tmp_name'],$_FILES['GallaryImage6']['name'],USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH), "text"),
                       GetSQLValueString($_POST['TargetedGroupID'], "int"),
                       GetSQLValueString($_POST['BrandID'], "int"),
                       GetSQLValueString($_POST['CouponID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetBrands = "SELECT * FROM vs_brands ORDER BY BrandName ASC";
$Rs_GetBrands = mysql_query($query_Rs_GetBrands, $Conn) or die(mysql_error());
$row_Rs_GetBrands = mysql_fetch_assoc($Rs_GetBrands);
$totalRows_Rs_GetBrands = mysql_num_rows($Rs_GetBrands);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetTargetedGroup = "SELECT * FROM vs_targetedgroup";
$Rs_GetTargetedGroup = mysql_query($query_Rs_GetTargetedGroup, $Conn) or die(mysql_error());
$row_Rs_GetTargetedGroup = mysql_fetch_assoc($Rs_GetTargetedGroup);
$totalRows_Rs_GetTargetedGroup = mysql_num_rows($Rs_GetTargetedGroup);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetCouponsCategoryID = "SELECT * FROM vs_coupons_categories ORDER BY VSCouponsCATID DESC";
$Rs_GetCouponsCategoryID = mysql_query($query_Rs_GetCouponsCategoryID, $Conn) or die(mysql_error());
$row_Rs_GetCouponsCategoryID = mysql_fetch_assoc($Rs_GetCouponsCategoryID);
$totalRows_Rs_GetCouponsCategoryID = mysql_num_rows($Rs_GetCouponsCategoryID);

$colname_Rs_GetSelectedCoupon = "-1";
if (isset($_GET['EditID'])) {
  $colname_Rs_GetSelectedCoupon = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetSelectedCoupon = sprintf("SELECT * FROM vs_coupons WHERE CouponID = %s", GetSQLValueString($colname_Rs_GetSelectedCoupon, "int"));
$Rs_GetSelectedCoupon = mysql_query($query_Rs_GetSelectedCoupon, $Conn) or die(mysql_error());
$row_Rs_GetSelectedCoupon = mysql_fetch_assoc($Rs_GetSelectedCoupon);
$totalRows_Rs_GetSelectedCoupon = mysql_num_rows($Rs_GetSelectedCoupon);

$maxRows_Rs_GetCouponsList = 20;
$pageNum_Rs_GetCouponsList = 0;
if (isset($_GET['pageNum_Rs_GetCouponsList'])) {
  $pageNum_Rs_GetCouponsList = $_GET['pageNum_Rs_GetCouponsList'];
}
$startRow_Rs_GetCouponsList = $pageNum_Rs_GetCouponsList * $maxRows_Rs_GetCouponsList;

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetCouponsList = "SELECT vs_coupons.*, vs_targetedgroup.TargetedGroup, vs_brands.BrandName FROM vs_coupons, vs_targetedgroup, vs_brands WHERE  vs_coupons.TargetedGroupID=vs_targetedgroup.TargetedGroupID AND  vs_coupons.BrandID=vs_brands.BrandID ORDER BY CouponID DESC";
$query_limit_Rs_GetCouponsList = sprintf("%s LIMIT %d, %d", $query_Rs_GetCouponsList, $startRow_Rs_GetCouponsList, $maxRows_Rs_GetCouponsList);
$Rs_GetCouponsList = mysql_query($query_limit_Rs_GetCouponsList, $Conn) or die(mysql_error());
$row_Rs_GetCouponsList = mysql_fetch_assoc($Rs_GetCouponsList);

if (isset($_GET['totalRows_Rs_GetCouponsList'])) {
  $totalRows_Rs_GetCouponsList = $_GET['totalRows_Rs_GetCouponsList'];
} else {
  $all_Rs_GetCouponsList = mysql_query($query_Rs_GetCouponsList);
  $totalRows_Rs_GetCouponsList = mysql_num_rows($all_Rs_GetCouponsList);
}
$totalPages_Rs_GetCouponsList = ceil($totalRows_Rs_GetCouponsList/$maxRows_Rs_GetCouponsList)-1;

$queryString_Rs_GetCouponsList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Rs_GetCouponsList") == false && 
        stristr($param, "totalRows_Rs_GetCouponsList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Rs_GetCouponsList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Rs_GetCouponsList = sprintf("&totalRows_Rs_GetCouponsList=%d%s", $totalRows_Rs_GetCouponsList, $queryString_Rs_GetCouponsList);

$currentPage = $_SERVER["PHP_SELF"];
?>


<?php if ($totalRows_Rs_GetSelectedCoupon == 0) { // Show if recordset empty ?>
  <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2>New Coupon Details</h2>
        <table width="100%">
          <tr valign="baseline">
            <td nowrap align="left">Coupon Item Code</td>
            <td align="left">Category</td>
            <td align="left">Brand Name</td>
            <td align="left">Targeted Group</td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="left"><input name="CouponItemCode" type="text" tabindex="1" value="" size="32"></td>
            <td align="left"><select name="VSCouponsCATID" tabindex="2">
              <?php 
do {  
?>
              <option value="<?php echo $row_Rs_GetCouponsCategoryID['VSCouponsCATID']?>" ><?php echo $row_Rs_GetCouponsCategoryID['VSCouponsCategoryName']?></option>
              <?php
} while ($row_Rs_GetCouponsCategoryID = mysql_fetch_assoc($Rs_GetCouponsCategoryID));
?>
            </select></td>
            <td align="left"><select name="BrandID" tabindex="3">
              <?php 
do {  
?>
              <option value="<?php echo $row_Rs_GetBrands['BrandID']?>" ><?php echo $row_Rs_GetBrands['BrandName']?></option>
              <?php
} while ($row_Rs_GetBrands = mysql_fetch_assoc($Rs_GetBrands));
?>
            </select></td>
            <td align="left"><select name="TargetedGroupID" tabindex="3">
              <?php 
do {  
?>
              <option value="<?php echo $row_Rs_GetTargetedGroup['TargetedGroupID']?>" ><?php echo $row_Rs_GetTargetedGroup['TargetedGroup']?></option>
              <?php
} while ($row_Rs_GetTargetedGroup = mysql_fetch_assoc($Rs_GetTargetedGroup));
?>
            </select></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm SplitScreenWrapper">
      <div class="box_like_section_wrapper">
        <h2> Coupon Description</h2>
        <table width="100%">
          <tr valign="baseline">
            <td nowrap> Name</td>
            <td valign="baseline"> Short Description</td>
          </tr>
          <tr valign="baseline">
            <td nowrap><input name="CouponName" type="text" tabindex="4" value="" size="32"></td>
            <td valign="baseline"><input name="CouponShortDescription" type="text" tabindex="5" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap> Long Description</td>
            <td valign="baseline">&nbsp;</td>
          </tr>
          <tr valign="baseline">
            <td colspan="2" nowrap><textarea name="CouponLongDescription" id="CouponLongDescription" tabindex="6"></textarea></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm SplitScreenWrapper">
      <div class="box_like_section_wrapper">
        <h2>Coupon Description (Arabic)</h2>
        <table width="100%">
          <tr valign="baseline">
            <td align="right" nowrap>Short Description (Arabic)</td>
            <td align="right" valign="baseline">Name (Arabic)</td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap><input name="CouponShortDescription2" type="text" tabindex="8" value="" size="32"></td>
            <td align="right" valign="baseline"><input name="CouponName2" type="text" tabindex="7" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap>&nbsp;</td>
            <td align="right" valign="baseline">Long Description (Arabic):</td>
          </tr>
          <tr valign="baseline">
            <td colspan="2" align="right" nowrap><textarea name="CouponLongDescription2" id="CouponLongDescription2" tabindex="9"></textarea></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="clear_all"></div>
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2> Coupon Pricing</h2>
        <table width="100%">
          <tr valign="baseline">
            <td nowrap>Actual Price</td>
            <td valign="baseline">Descount Percentage</td>
            <td valign="baseline">New Price</td>
          </tr>
          <tr valign="baseline">
            <td nowrap><input name="ActualPrice" type="text" tabindex="10" value="" size="32"></td>
            <td valign="baseline"><input name="DescountPercentage" type="text" tabindex="11" value="" size="32"></td>
            <td valign="baseline"><input name="NewPrice" type="text" tabindex="12" value="" size="32"></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2> Coupon Status</h2>
        <table width="100%">
          <tr valign="baseline">
            <td nowrap>Active Days</td>
            <td valign="baseline">Minimum Number Of Buyers</td>
          </tr>
          <tr valign="baseline">
            <td nowrap><input name="ActiveDays" type="text" tabindex="13" value="" size="32"></td>
            <td valign="baseline"><input name="MinimumNumberOfBuyers" type="text" tabindex="14" value="" size="32"></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2> Coupon Image Gallery</h2>
        <table width="100%">
          <tr valign="baseline">
            <td nowrap>Display Image</td>
            <td valign="baseline">&nbsp;</td>
            
          </tr>
          <tr valign="baseline">
            <td nowrap><input name="DisplayImage" type="file" tabindex="16" value="" size="32"></td>
            <td valign="baseline">&nbsp;</td>
            
          </tr>
          <tr valign="baseline">
            <td nowrap>Gallary Image1</td>
            <td valign="baseline">Gallary Image4</td>
            
          </tr>
          <tr valign="baseline">
            <td nowrap><input name="GallaryImage1" type="file" tabindex="17" value="" size="32"></td>
            <td valign="baseline"><input name="GallaryImage4" type="file" tabindex="20" value="" size="32"></td>
            
          </tr>
          <tr valign="baseline">
            <td nowrap>Gallary Image2</td>
            <td valign="baseline">Gallary Image5</td>
            
          </tr>
          <tr valign="baseline">
            <td nowrap><input name="GallaryImage2" type="file" tabindex="18" value="" size="32"></td>
            <td valign="baseline"><input name="GallaryImage5" type="file" tabindex="21" value="" size="32"></td>
            
          </tr>
          <tr valign="baseline">
            <td nowrap>Gallary Image3</td>
            <td valign="baseline">Gallary Image6</td>
            
          </tr>
          <tr valign="baseline">
            <td nowrap><input name="GallaryImage3" type="file" tabindex="19" value="" size="32"></td>
            <td valign="baseline"><input name="GallaryImage6" type="file" tabindex="22" value="" size="32"></td>
            
          </tr>
          <tr valign="baseline">
            <td nowrap>&nbsp;</td>
            <td valign="baseline"><input name="BtnSave" type="submit" id="BtnSave" tabindex="23" value="Save" class="button_misbah"></td>
            
          </tr> 
        </table>
      </div>
    </div>      
    <input type="hidden" name="MM_insert" value="form1">
  </form>
  <?php } // Show if recordset empty ?>
  

<?php if ($totalRows_Rs_GetSelectedCoupon > 0) { // Show if recordset not empty ?>
  <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data"  name="form1" id="form1">
    <table width="100%" align="center">
      <tr valign="baseline">
        <td width="26%" nowrap>CouponItemCode</td>
        <td width="26%" nowrap>VSCouponsCATID:</td>
        <td width="25%" nowrap>BrandID:</td>
        <td width="23%">TargetedGroupID:</td>
      </tr>
      <tr valign="baseline">
        <td nowrap><input type="text" name="CouponItemCode" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['CouponItemCode'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap><select name="VSCouponsCATID">
            <?php 
do {  
?>
            <option value="<?php echo $row_Rs_GetCouponsCategoryID['VSCouponsCATID']?>" <?php if (!(strcmp($row_Rs_GetCouponsCategoryID['VSCouponsCATID'], htmlentities($row_Rs_GetSelectedCoupon['VSCouponsCATID'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_Rs_GetCouponsCategoryID['VSCouponsCategoryName']?></option>
            <?php
} while ($row_Rs_GetCouponsCategoryID = mysql_fetch_assoc($Rs_GetCouponsCategoryID));
?>
        </select></td>
        <td nowrap><select name="BrandID">
          <?php 
do {  
?>
          <option value="<?php echo $row_Rs_GetBrands['BrandID']?>" <?php if (!(strcmp($row_Rs_GetBrands['BrandID'], htmlentities($row_Rs_GetSelectedCoupon['BrandID'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_Rs_GetBrands['BrandName']?></option>
          <?php
} while ($row_Rs_GetBrands = mysql_fetch_assoc($Rs_GetBrands));
?>
        </select></td>
        <td><select name="TargetedGroupID">
          <?php 
do {  
?>
          <option value="<?php echo $row_Rs_GetTargetedGroup['TargetedGroupID']?>" <?php if (!(strcmp($row_Rs_GetTargetedGroup['TargetedGroupID'], htmlentities($row_Rs_GetSelectedCoupon['TargetedGroupID'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_Rs_GetTargetedGroup['TargetedGroup']?></option>
          <?php
} while ($row_Rs_GetTargetedGroup = mysql_fetch_assoc($Rs_GetTargetedGroup));
?>
        </select></td>
      </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2> Edit  Coupon Description</h2>
        <table width="100%">
      <tr valign="baseline">
        <td nowrap>CouponName:</td>
        <td nowrap>CouponShortDescription</td>
        </tr>
      <tr valign="baseline">
        <td nowrap><input type="text" name="CouponName" value="" size="32"></td>
        <td nowrap><input type="text" name="CouponShortDescription" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['CouponShortDescription'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
      <tr valign="baseline">
        <td nowrap>CouponLongDescription:</td>
        <td nowrap>&nbsp;</td>
        </tr>
      <tr valign="baseline">
        <td nowrap><input type="text" name="CouponLongDescription" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['CouponLongDescription'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap>&nbsp;</td>
        </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2>Edit  Coupon Description</h2>
        <table width="100%">
      <tr valign="baseline">
        <td nowrap>CouponName2:</td>
        <td nowrap>CouponShortDescription2:</td>
        </tr>
      <tr valign="baseline">
        <td nowrap><input type="text" name="CouponName2" value="" size="32"></td>
        <td nowrap><input type="text" name="CouponShortDescription2" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['CouponShortDescription2'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
      <tr valign="baseline">
        <td nowrap>CouponLongDescription2:</td>
        <td nowrap>&nbsp;</td>
        </tr>
      <tr valign="baseline">
        <td nowrap><input type="text" name="CouponLongDescription2" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['CouponLongDescription2'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap>&nbsp;</td>
        </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2>Edit  Coupon Pricing</h2>
        <table width="100%">
      <tr valign="baseline">
        <td nowrap>ActualPrice:</td>
        <td nowrap>DescountPercentage:</td>
        <td nowrap>NewPrice:</td>
        </tr>
      <tr valign="baseline">
        <td nowrap><input type="text" name="ActualPrice" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['ActualPrice'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap><input type="text" name="DescountPercentage" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['DescountPercentage'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap><input type="text" name="NewPrice" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['NewPrice'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2>Edit  Coupon Status</h2>
        <table width="100%">
      <tr valign="baseline">
        <td nowrap align="left">Active Days:</td>
        <td nowrap>Minimum Number Of Buyers:</td>
        </tr>
      <tr valign="baseline">
        <td nowrap align="left"><input type="text" name="ActiveDays" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['ActiveDays'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap><input type="text" name="MinimumNumberOfBuyers" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['MinimumNumberOfBuyers'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        </table>
      </div>
    </div>
    <div class="DataEntryForm"></div>
    <div class="DataEntryForm">
      <div class="box_like_section_wrapper">
        <h2>Edit  Coupon Image Gallery</h2>
        <table width="100%">
      <tr valign="baseline">
        <td nowrap align="left">DisplayImage:</td>
        <td nowrap>&nbsp;</td>
        </tr>
      <tr valign="baseline">
        <td nowrap align="left"><input type="file" name="DisplayImage" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['DisplayImage'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap>&nbsp;</td>
        </tr>
      <tr valign="baseline">
        <td nowrap align="left">GallaryImage1:</td>
        <td nowrap>GallaryImage4</td>
        </tr>
      <tr valign="baseline">
        <td nowrap align="left"><input type="file" name="GallaryImage1" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['GallaryImage1'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap><input type="file" name="GallaryImage4" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['GallaryImage4'], ENT_COMPAT, ''); ?>" size="32"></td>
        <tr valign="baseline">
        <td nowrap align="left">GallaryImage2:</td>
        <td nowrap>GallaryImage5</td>
        </tr>
      <tr valign="baseline">
        <td nowrap align="left"><input type="file" name="GallaryImage2" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['GallaryImage2'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap><input type="file" name="GallaryImage5" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['GallaryImage5'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
      <tr valign="baseline">
        <td nowrap align="left">GallaryImage3:</td>
        <td nowrap>GallaryImage6:</td>
        </tr>
      <tr valign="baseline">
        <td nowrap align="left"><input type="file" name="GallaryImage3" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['GallaryImage3'], ENT_COMPAT, ''); ?>" size="32"></td>
        <td nowrap><input type="file" name="GallaryImage6" value="<?php echo htmlentities($row_Rs_GetSelectedCoupon['GallaryImage6'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
      <tr valign="baseline">
        <td nowrap align="left">&nbsp;</td>
        <td nowrap><input name="BtnSaveChanges" type="submit" id="BtnSaveChanges" value="Save Changes" class="button_misbah"></td>
        </tr>
          </table>
          
          
          <div> 
            <table border="0">
              <tr>
                <td><?php if ($pageNum_Rs_GetCouponsList > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_Rs_GetCouponsList=%d%s", $currentPage, 0, $queryString_Rs_GetCouponsList); ?>">First</a>
                    <?php } // Show if not first page ?></td>
                <td><?php if ($pageNum_Rs_GetCouponsList > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_Rs_GetCouponsList=%d%s", $currentPage, max(0, $pageNum_Rs_GetCouponsList - 1), $queryString_Rs_GetCouponsList); ?>">Previous</a>
                <?php } // Show if not first page ?></td>
                <td><?php if ($pageNum_Rs_GetCouponsList < $totalPages_Rs_GetCouponsList) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_Rs_GetCouponsList=%d%s", $currentPage, min($totalPages_Rs_GetCouponsList, $pageNum_Rs_GetCouponsList + 1), $queryString_Rs_GetCouponsList); ?>">Next</a>
                    <?php } // Show if not last page ?></td>
                <td><?php if ($pageNum_Rs_GetCouponsList < $totalPages_Rs_GetCouponsList) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_Rs_GetCouponsList=%d%s", $currentPage, $totalPages_Rs_GetCouponsList, $queryString_Rs_GetCouponsList); ?>">Last</a>
                    <?php } // Show if not last page ?></td>
              </tr>
            </table>
          </div>
          
          </div>
    </div>   
       
    <input type="hidden" name="MM_update" value="form2">
    <input type="hidden" name="CouponID" value="<?php echo $row_Rs_GetSelectedCoupon['CouponID']; ?>">
  </form>
  <?php } // Show if recordset not empty ?>


<div class="DetailView">
  <div class="box_like_section_wrapper">
    <h2> List of Coupons </h2>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
       <tr class="header_row">
        <td colspan="2">Action</td>
        <td>ItemCode</td>
        <td>Name</td>
         
        <td>Short Desc</td>
        <td>Name2</td>
        <td>Short Desc 2</td>
        <td>Actual Price</td>
        <td>Descount%</td>
        <td>NewPrice</td>
        <td>ActiveDays</td>
        <td>Targeted Group</td>
        <td>Brand Name</td>
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
         
         
          <td><?php echo $row_Rs_GetCouponsList['CouponID']; ?></td>
          <td>&nbsp;</td>
          
          
                     <td><a href="#" class="ajax_link" ActionMenu="Delete" SelectedRecordID="<?php echo $row_Rs_GetCouponsList['CouponID']; ?>"><img src="images/admin_zpanel/icons/delete.gif" alt="Delete" name="Delete" width="16" height="16" id="Delete" /></a></td>
        <td><a href="#"  class="ajax_link" ActionMenu="Edit" SelectedRecordID="<?php echo $row_Rs_GetCouponsList['CouponID']; ?>" ><img src="images/admin_zpanel/icons/edit.gif" alt="Edit" name="Edit" width="16" height="16" id="Edit" /></a></td>  
          
          
          <td><?php echo $row_Rs_GetCouponsList['CouponItemCode']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['CouponName']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['CouponShortDescription']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['CouponName2']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['CouponShortDescription2']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['ActualPrice']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['DescountPercentage']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['NewPrice']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['ActiveDays']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['TargetedGroup']; ?></td>
          <td><?php echo $row_Rs_GetCouponsList['BrandName']; ?></td>
        </tr>
        <?php } while ($row_Rs_GetCouponsList = mysql_fetch_assoc($Rs_GetCouponsList)); ?>
    </table>
  </div>
</div> 

<script type="text/javascript">

// Load Sub Categories
  
  $("#VSItemCATID").change(function (event) {
           event.preventDefault();	
		    var CatID=$("#VSItemCATID option:selected").val();
			//alert("CatID="+CatID);
		   $.get("admin_zpanel/ajax_get_subcategories_list.php?CATID="+CatID, function(data){
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
							 $.get("admin_zpanel/vs_coupons_management.php?EditID="+SelectedRecordID, function(data){
			    				$("#page_contents").html(data);		 
		  					 });
					}
                    break; 
                    case "Delete":
						if(confirm('Are you sure to Delete this record')){
							 $.get("admin_zpanel/vs_coupons_management.php?DeleteID="+SelectedRecordID, function(data){
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
@mysql_free_result($Rs_GetBrands);
@mysql_free_result($Rs_GetTargetedGroup);
@mysql_free_result($Rs_GetCouponsCategoryID);

mysql_free_result($Rs_GetSelectedCoupon);

mysql_free_result($Rs_GetCouponsList);
?>
