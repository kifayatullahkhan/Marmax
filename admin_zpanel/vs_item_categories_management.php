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
//USERS_ITEMS_STORE_CATEGORY_UPLOAD_PATH
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO vs_items_category (VSItemCategoryName, VSItemCategoryName2, VSItemCategoryShortDescription, VSItemCategoryShortDescription2, DisplayImage) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['VSItemCategoryName'], "text"),
                       GetSQLValueString($_POST['VSItemCategoryName2'], "text"),
                       GetSQLValueString($_POST['VSItemCategoryShortDescription'], "text"),
                       GetSQLValueString($_POST['VSItemCategoryShortDescription2'], "text"),
                       GetSQLValueString(is_uploaded_file($_FILES['DisplayImage']['tmp_name'])?fnUploadFileToPath($_FILES['DisplayImage']['tmp_name'],$_FILES['DisplayImage']['name'],USERS_ITEMS_STORE_CATEGORY_UPLOAD_PATH):"default.jpg", "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE vs_items_category SET VSItemCategoryName=%s, VSItemCategoryName2=%s, VSItemCategoryShortDescription=%s, VSItemCategoryShortDescription2=%s, DisplayImage=%s WHERE VSItemCATID=%s",
                       GetSQLValueString($_POST['VSItemCategoryName'], "text"),
                       GetSQLValueString($_POST['VSItemCategoryName2'], "text"),
                       GetSQLValueString($_POST['VSItemCategoryShortDescription'], "text"),
                       GetSQLValueString($_POST['VSItemCategoryShortDescription2'], "text"),
                       GetSQLValueString(is_uploaded_file($_FILES['DisplayImage']['tmp_name'])?fnUploadFileToPath($_FILES['DisplayImage']['tmp_name'],$_FILES['DisplayImage']['name'],USERS_ITEMS_STORE_CATEGORY_UPLOAD_PATH):"default.jpg", "text"),
                       GetSQLValueString($_POST['VSItemCATID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM vs_items_category WHERE VSItemCATID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

$colname_Rs_GetSelectedRecordForEdit = "-1";
if (isset($_GET['EditID'])) {
  $colname_Rs_GetSelectedRecordForEdit = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetSelectedRecordForEdit = sprintf("SELECT * FROM vs_items_category WHERE VSItemCATID = %s", GetSQLValueString($colname_Rs_GetSelectedRecordForEdit, "int"));
$Rs_GetSelectedRecordForEdit = mysql_query($query_Rs_GetSelectedRecordForEdit, $Conn) or die(mysql_error());
$row_Rs_GetSelectedRecordForEdit = mysql_fetch_assoc($Rs_GetSelectedRecordForEdit);
$totalRows_Rs_GetSelectedRecordForEdit = mysql_num_rows($Rs_GetSelectedRecordForEdit);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetVSItemCategories = "SELECT * FROM vs_items_category ORDER BY VSItemCATID DESC";
$Rs_GetVSItemCategories = mysql_query($query_Rs_GetVSItemCategories, $Conn) or die(mysql_error());
$row_Rs_GetVSItemCategories = mysql_fetch_assoc($Rs_GetVSItemCategories);
$totalRows_Rs_GetVSItemCategories = mysql_num_rows($Rs_GetVSItemCategories);
?>


  <!-- Start of SectionWrapper 1 -->
  <?php if ($totalRows_Rs_GetSelectedRecordForEdit == 0) { // Show if recordset empty ?>
  <!-- Start of DataEntryForm -->
<div class="DataEntryForm">
     <div class="box_like_section_wrapper"> 
    <h2> Add New Virtual Store Global Category </h2>
    <form  action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data"   name="form1" id="form1"  accept-charset="UTF-8">
      <table width="100%" align="center">
        <tr valign="baseline">
          <td align="left">Category Name</td>
          <td align="right">Category Name (Arabic)</td>
          </tr>
        <tr valign="baseline">
          <td align="left"><input type="text" name="VSItemCategoryName" value="" size="32"></td>
          <td align="right"><input type="text" name="VSItemCategoryName2" value="" size="32"></td>
          </tr>
        <tr valign="baseline">
          <td align="left">Category Short Description</td>
          <td align="right">Category Short Description (Arabic)</td>
          </tr>
        <tr valign="baseline">
          <td align="left"><input type="text" name="VSItemCategoryShortDescription" value="" size="32"></td>
          <td align="right"><input type="text" name="VSItemCategoryShortDescription2" value="" size="32"></td>
          </tr>
        <tr valign="baseline">
          <td align="left">Category Display Image</td>
          <td align="right">&nbsp;</td>
          </tr>
        <tr valign="baseline">
          <td align="left"><input name="DisplayImage" type="file" id="DisplayImage" value="" size="32"></td>
          <td align="right"><input type="submit" value="Add New VS Cateogry" class="button_misbah"></td>
        </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form1">
      </form>
   </div>   
  </div>
  <?php } // Show if recordset empty ?>
<!-- End of SectionWrapper 1 -->
 
 <!-- Start of  SectionWrapper 2 -->
 <?php if ($totalRows_Rs_GetSelectedRecordForEdit > 0) { // Show if recordset not empty ?>
<div class="DataEntryForm">
    <div class="box_like_section_wrapper"> 
     <h2>Edit Virtual Store Global Category</h2>
     <form  action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1"  accept-charset="UTF-8">
       <table width="100%" align="center">
         <tr valign="baseline">
           <td nowrap align="left">Category Name</td>
           <td align="right">Category Name (Arabic)</td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="left"><input type="text" name="VSItemCategoryName" value="<?php echo htmlentities($row_Rs_GetSelectedRecordForEdit['VSItemCategoryName'], ENT_COMPAT, ''); ?>" size="32"></td>
           <td align="right"><input type="text" name="VSItemCategoryName2" value="<?php echo htmlentities($row_Rs_GetSelectedRecordForEdit['VSItemCategoryName2'], ENT_COMPAT, ''); ?>" size="32"></td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="left">Category Short Description</td>
           <td align="right">Category Short Description (Arabic)</td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="left"><input type="text" name="VSItemCategoryShortDescription" value="<?php echo htmlentities($row_Rs_GetSelectedRecordForEdit['VSItemCategoryShortDescription'], ENT_COMPAT, ''); ?>" size="32"></td>
           <td align="right"><input type="text" name="VSItemCategoryShortDescription2" value="<?php echo htmlentities($row_Rs_GetSelectedRecordForEdit['VSItemCategoryShortDescription2'], ENT_COMPAT, ''); ?>" size="32"></td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="left">Display Image</td>
           <td align="right">&nbsp;</td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="left"><input name="DisplayImage" type="file" id="DisplayImage" value="<?php echo htmlentities($row_Rs_GetSelectedRecordForEdit['DisplayImage'], ENT_COMPAT, ''); ?>" size="32"></td>
           <td align="right"><input type="submit" value="Save Changes" class="button_misbah"></td>
         </tr>
       </table>
       <input type="hidden" name="MM_update" value="form2">
       <input type="hidden" name="VSItemCATID" value="<?php echo $row_Rs_GetSelectedRecordForEdit['VSItemCATID']; ?>">
     </form>
   </div>
</div>
   <?php } // Show if recordset not empty ?>
<!-- End of SectionWrapper 2 -->
  

<!-- End of DataEntryForm -->


<!-- Start View -->
<div class="DetailView" >
<div class="box_like_section_wrapper"> 
<h2>Virtual Stores Global Category List </h2>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
 <tr class="header_row">
   <td colspan="2">Action</td>
    <td>Name</td>
    <td>Name (Arabic)</td>
    <td>Short Description</td>
    <td>Short Description (Arabic)</td>
    <td>Display Image</td>
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
       <td><a href="#" class="ajax_link" ActionMenu="Delete" SelectedRecordID="<?php echo $row_Rs_GetVSItemCategories['VSItemCATID']; ?>"><img src="images/admin_zpanel/icons/delete.gif" alt="Delete" name="Delete" width="16" height="16" id="Delete" /></a></td>
        <td><a href="#"  class="ajax_link" ActionMenu="Edit" SelectedRecordID="<?php echo $row_Rs_GetVSItemCategories['VSItemCATID']; ?>" ><img src="images/admin_zpanel/icons/edit.gif" alt="Edit" name="Edit" width="16" height="16" id="Edit" /></a></td>
      <td><?php echo $row_Rs_GetVSItemCategories['VSItemCategoryName']; ?></td>
      <td><?php echo $row_Rs_GetVSItemCategories['VSItemCategoryName2']; ?></td>
      <td><?php echo $row_Rs_GetVSItemCategories['VSItemCategoryShortDescription']; ?></td>
      <td><?php echo $row_Rs_GetVSItemCategories['VSItemCategoryShortDescription2']; ?></td>
      <td><a href="<?php echo VIEW_USERS_ITEMS_STORE_CATEGORY_UPLOAD_PATH.$row_Rs_GetVSItemCategories['DisplayImage']; ?>">View</a></td>
    </tr>
    <?php } while ($row_Rs_GetVSItemCategories = mysql_fetch_assoc($Rs_GetVSItemCategories)); ?>
</table>
</div>
</div>
<!-- End of DetailView -->

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
								 $.get("admin_zpanel/vs_item_categories_management.php?EditID="+SelectedRecordID, function(data){
									$("#page_contents").html(data);		 
								 });
							}
                    break; 
                    case "Delete":
						if(confirm('Are you sure to Delete this record')){
							 $.get("admin_zpanel/vs_item_categories_management.php?DeleteID="+SelectedRecordID, function(data){
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

mysql_free_result($Rs_GetSelectedRecordForEdit);

mysql_free_result($Rs_GetVSItemCategories);
?>