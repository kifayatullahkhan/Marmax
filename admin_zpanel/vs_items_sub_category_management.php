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
  $insertSQL = sprintf("INSERT INTO vs_items_sub_category (VSItemSubCategoryName, VSItemSubCategoryName2, VSItemSubCategoryShortDescription, VSItemSubCategoryShortDescription2, VSItemMainCATID) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['VSItemSubCategoryName'], "text"),
                       GetSQLValueString($_POST['VSItemSubCategoryName2'], "text"),
                       GetSQLValueString($_POST['VSItemSubCategoryShortDescription'], "text"),
                       GetSQLValueString($_POST['VSItemSubCategoryShortDescription2'], "text"),
                       GetSQLValueString($_POST['VSItemMainCATID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE vs_items_sub_category SET VSItemSubCategoryName=%s, VSItemSubCategoryName2=%s, VSItemSubCategoryShortDescription=%s, VSItemSubCategoryShortDescription2=%s, VSItemMainCATID=%s WHERE VSItemSubCATID=%s",
                       GetSQLValueString($_POST['VSItemSubCategoryName'], "text"),
                       GetSQLValueString($_POST['VSItemSubCategoryName2'], "text"),
                       GetSQLValueString($_POST['VSItemSubCategoryShortDescription'], "text"),
                       GetSQLValueString($_POST['VSItemSubCategoryShortDescription2'], "text"),
                       GetSQLValueString($_POST['VSItemMainCATID'], "int"),
                       GetSQLValueString($_POST['VSItemSubCATID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM vs_items_sub_category WHERE VSItemSubCATID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetVSCategories = "SELECT * FROM vs_items_main_category ORDER BY VSItemMainCATID DESC";
$Rs_GetVSCategories = mysql_query($query_Rs_GetVSCategories, $Conn) or die(mysql_error());
$row_Rs_GetVSCategories = mysql_fetch_assoc($Rs_GetVSCategories);
$totalRows_Rs_GetVSCategories = mysql_num_rows($Rs_GetVSCategories);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetSubCategoryList = "SELECT vs_items_sub_category.* , vs_items_main_category.* FROM vs_items_sub_category, vs_items_main_category
WHERE vs_items_sub_category.VSItemMainCATID = vs_items_main_category.VSItemMainCATID
ORDER BY vs_items_sub_category.VSItemSubCATID DESC";
$Rs_GetSubCategoryList = mysql_query($query_Rs_GetSubCategoryList, $Conn) or die(mysql_error());
$row_Rs_GetSubCategoryList = mysql_fetch_assoc($Rs_GetSubCategoryList);
$totalRows_Rs_GetSubCategoryList = mysql_num_rows($Rs_GetSubCategoryList);

$colname_RsGetSelectedSubCategory = "-1";
if (isset($_GET['EditID'])) {
  $colname_RsGetSelectedSubCategory = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RsGetSelectedSubCategory = sprintf("SELECT * FROM vs_items_sub_category WHERE VSItemSubCATID = %s", GetSQLValueString($colname_RsGetSelectedSubCategory, "int"));
$RsGetSelectedSubCategory = mysql_query($query_RsGetSelectedSubCategory, $Conn) or die(mysql_error());
$row_RsGetSelectedSubCategory = mysql_fetch_assoc($RsGetSelectedSubCategory);
$totalRows_RsGetSelectedSubCategory = mysql_num_rows($RsGetSelectedSubCategory);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetGlobalCategoryList = "SELECT * FROM vs_items_category ORDER BY VSItemCategoryName ASC";
$Rs_GetGlobalCategoryList = mysql_query($query_Rs_GetGlobalCategoryList, $Conn) or die(mysql_error());
$row_Rs_GetGlobalCategoryList = mysql_fetch_assoc($Rs_GetGlobalCategoryList);
$totalRows_Rs_GetGlobalCategoryList = mysql_num_rows($Rs_GetGlobalCategoryList);
?>


 



  <!-- Start of SectionWrapper 1 -->
  <?php if ($totalRows_RsGetSelectedSubCategory == 0) { // Show if recordset empty ?>
  <!-- Start of Data Entry Form  -->
<div class="DataEntryForm">
<div class="box_like_section_wrapper"> 
      <h2> Virtual Store New Subcategory </h2>
      <form method="post"  action="<?php echo $editFormAction; ?>"   name="form1" id="form1"  accept-charset="UTF-8">
        <table width="100%" align="center">
          <tr valign="baseline">
            <td align="left">Sub Category Name</td>
            <td align="right">Sub Category Name (Arabic)</td>
          </tr>
          <tr valign="baseline">
            <td align="left"><input type="text" name="VSItemSubCategoryName" value="" size="32"></td>
            <td align="right"><input type="text" name="VSItemSubCategoryName2" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="left">Sub Category Short Description</td>
            <td align="right">Sub Category Short Description (Arabic)</td>
          </tr>
          <tr valign="baseline">
            <td align="left"><input type="text" name="VSItemSubCategoryShortDescription" value="" size="32"></td>
            <td align="right"><input type="text" name="VSItemSubCategoryShortDescription2" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="left">Chose Global Category</td>
            <td align="right">Choose Main Virtual Stores Category</td>
          </tr>
          <tr valign="baseline">
            <td align="left"><select name="GlobalCategoryList" id="GlobalCategoryListID">
              <?php
do {  
?>
              <option value="<?php echo $row_Rs_GetGlobalCategoryList['VSItemCATID']?>"><?php echo $row_Rs_GetGlobalCategoryList['VSItemCategoryName']?></option>
              <?php
} while ($row_Rs_GetGlobalCategoryList = mysql_fetch_assoc($Rs_GetGlobalCategoryList));
  $rows = mysql_num_rows($Rs_GetGlobalCategoryList);
  if($rows > 0) {
      mysql_data_seek($Rs_GetGlobalCategoryList, 0);
	  $row_Rs_GetGlobalCategoryList = mysql_fetch_assoc($Rs_GetGlobalCategoryList);
  }
?>
            </select></td>
            <td align="right"><select name="VSItemMainCATID" id="VSItemMainCATID">

            </select></td>
          </tr>
          <tr valign="baseline">
            <td align="left">&nbsp;</td>
            <td align="right"><input type="submit" value="Save"  class="button_misbah"/></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form>
    </div>
</div>    
    <?php } // Show if recordset empty ?>
<!-- End of SectionWrapper 1  -->


 <!-- Start of SectionWrapper 2 -->
 <?php if ($totalRows_RsGetSelectedSubCategory > 0) { // Show if recordset not empty ?>
   <!-- Start of Data Entry Form  -->
<div class="DataEntryForm">
<div class="box_like_section_wrapper"> 
     <h2> Edit Virtual Store Subcategory </h2>
    <form method="post"  action="<?php echo $editFormAction; ?>"   name="form1" id="form1"  accept-charset="UTF-8">
       <table width="100%" align="center">
         <tr valign="baseline">
           <td nowrap="nowrap" align="left">Sub Category Name</td>
           <td align="right">Sub Category Name (Arabic)</td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="left"><input type="text" name="VSItemSubCategoryName" value="<?php echo htmlentities($row_RsGetSelectedSubCategory['VSItemSubCategoryName'], ENT_COMPAT, ''); ?>" size="32" /></td>
           <td align="right"><input type="text" name="VSItemSubCategoryName2" value="<?php echo htmlentities($row_RsGetSelectedSubCategory['VSItemSubCategoryName2'], ENT_COMPAT, ''); ?>" size="32" /></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="left">Sub Category Short Description</td>
           <td align="right">Sub Categor yShor tDescription (Arabic)</td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="left"><input type="text" name="VSItemSubCategoryShortDescription" value="<?php echo htmlentities($row_RsGetSelectedSubCategory['VSItemSubCategoryShortDescription'], ENT_COMPAT, ''); ?>" size="32" /></td>
           <td align="right"><input type="text" name="VSItemSubCategoryShortDescription2" value="<?php echo htmlentities($row_RsGetSelectedSubCategory['VSItemSubCategoryShortDescription2'], ENT_COMPAT, ''); ?>" size="32" /></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="left">Chose Global Category</td>
           <td align="right">Choose Main Virtual Stores Category</td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="left"><select name="GlobalCategoryList" id="GlobalCategoryListID">
             <?php
do {  
?>
             <option value="<?php echo $row_Rs_GetGlobalCategoryList['VSItemCATID']?>"><?php echo $row_Rs_GetGlobalCategoryList['VSItemCategoryName']?></option>
             <?php
} while ($row_Rs_GetGlobalCategoryList = mysql_fetch_assoc($Rs_GetGlobalCategoryList));
  $rows = mysql_num_rows($Rs_GetGlobalCategoryList);
  if($rows > 0) {
      mysql_data_seek($Rs_GetGlobalCategoryList, 0);
	  $row_Rs_GetGlobalCategoryList = mysql_fetch_assoc($Rs_GetGlobalCategoryList);
  }
?>
           </select></td>
           <td align="right"><select name="VSItemMainCATID" id="VSItemMainCATID">
             <?php 
do {  
?>
             <option value="<?php echo $row_Rs_GetVSCategories['VSItemMainCATID']?>" <?php if (!(strcmp($row_Rs_GetVSCategories['VSItemMainCATID'], htmlentities($row_RsGetSelectedSubCategory['VSItemMainCATID'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_Rs_GetVSCategories['VSItemMainCategoryName']?></option>
             <?php
} while ($row_Rs_GetVSCategories = mysql_fetch_assoc($Rs_GetVSCategories));
?>
           </select></td>
         </tr>
         <tr valign="baseline">
           <td nowrap="nowrap" align="left">&nbsp;</td>
           <td align="right"><input name="btnSaveChanges" type="submit" id="btnSaveChanges" value="Save Changes"  class="button_misbah" /></td>
         </tr>
         <tr> </tr>
        </table>
       <input type="hidden" name="MM_update" value="form2" />
       <input type="hidden" name="VSItemSubCATID" value="<?php echo $row_RsGetSelectedSubCategory['VSItemSubCATID']; ?>" />
     </form>
   </div>
</div>
<!-- End of DataEntryForm -->
   <?php } // Show if recordset not empty ?>
<!-- End of SectionWrapper 2 -->


<!-- Show of DetailView -->
<div class="DetailView" >
<div class="box_like_section_wrapper"> 
  <h2> Show Sub Category List </h2>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr class="header_row">
     <td colspan="2">Action</td>
    <td>SubCatID</td>
    <td>Name</td>
    <td>Name (Arabic)</td>
    <td>Short Description</td>
    <td>ShortDescription (Arabic)</td>
    <td>Category Name</td>
    <td>Category Name(Arabic)</td>
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
       <td><a href="#" class="ajax_link" ActionMenu="Delete" SelectedRecordID="<?php echo $row_Rs_GetSubCategoryList['VSItemSubCATID']; ?>"><img src="images/admin_zpanel/icons/delete.gif" alt="Delete" name="Delete" width="16" height="16" id="Delete" /></a></td>
        <td><a href="#"  class="ajax_link" ActionMenu="Edit" SelectedRecordID="<?php echo $row_Rs_GetSubCategoryList['VSItemSubCATID']; ?>" ><img src="images/admin_zpanel/icons/edit.gif" alt="Edit" name="Edit" width="16" height="16" id="Edit" /></a></td>
      <td><?php echo $row_Rs_GetSubCategoryList['VSItemSubCATID']; ?></td>
      <td><?php echo $row_Rs_GetSubCategoryList['VSItemSubCategoryName']; ?></td>
      <td><?php echo $row_Rs_GetSubCategoryList['VSItemSubCategoryName2']; ?></td>
      <td><?php echo $row_Rs_GetSubCategoryList['VSItemSubCategoryShortDescription']; ?></td>
      <td><?php echo $row_Rs_GetSubCategoryList['VSItemSubCategoryShortDescription2']; ?></td>
      <td><?php echo $row_Rs_GetSubCategoryList['VSItemMainCategoryName']; ?></td>
      <td><?php echo $row_Rs_GetSubCategoryList['VSItemMainCategoryName2']; ?></td>

    </tr>
    <?php } while ($row_Rs_GetSubCategoryList = mysql_fetch_assoc($Rs_GetSubCategoryList)); ?>
</table>
  </div> 
</div>
<!-- End of DetailView -->
 

<script type="text/javascript">

// Load Sub Categories
  
  $("#GlobalCategoryListID").change(function (event) {
           event.preventDefault();	
		    var GlobalCATID=$("#GlobalCategoryListID option:selected").val();
			//alert("CatID="+GlobalCATID);
		   $.get("admin_zpanel/ajax_get_main_category_list_for_selected_global_category.php?GlobalCATID="+GlobalCATID, function(data){
			    $("#VSItemMainCATID").html(data); 
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
							 $.get("admin_zpanel/vs_items_sub_category_management.php?EditID="+SelectedRecordID, function(data){
			    				$("#page_contents").html(data);		 
		  					 });
					}
                    break; 
                    case "Delete":
						if(confirm('Are you sure to Delete this record')){
							 $.get("admin_zpanel/vs_items_sub_category_management.php?DeleteID="+SelectedRecordID, function(data){
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
 
?>
<?php
// This will Incldude the Code to Enable the Simple Form to Act as Ajax Form
require_once("../scripts/jquery_forms_ajax/jquery_form_include_in_each_page.php"); 

mysql_free_result($Rs_GetVSCategories);

mysql_free_result($Rs_GetSubCategoryList);

mysql_free_result($RsGetSelectedSubCategory);

mysql_free_result($Rs_GetGlobalCategoryList);
?>