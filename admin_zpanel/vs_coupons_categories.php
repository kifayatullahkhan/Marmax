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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO vs_coupons_categories (VSCouponsCategoryName, VSCouponsCategoryName2, VSCouponsCategoryShortDescription, VSCouponsCategoryShortDescription2, VSCouponsCategoryDisplayImage) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['VSCouponsCategoryName'], "text"),
                       GetSQLValueString($_POST['VSCouponsCategoryName2'], "text"),
                       GetSQLValueString($_POST['VSCouponsCategoryShortDescription'], "text"),
                       GetSQLValueString($_POST['VSCouponsCategoryShortDescription2'], "text"),
                       GetSQLValueString($_POST['VSCouponsCategoryDisplayImage'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE vs_coupons_categories SET VSCouponsCategoryName=%s, VSCouponsCategoryShortDescription=%s, VSCouponsCategoryName2=%s, VSCouponsCategoryShortDescription2=%s, VSCouponsCategoryDisplayImage=%s WHERE VSCouponsCATID=%s",
                       GetSQLValueString($_POST['VSCouponsCategoryName'], "text"),
                       GetSQLValueString($_POST['VSCouponsCategoryShortDescription'], "text"),
                       GetSQLValueString($_POST['VSCouponsCategoryName2'], "text"),
                       GetSQLValueString($_POST['VSCouponsCategoryShortDescription2'], "text"),
                       GetSQLValueString($_POST['VSCouponsCategoryDisplayImage'], "text"),
                       GetSQLValueString($_POST['VSCouponsCATID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM vs_coupons_categories WHERE VSCouponsCATID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);
$query_RsGetCategryList = "SELECT * FROM vs_coupons_categories ORDER BY VSCouponsCATID DESC";
$RsGetCategryList = mysql_query($query_RsGetCategryList, $Conn) or die(mysql_error());
$row_RsGetCategryList = mysql_fetch_assoc($RsGetCategryList);
$totalRows_RsGetCategryList = mysql_num_rows($RsGetCategryList);

$colname_RsGetCategoryForEdit = "-1";
if (isset($_GET['EditID'])) {
  $colname_RsGetCategoryForEdit = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RsGetCategoryForEdit = sprintf("SELECT * FROM vs_coupons_categories WHERE VSCouponsCATID = %s", GetSQLValueString($colname_RsGetCategoryForEdit, "int"));
$RsGetCategoryForEdit = mysql_query($query_RsGetCategoryForEdit, $Conn) or die(mysql_error());
$row_RsGetCategoryForEdit = mysql_fetch_assoc($RsGetCategoryForEdit);
$totalRows_RsGetCategoryForEdit = mysql_num_rows($RsGetCategoryForEdit);
?>
<!-- Start of Coupon Categories -->

<?php if ($totalRows_RsGetCategoryForEdit == 0) { // Show if recordset empty ?>
<div class="DataEntryForm">
  <!-- Start of SectionWrapper1 -->
  <div class="box_like_section_wrapper">
  <h2>Add Coupons/Deals Category</h2>
    <form method="post" action="<?php echo $editFormAction; ?>"  name="form1" id="form1"  accept-charset="UTF-8">
      <table width="100%" align="center">
        <tr valign="baseline">
          <td align="left">Category Name</td>
          <td align="right">Category Name (Arabic)</td>
        </tr>
        <tr valign="baseline">
          <td align="left"><input type="text" name="VSCouponsCategoryName" value="" size="32"></td>
          <td align="right"><input type="text" name="VSCouponsCategoryName2" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td align="left">Short Description</td>
          <td align="right">Short Description (Arabic)</td>
        </tr>
        <tr valign="baseline">
          <td align="left"><input type="text" name="VSCouponsCategoryShortDescription" value="" size="32"></td>
          <td align="right"><input type="text" name="VSCouponsCategoryShortDescription2" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td align="left">Display Image</td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td align="left"><input type="file" name="VSCouponsCategoryDisplayImage" value="" size="32"></td>
          <td align="right"><input type="submit" value="Add New Category" class="button_misbah"/></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
  </div>
</div>
  <?php } // Show if recordset empty ?>
<!-- End of SectionWrapper1 -->

<?php if ($totalRows_RsGetCategoryForEdit > 0) { // Show if recordset not empty ?>
<div class="DataEntryForm">
 <!-- Start Edit SectionWrapper 2 -->
 <div class="box_like_section_wrapper">
 <h2>Edit Coupons/Deals Category</h2>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1"  accept-charset="UTF-8">
    <table width="100%" align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="left">Category Name</td>
        <td align="right">Category Name (Arabic)</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left"><input type="text" name="VSCouponsCategoryName3" value="<?php echo htmlentities($row_RsGetCategryList['VSCouponsCategoryName'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td align="right"><input type="text" name="VSCouponsCategoryName4" value="<?php echo htmlentities($row_RsGetCategryList['VSCouponsCategoryName2'], ENT_COMPAT, ''); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left">Short Description</td>
        <td align="right">Short Description (Arabic)</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left"><input type="text" name="VSCouponsCategoryShortDescription3" value="<?php echo htmlentities($row_RsGetCategryList['VSCouponsCategoryShortDescription'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td align="right"><input type="text" name="VSCouponsCategoryShortDescription4" value="<?php echo htmlentities($row_RsGetCategryList['VSCouponsCategoryShortDescription2'], ENT_COMPAT, ''); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left">Display Image</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left"><input type="file" name="VSCouponsCategoryDisplayImage2" value="<?php echo htmlentities($row_RsGetCategryList['VSCouponsCategoryDisplayImage'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td align="right"><input name="BtnSaveChanges" type="submit"  id="BtnSaveChanges" value="Save Changes" class="button_misbah"/></td>
      </tr>
      </table>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="VSCouponsCATID" value="<?php echo $row_RsGetCategryList['VSCouponsCATID']; ?>" />
  </form>
   </div>
   </div>
   <!-- End of SectionWrapper 2 -->
  <?php } // Show if recordset not empty ?>

<!-- End of data entry form -->

<!-- Start of Detail View -->
<div class="DetailView">
<div class="box_like_section_wrapper">
   
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr class="header_row">
      <td colspan="2">Action</td>
      <td>ID</td>
      <td>Category Name</td>
      <td>Short Description</td>
      <td>Category Name (Arabic)</td>
      <td>Short Description (Arabic)</td>
      <td>DisplayImage</td>
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
        <td><a href="#" class="ajax_link" ActionMenu="Delete" SelectedRecordID="<?php echo $row_RsGetCategryList['VSCouponsCATID']; ?>"><img src="images/admin_zpanel/icons/delete.gif" alt="Delete" name="Delete" width="16" height="16" id="Delete" /></a></td>
        <td><a href="#"  class="ajax_link" ActionMenu="Edit" SelectedRecordID="<?php echo $row_RsGetCategryList['VSCouponsCATID']; ?>" ><img src="images/admin_zpanel/icons/edit.gif" alt="Edit" name="Edit" width="16" height="16" id="Edit" /></a></td>
        <td><?php echo $row_RsGetCategryList['VSCouponsCATID']; ?></td>
        <td><?php echo $row_RsGetCategryList['VSCouponsCategoryName']; ?></td>
        <td><?php echo $row_RsGetCategryList['VSCouponsCategoryShortDescription']; ?></td>
        <td><?php echo $row_RsGetCategryList['VSCouponsCategoryName2']; ?></td>
        <td><?php echo $row_RsGetCategryList['VSCouponsCategoryShortDescription2']; ?></td>
        <td><?php echo $row_RsGetCategryList['VSCouponsCategoryDisplayImage']; ?></td>
      </tr>
      <?php } while ($row_RsGetCategryList = mysql_fetch_assoc($RsGetCategryList)); ?>
  </table>
</div>
</div>
<!-- End of SectionWrapper 3 -->

<script type="text/javascript">

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
							 $.get("admin_zpanel/coupon_categories.php?EditID="+SelectedRecordID, function(data){
			    				$("#page_contents").html(data);		 
		  					 });
					}
                    break; 
                    case "Delete":
						if(confirm('Are you sure to Delete this record')){
							 $.get("admin_zpanel/coupon_categories.php?DeleteID="+SelectedRecordID, function(data){
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
@mysql_free_result($RsGetCategryList);
@mysql_free_result($RsGetCategoryForEdit);
?>
<?php
// This will Incldude the Code to Enable the Simple Form to Act as Ajax Form
require_once("../scripts/jquery_forms_ajax/jquery_form_include_in_each_page.php"); 
?>