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

$currentPage = $_SERVER["PHP_SELF"]."?ID=productslist";

$editFormAction = $_SERVER['PHP_SELF']."?ID=productslist";
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */

if ((isset($_GET['ProductID'])) && ($_GET['ProductID'] != "") && (isset($_GET['Delete']))) {
  $deleteSQL = sprintf("DELETE FROM products_list WHERE ProductID=%s",
                       GetSQLValueString($_GET['ProductID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
   $insertSQL = sprintf("INSERT INTO products_list (ProductName, ProductDescription, Product_DownloadFileName, Product_DownloadTrialFileName, LinkTag) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ProductName'], "text"),
                       GetSQLValueString($_POST['ProductDescription'], "text"),
                       GetSQLValueString($_POST['Product_DownloadFileName'], "text"),
                       GetSQLValueString($_POST['Product_DownloadTrialFileName'], "text"),
                       GetSQLValueString($_POST['LinkTag'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE products_list SET ProductName=%s, ProductDescription=%s, Product_DownloadFileName=%s, Product_DownloadTrialFileName=%s, LinkTag=%s WHERE ProductID=%s",
                       GetSQLValueString($_POST['ProductName'], "text"),
                       GetSQLValueString($_POST['ProductDescription'], "text"),
                       GetSQLValueString($_POST['Product_DownloadFileName'], "text"),
                       GetSQLValueString($_POST['Product_DownloadTrialFileName'], "text"),
                       GetSQLValueString($_POST['LinkTag'], "text"),
                       GetSQLValueString($_POST['ProductID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}


$colname_Rs_getProducts = "-1";
if (isset($_GET['ProductID'])) {
  $colname_Rs_getProducts = $_GET['ProductID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_getProducts = sprintf("SELECT * FROM products_list WHERE ProductID = %s", GetSQLValueString($colname_Rs_getProducts, "int"));
$Rs_getProducts = mysql_query($query_Rs_getProducts, $Conn) or die(mysql_error());
$row_Rs_getProducts = mysql_fetch_assoc($Rs_getProducts);
$totalRows_Rs_getProducts = mysql_num_rows($Rs_getProducts);

$maxRows_Rs_GetProductList = 20;
$pageNum_Rs_GetProductList = 0;
if (isset($_GET['pageNum_Rs_GetProductList'])) {
  $pageNum_Rs_GetProductList = $_GET['pageNum_Rs_GetProductList'];
}
$startRow_Rs_GetProductList = $pageNum_Rs_GetProductList * $maxRows_Rs_GetProductList;

$colname_Rs_GetProductList = "";
if (isset($_POST['ProductName'])) {
  $colname_Rs_GetProductList = $_POST['ProductName'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetProductList = sprintf("SELECT * FROM products_list WHERE ProductName LIKE %s", GetSQLValueString($colname_Rs_GetProductList . "%", "text"));
$query_limit_Rs_GetProductList = sprintf("%s LIMIT %d, %d", $query_Rs_GetProductList, $startRow_Rs_GetProductList, $maxRows_Rs_GetProductList);
$Rs_GetProductList = mysql_query($query_limit_Rs_GetProductList, $Conn) or die(mysql_error());
$row_Rs_GetProductList = mysql_fetch_assoc($Rs_GetProductList);

if (isset($_GET['totalRows_Rs_GetProductList'])) {
  $totalRows_Rs_GetProductList = $_GET['totalRows_Rs_GetProductList'];
} else {
  $all_Rs_GetProductList = mysql_query($query_Rs_GetProductList);
  $totalRows_Rs_GetProductList = mysql_num_rows($all_Rs_GetProductList);
}
$totalPages_Rs_GetProductList = ceil($totalRows_Rs_GetProductList/$maxRows_Rs_GetProductList)-1;

mysql_select_db($database_Conn, $Conn);
$query_RsGetPagesList = "SELECT PageID, PageName, LinkTag FROM cms_web_pages";
$RsGetPagesList = mysql_query($query_RsGetPagesList, $Conn) or die(mysql_error());
$row_RsGetPagesList = mysql_fetch_assoc($RsGetPagesList);
$totalRows_RsGetPagesList = mysql_num_rows($RsGetPagesList);

$queryString_Rs_GetProductList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Rs_GetProductList") == false && 
        stristr($param, "totalRows_Rs_GetProductList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Rs_GetProductList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Rs_GetProductList = sprintf("&totalRows_Rs_GetProductList=%d%s", $totalRows_Rs_GetProductList, $queryString_Rs_GetProductList);
?>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<h3 id="why"> Product Information </h3>
<br />

<div style="position: relative;  z-index: 1;">
<div class="DataEntryView">
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Insert Product</li>
    <li class="TabbedPanelsTab" tabindex="1">Edit Product</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <h3> Insert New Product </h3>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table align="center" width="100%">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><div align="left">Product Name:</div></td>
            <td><span id="sprytextfield1">
              <input type="text" name="ProductName" value="" size="32" />
            <span class="textfieldRequiredMsg">*</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right" valign="top"><div align="left">Product Description:</div></td>
            <td><span id="sprytextfieldProductDescription">
              <input type="text" id="ProductDescription" name="ProductDescription" value="" size="32" />
            <span class="textfieldRequiredMsg">*</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><div align="left">Product File Name:</div></td>
            <td><span id="sprytextfield2">
              <input type="text" name="Product_DownloadFileName" value="" size="32" />
            <span class="textfieldRequiredMsg">*</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><div align="left">Trial File Name:</div></td>
            <td><span id="sprytextfield3">
              <input type="text" name="Product_DownloadTrialFileName" value="" size="32" />
            <span class="textfieldRequiredMsg">*</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><div align="left">Contact Page via Link Tag:</div></td>
            <td><span id="sprytextfield7">
              <select name="LinkTag" id="LinkTag">
                <?php
do {  
?>
                <option value="<?php echo $row_RsGetPagesList['LinkTag']?>"><?php echo $row_RsGetPagesList['PageName']." - ".$row_RsGetPagesList['LinkTag']?></option>
    <?php
} while ($row_RsGetPagesList = mysql_fetch_assoc($RsGetPagesList));
  $rows = mysql_num_rows($RsGetPagesList);
  if($rows > 0) {
      mysql_data_seek($RsGetPagesList, 0);
	  $row_RsGetPagesList = mysql_fetch_assoc($RsGetPagesList);
  }
?>
</select>
            <span class="textfieldRequiredMsg">*</span></span></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right"><div align="left"></div></td>
            <td><input type="submit" value="Save Product Information" />
              <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    </div>
    <div class="TabbedPanelsContent">
     <h3> Update Product Information </h3>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" width="100%">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Product Name:</div></td>
      <td><span id="sprytextfield4">
        <input type="text" name="ProductName" value="<?php echo htmlentities($row_Rs_getProducts['ProductName'], ENT_COMPAT, ''); ?>" size="32" />
        <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Product Description:</div></td>
      <td><span id="sprytextfieldProductDescription2">
        <input  type="text" name="ProductDescription" size="32"value="<?php echo htmlentities($row_Rs_getProducts['ProductDescription'], ENT_COMPAT, ''); ?>" />
        <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Product Download File Name:</div></td>
      <td><span id="sprytextfield5">
        <input type="text" name="Product_DownloadFileName" value="<?php echo htmlentities($row_Rs_getProducts['Product_DownloadFileName'], ENT_COMPAT, ''); ?>" size="32" />
        <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Product Download Trial File Name:</div></td>
      <td><span id="sprytextfield6">
        <input type="text" name="Product_DownloadTrialFileName" value="<?php echo htmlentities($row_Rs_getProducts['Product_DownloadTrialFileName'], ENT_COMPAT, ''); ?>" size="32" />
        <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
        <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left">Contact Page via Link Tag:</div></td>
      <td><span id="sprytextfield8">
  <select name="LinkTag" id="LinkTag">
    <?php
do {  
?>
    <option value="<?php echo $row_RsGetPagesList['LinkTag']?>"<?php if (!(strcmp($row_RsGetPagesList['LinkTag'], $row_Rs_getProducts['LinkTag']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RsGetPagesList['PageName']." - ". $row_RsGetPagesList['LinkTag']?></option>
    <?php
} while ($row_RsGetPagesList = mysql_fetch_assoc($RsGetPagesList));
  $rows = mysql_num_rows($RsGetPagesList);
  if($rows > 0) {
      mysql_data_seek($RsGetPagesList, 0);
	  $row_RsGetPagesList = mysql_fetch_assoc($RsGetPagesList);
  }
?>
  </select>
        <span class="textfieldRequiredMsg">*</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"></div></td>
      <td><input type="submit" value="Update Product Information" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="ProductID" value="<?php echo $row_Rs_getProducts['ProductID']; ?>" />
</form>
    </div>
  </div>
</div>
</div>
<p>&nbsp;</p>
<div id="searchBox">
  <form id="frmSearch" name="frmSearch" method="post" action="">
    <label for="ProductName">Enter Product Name to Search</label>
    <input type="text" name="ProductName" id="ProductName" />
    <input type="submit" name="button" id="button" value="Search" />
    (Do blank search to show all records)
  </form>
</div>

<p>&nbsp;</p>
<div class="DetailView">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <th>Product ID</th>
    <th>Product Name</th>
    <th>Description</th>
    <th>File Names</th>
    <th>Link Tag</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="?ID=productslist&Delete=true&ProductID=<?php echo $row_Rs_GetProductList['ProductID']; ?>" class="action-link" onclick="return confirm('Are you sure you want to delete this record?');"><img src="images/icons/drop.gif" width="16" height="16" alt="Delete" /></a> | <a href="?ID=productslist&Edit=true&ProductID=<?php echo $row_Rs_GetProductList['ProductID']; ?>" class="action-link" onclick="return confirm('Are you sure you want to Edit this record?');"><img src="images/icons/design.gif" width="16" height="16" alt="Edit" /></a></td>
      <td><?php echo $row_Rs_GetProductList['ProductName']; ?></td>
      <td><div style="width:300px; overflow:scroll;"><?php echo $row_Rs_GetProductList['ProductDescription']; ?></div></td>
      <td><a href="downloads/<?php echo $row_Rs_GetProductList['Product_DownloadFileName']; ?>"><img src="images/icons/save.gif" width="16" height="16" /></a> | <a href="downloads/<?php echo $row_Rs_GetProductList['Product_DownloadTrialFileName']; ?>"><img src="images/icons/31.png" width="16" height="16" /></a></td>
      <td><?php echo $row_Rs_GetProductList['LinkTag']; ?></td>
    </tr>
    <?php } while ($row_Rs_GetProductList = mysql_fetch_assoc($Rs_GetProductList)); ?>
</table>
</div>
<div align="center">
  <table border="0">
    <tr>
      <td><?php if ($pageNum_Rs_GetProductList > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Rs_GetProductList=%d%s", $currentPage, 0, $queryString_Rs_GetProductList); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Rs_GetProductList > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Rs_GetProductList=%d%s", $currentPage, max(0, $pageNum_Rs_GetProductList - 1), $queryString_Rs_GetProductList); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Rs_GetProductList < $totalPages_Rs_GetProductList) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Rs_GetProductList=%d%s", $currentPage, min($totalPages_Rs_GetProductList, $pageNum_Rs_GetProductList + 1), $queryString_Rs_GetProductList); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_Rs_GetProductList < $totalPages_Rs_GetProductList) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Rs_GetProductList=%d%s", $currentPage, $totalPages_Rs_GetProductList, $queryString_Rs_GetProductList); ?>">Last</a>
        <?php } // Show if not last page ?></td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
<p>&nbsp; </p>
</div>

<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextfieldProductDescription");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextfieldProductDescription2");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
</script>
<?php
mysql_free_result($Rs_getProducts);

mysql_free_result($Rs_GetProductList);

mysql_free_result($RsGetPagesList);
?>
